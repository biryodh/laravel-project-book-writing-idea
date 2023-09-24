<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\vr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public function permission(Request $request)
    {
        //$email= $request->email;
        $book_id = $request->book_id;
        // $user = User::where('email','=',$email)->get();

        return view("permission", compact("book_id"));
    }

    public function addPermission(Request $request)
    {
        $book_id = $request->book_id;
        $validated = $request->validate([
            "book_id" => "required",
            "email" => "required",
        ]);

        $user = Auth::user();

        if ($validated && $user->email !== $request->email) {
            $collab = User::where("email", "=", $request->email)->first();

            if (empty($collab)) {
                //user not exist
                return Redirect::to("/permission/" . $book_id)->withErrors(
                    "User Does not Exist!"
                );
            }

            $isGranted = Permission::where("editor_id", "=", $collab->id)
                ->where("book_id", "=", $book_id)
                ->first();

            if ($isGranted) {
                return Redirect::to("/permission/" . $book_id)->withErrors(
                    "Permissions are already Granted"
                );
            }

            Permission::create([
                "book_id" => $book_id,
                "editor_id" => $collab->id,
            ]);

            return redirect()
                ->back()
                ->with("success", "Permission is added successfully!");
        } else {
            //somethins is wrong
            return Redirect::to("/permission/" . $book_id)->withErrors(
                "Invalid user"
            );
        }
    }
}
