<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index(): JsonResponse
    {
        $authors = Author::all();
        return response()->json($authors);
    }

    public function store(Request $request): JsonResponse
    {
        $validate = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:authors',
        ]);

        $author = Author::create($validate);
        return response()->json($author, 201);
    }

    public function destroy($id): JsonResponse
    {
        $author = Author::find($id);
        $author->delete();
        return response()->json(null, 204);
    }
}