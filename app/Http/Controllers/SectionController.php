<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\vr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        dd("ddd");
        $book_id = $request->id;
        dd($book_id);
        $sectios = Section::get();
        return view('section',compact('sectios'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(vr $vr)
    {
        $book_id = $vr;
        dd($book_id);
        $sectios = Section::get();
        return view('section',compact('sectios'));
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


    function getSection(Request $request){
        //dd($request->book_id);
        $bid = $request->book_id;
        if(!empty($bid)){
            $sections = Section::where("book_id",'=',$bid)->where("parent_id",'=',0)->get();

            return view('section',compact('sections'));
        }
        
        
    }

    function addSection(Request $request){

        if(empty($request)){
            dd("refresh app");
        }
        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'required',
            'book_id' => 'required',
        ]);
        $user= Auth::user();

        if(  $validated && $user){
            
           $newSection =  Section::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'book_id' => $request->book_id,
            ]);
        }

        return redirect()
        ->back()
        ->with('success', 'Section is added successfully!');

    }

}
