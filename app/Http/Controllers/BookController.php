<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Permission;
use App\Models\Section;
use App\Models\vr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        //dd($user->collabs->book);
        $CollabBooks = [];
        foreach ($user->collabs as $collab) {
            $permissions = Permission::where("id", "=", $collab->id)->first();
            array_push($CollabBooks, $permissions->book);
            //dd( $permissions->book);
        }
        $books = Book::where("author", "=", $user->id)->get();
        return view("book", compact("books", "CollabBooks"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|max:255",
            "chapters" => "required",
        ]);

        if ($validated) {
            //dd("create");
            $user = Auth::user();
            $newBook = Book::create([
                "name" => $request->name,
                "chapters" => $request->chapters,
                "author" => $user->id,
            ]);

            $parentSections = [];
            for ($i = 1; $i <= $request->chapters; $i++) {
                # code...
                array_push($parentSections, [
                    "name" => "Chapter " . $i,
                    "parent_id" => 0,
                    "book_id" => $newBook->id,
                ]);
            }
            Section::insert($parentSections);
            //dd( $newBook);
            return redirect()
                ->back()
                ->with("success", "Record is added successfully!");
        }
        return redirect("/book");
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(vr $vr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vr $vr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, vr $vr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(vr $vr)
    {
        //
    }
}
