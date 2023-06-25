<?php

namespace App\Http\Controllers;

use App\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BookCategoryController extends Controller
{
    public function index()
    {
        $categories = BookCategory::all();
        return response()->json(['success' => true , 'data' => $categories], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response = [
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
        
        $validatedData = $validator->validated();
        $category = BookCategory::create($validatedData);

        return response()->json(['success' => true, 'data' => $category], Response::HTTP_OK);
    }
    
    public function show($id)
    {
        $category = BookCategory::findOrFail($id);
        return response()->json(['success' => true, 'data' => $category], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $category = BookCategory::findOrFail($id);
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            $response = [
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ];
            
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        $validatedData = $validator->validated();
        $category->update($validatedData);
        return response()->json(['success' => true, 'data' => $category], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $category = BookCategory::findOrFail($id);
        $category->delete();
        return response()->json(['success' => true, 'data' => null], Response::HTTP_OK);
    }
}
