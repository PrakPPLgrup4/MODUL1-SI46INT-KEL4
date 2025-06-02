<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('User.QuizPage.index', compact('quizzes'));
    }


    public function show($type)
    {
        // Pastikan tipe quiz yang diminta valid
        $validTypes = ['stress', 'anxiety', 'depression'];
            if (!in_array($type, $validTypes)) {
            abort(404);
            }
        return view('User.QuizViews.' . $type . 'quiz');
    }


    public function showDynamic($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);

        // Return a generic quiz page that renders questions dynamically
        return view('User.QuizPage.dynamic_quiz', compact('quiz'));
    }

    public function submit(Request $request, $type)
    {
        $validTypes = ['stress', 'anxiety', 'depression'];
        if (!in_array($type, $validTypes)) {
            abort(404);
        }

        // Validasi: pastikan semua pertanyaan wajib diisi dan nilainya 0 atau 1
        $rules = [];
        for ($i = 1; $i <= 10; $i++) {
            $rules['q' . $i] = 'required|in:0,1';
        }

        $messages = [
            'required' => 'Soal :attribute harus dijawab.',
            'in' => 'Jawaban pada soal :attribute tidak valid.',
        ];

        // Jika validasi gagal, otomatis redirect kembali ke form dengan error dan old input
        $request->validate($rules, $messages);

        // Ambil jawaban yang sudah tervalidasi
        $answers = $request->only(array_keys($rules));
        $score = 0;

        foreach ($answers as $answer) {
            if ($answer == '1') {
                $score++;
            }
        }

    
        return view('User.QuizViews.' . $type . 'quiz', compact('score'));
        
    }

    public function submitDynamic(Request $request, $id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);

        $rules = [];
        foreach ($quiz->questions as $index => $question) {
            $rules['q' . ($index + 1)] = 'required|in:0,1';
        }

        $request->validate($rules);

        $answers = $request->only(array_keys($rules));
        $score = 0;

        foreach ($answers as $answer) {
            if ($answer == '1') {
                $score++;
            }
        }

        return view('User.QuizPage.dynamic_quiz', compact('quiz', 'score'));
    }
}
