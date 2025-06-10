<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;

class AdminQuizController extends Controller
{
    // Tampilkan daftar quiz
    public function index()
    {
        $quizzes = Quiz::with('questions')->get();
        return view('admin.quiz.index', compact('quizzes'));
    }

    // Tampilkan form tambah quiz
    public function create()
    {
        return view('admin.quiz.create');
    }

    // Simpan quiz baru beserta 10 soal
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'questions' => 'required|array|size:10',
            'questions.*' => 'required|string',
        ]);

        $quiz = new Quiz();
        $quiz->title = $request->title;
        $quiz->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Save image to public/uploads/quizzes (you can choose folder name)
            $file->move(public_path('uploads/quizzes'), $filename);
            $quiz->image = 'uploads/quizzes/' . $filename; // Save relative path to DB
        }

        $quiz->save();

        foreach ($request->questions as $questionText) {
            $quiz->questions()->create(['question_text' => $questionText]);
        }

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz created successfully.');
    }

    // Tampilkan form edit quiz beserta soal-soalnya
    public function edit($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return view('admin.quiz.edit', compact('quiz'));
    }

    // Update quiz dan soal-soalnya
    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'questions' => 'required|array|size:10',
            'questions.*' => 'required|string',
        ]);

        $quiz->title = $request->title;
        $quiz->description = $request->description;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($quiz->image && file_exists(public_path($quiz->image))) {
                unlink(public_path($quiz->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/quizzes'), $filename);
            $quiz->image = 'uploads/quizzes/' . $filename;
        }

        $quiz->save();

        // Update questions: delete old, add new
        $quiz->questions()->delete();
        foreach ($request->questions as $questionText) {
            $quiz->questions()->create(['question_text' => $questionText]);
        }

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz updated successfully.');
    }

    // Hapus quiz beserta soal terkait (cascade delete)
    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);

        // Hapus gambar jika ada
        if ($quiz->image) {
            \Storage::disk('public')->delete($quiz->image);
        }

        $quiz->delete();

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz deleted successfully.');
    }
}
