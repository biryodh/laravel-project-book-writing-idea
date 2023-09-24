<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function write(Request $request)
    {
        $book_id = $request->book_id;

        if (!empty($book_id)) {
            $sections = Section::where("book_id", "=", $book_id)
                ->where("parent_id", "=", 0)
                ->get();
            return view("writes", compact("book_id", "sections"));
        }
    }

    public function addWrites(Request $request)
    {
        $validated = $request->validate([
            "data" => "required",
            "section" => "required",
        ]);
        $user = Auth::user();

        if ($validated && $user) {
            $newSection = Note::create([
                "editor_id" => $user->id,
                "data" => $request->data,
                "section" => $request->section,
            ]);
        }

        return redirect()
            ->back()
            ->with("success", "Data is added successfully!");
    }
}
