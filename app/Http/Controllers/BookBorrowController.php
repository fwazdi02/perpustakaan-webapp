<?php

namespace App\Http\Controllers;

use App\BookBorrow;
use App\Book;
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
        
        $currentCount = BookBorrow::where(['book_id' => $request->get('book_id'), 'returned_date' => null])->count();
        $book = Book::findOrFail($request->get('book_id'));

        if($currentCount == $book->quantity){
            return response()->json(['success' => false, 'message' => 'Book out of stock'], Response::HTTP_BAD_REQUEST);
        }

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


    public function returnBook(Request $request)
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
            'returned_date' => 'required|date',
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
        $borrow = BookBorrow::where([
            'user_id' => $request->get('user_id'), 
            'book_id' => $request->get('book_id'), 
            'returned_date' => null])
        ->first();
        if(!$borrow){
            return response()->json(['success' => false, 'message' => "User not borrowed this book"], Response::HTTP_NOT_FOUND);
        }
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
