<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPoint;
use App\Models\Voucher;
use App\Models\VoucherRedemption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PointController extends Controller
{
    /**
     * Display user's points and available vouchers
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get or create user points
        $userPoints = UserPoint::firstOrCreate(
            ['user_id' => $user->id],
            ['points' => 0, 'total_earned' => 0, 'total_spent' => 0]
        );
        
        // Get available vouchers
        $vouchers = Voucher::where('is_active', true)
            ->where(function($query) {
                $query->whereNull('valid_until')
                    ->orWhere('valid_until', '>=', now()->format('Y-m-d'));
            })
            ->orderBy('points_required')
            ->get();
            
        // Get user's redeemed vouchers
        $redeemedVouchers = VoucherRedemption::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('User.PointsViews.index', compact('userPoints', 'vouchers', 'redeemedVouchers'));
    }
    
    /**
     * Show voucher details page for points redemption
     */
    public function voucherDetails($id)
    {
        $voucher = Voucher::findOrFail($id);
        $user = Auth::user();
        $userPoints = UserPoint::where('user_id', $user->id)->first();
        
        return view('User.PointsViews.voucher-details', compact('voucher', 'userPoints'));
    }
    
    /**
     * Show voucher details
     */
    public function showVoucher($id)
    {
        $voucher = Voucher::findOrFail($id);
        $user = Auth::user();
        $userPoints = UserPoint::where('user_id', $user->id)->first();
        
        return view('User.PointsViews.voucher', compact('voucher', 'userPoints'));
    }
    
    /**
     * Redeem a voucher
     */
    public function redeemVoucher(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);
        $user = Auth::user();
        
        // Get user points
        $userPoints = UserPoint::where('user_id', $user->id)->first();
        
        if (!$userPoints) {
            return redirect()->back()->with('error', 'You don\'t have any points yet.');
        }
        
        // Check if user has enough points
        if ($userPoints->points < $voucher->points_required) {
            return redirect()->back()->with('error', 'You don\'t have enough points to redeem this voucher.');
        }
        
        // Check if voucher is still valid
        if ($voucher->valid_until && $voucher->valid_until < now()->format('Y-m-d')) {
            return redirect()->back()->with('error', 'This voucher has expired.');
        }
        
        // Check if voucher is still active
        if (!$voucher->is_active) {
            return redirect()->back()->with('error', 'This voucher is no longer available.');
        }
        
        // Create redemption code
        $redemptionCode = strtoupper(Str::random(8));
        
        // Create voucher redemption
        $redemption = VoucherRedemption::create([
            'user_id' => $user->id,
            'voucher_id' => $voucher->id,
            'points_spent' => $voucher->points_required,
            'redemption_code' => $redemptionCode,
            'status' => 'completed',
            'redeemed_at' => now(),
        ]);
        
        // Deduct points from user
        $userPoints->points -= $voucher->points_required;
        $userPoints->total_spent += $voucher->points_required;
        $userPoints->save();
        
        return redirect()->route('points.index')
            ->with('success', 'Voucher redeemed successfully! Your redemption code is ' . $redemptionCode);
    }
    
    /**
     * Show history of points earned and spent
     */
    public function history()
    {
        $user = Auth::user();
        
        // Get user points
        $userPoints = UserPoint::where('user_id', $user->id)->first();
        
        // Get point-related activities
        $activities = $user->activities()
            ->whereIn('type', ['journal_created', 'appointment_created', 'voucher_redeemed'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        // Get user's redeemed vouchers
        $redeemedVouchers = VoucherRedemption::where('user_id', $user->id)
            ->with('voucher')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('User.PointsViews.history', compact('userPoints', 'activities', 'redeemedVouchers'));
    }
}
