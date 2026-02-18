<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::whereNull('user_id')
            ->orWhere('user_id', $request->user()->id)
            ->orderBy('name')
            ->get();

        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category = Category::create([
            'name' => $validated['name'],
            'user_id' => $request->user()->id
        ]);

        return response()->json($category, Response::HTTP_CREATED);
    }

    public function show(Request $request, Category $category)
    {
        if ($this->forbidden($request, $category)) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }

        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        if ($this->forbidden($request, $category)) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category->update($validated);

        // dd(auth()->id(), $category->user_id);

        return response()->json([
            'category' => $category,
            'message' => 'Categoria atualizada com sucesso'
        ], 200);

        
    }

    public function destroy(Request $request, Category $category)
    {
        if ($this->forbidden($request, $category)) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Categoria excluída com sucesso',
            'data' => $category
        ], 200);
    }


    private function forbidden(Request $request, Category $category): bool
    {
        return $category->user_id !== null &&
               $category->user_id !== $request->user()->id;
    }
}

