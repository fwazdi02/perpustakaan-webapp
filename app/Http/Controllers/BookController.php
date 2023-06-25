<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        return response()->json(['success' => true , 'data' => $books], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'category' => [
                'required',
                Rule::exists('book_categories', 'id'),
            ],
            'quantity' => 'required|integer|min:0',
            'isbn' => [
                'required',
                Rule::unique('books'),
            ],
            'published_date' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response = [
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        $validatedData =  $validator->validated();
        $book = Book::create($validatedData);
        return response()->json(['success' => true , 'data' => $book], Response::HTTP_OK);
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        $book->load('category'); 
        return response()->json(['success' => true , 'data' => $book], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'category_id' => [
                'required',
                Rule::exists('book_categories', 'id'),
            ],
            'quantity' => 'required|integer|min:0',
            'isbn' => [
                'required',
                Rule::unique('books')->ignore($book ? $book->id : null),
            ],
            'published_date' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response = [
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        $validatedData =  $validator->validated();
        $book->update($validatedData);
        return response()->json(['success' => true , 'data' => $book], Response::HTTP_OK);
    }
    
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['success' => true, 'data' => null], Response::HTTP_OK);
    }


}
