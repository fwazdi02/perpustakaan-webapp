<?php

namespace App\Http\Controllers;

use App\BookBorrow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BookBorrowController extends Controller
{
    public function index()
    {
        $borrows = BookBorrow::with('book', 'user')->get();
        return response()->json(['success' => true , 'data' => $borrows], Response::HTTP_OK);
    }
    
    
    public function unreturned()
    {
        $borrows = BookBorrow::unreturned()->with('book', 'user')->get();
        return response()->json(['success' => true , 'data' => $borrows], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $rules = [
            'book_id' => [
                'required',
                Rule::exists('books', 'id'),
            ],
            'user_id' => [
                'required',
                Rule::exists('users', 'id'),
            ],
            'due_date' => 'required|date',
            'returned_date' => 'nullable|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response = [
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        $borrowData = $validator->validated();
        $borrow = BookBorrow::create($borrowData);
        return response()->json(['success' => true , 'data' => $borrow], Response::HTTP_OK);
    }

    public function show($id)
    {
        $borrow = BookBorrow::with('book', 'user')->findOrFail($id);
        return response()->json(['success' => true , 'data' => $borrow], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $borrow = BookBorrow::findOrFail($id);

        $rules = [
            'due_date' => 'required|date',
            'returned_date' => 'nullable|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response = [
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        $borrowData = $validator->validated();
        $borrow->update($borrowData);
        return response()->json(['success' => true , 'data' => $borrow], Response::HTTP_OK);
    }
    
    public function destroy($id)
    {
        $borrow = BookBorrow::findOrFail($id);
        $borrow->delete();
        return response()->json(['success' => true, 'data' => null], Response::HTTP_OK);
    }
}
