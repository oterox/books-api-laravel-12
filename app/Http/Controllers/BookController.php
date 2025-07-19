<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $books = Book::latest()->paginate(10);
        
        return response()->json([
            'success' => true,
            'data' => $books->items(),
            'pagination' => [
                'current_page' => $books->currentPage(),
                'last_page' => $books->lastPage(),
                'per_page' => $books->perPage(),
                'total' => $books->total(),
            ]
        ]);
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
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate(Book::rules());
            
            $book = Book::create($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Book created successfully',
                'data' => $book
            ], 201);
            
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create book',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): JsonResponse
    {
        try {
            $rules = Book::rules();
            $rules['isbn'] = 'nullable|string|max:13|unique:books,isbn,' . $book->id;
            
            $validated = $request->validate($rules);
            
            $book->update($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Book updated successfully',
                'data' => $book
            ]);
            
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update book',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): JsonResponse
    {
        try {
            $book->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Book deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete book',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search books by title or author.
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q');
        
        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Search query is required'
            ], 400);
        }
        
        $books = Book::where('title', 'like', "%{$query}%")
                    ->orWhere('author', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->latest()
                    ->paginate(10);
        
        return response()->json([
            'success' => true,
            'data' => $books->items(),
            'pagination' => [
                'current_page' => $books->currentPage(),
                'last_page' => $books->lastPage(),
                'per_page' => $books->perPage(),
                'total' => $books->total(),
            ]
        ]);
    }
}
