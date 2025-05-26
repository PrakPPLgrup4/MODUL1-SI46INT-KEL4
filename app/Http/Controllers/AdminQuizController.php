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
            'image' => 'nullable|image|max:2048',
            'questions' => 'required|array|size:10',
            'questions.*' => 'required|string',
        ]);

        $quiz = new Quiz();
        $quiz->title = $request->title;
        $quiz->description = $request->description;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('quiz_images', 'public');
            $quiz->image = $path;
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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'questions' => 'required|array|size:10',
            'questions.*' => 'required|string',
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->title = $request->title;
        $quiz->description = $request->description;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika perlu
            if ($quiz->image) {
                \Storage::disk('public')->delete($quiz->image);
            }
            $path = $request->file('image')->store('quiz_images', 'public');
            $quiz->image = $path;
        }

        $quiz->save();

        // Update soal: hapus dulu soal lama, lalu buat baru
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
