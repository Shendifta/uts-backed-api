<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all character with relasi on table characters, levels and users
        $categories = category::latest()->paginate(5);

        //response
        $response = [
            'status'    => 'success',
            'message'   => 'List all categories',
            'data'      => $categories,
   ];
        return response()->json($response, 200);

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
        //   //validasi data
        $validator = Validator::make($request->all(),[
            'category' => 'required',

        ]);


        //jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors()
            ],422);
        }


        //insert character to database
        $category = category::create([
            'category' => $request->category,

        ]);


        //response
        $response = [
            'status'    => 'success',
            'message'   => 'Add Category success',
            'data'      => $category,
        ];


        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
            //find Level by ID
            $categories = category::find($id);


            //response
            $response = [
                'success'   => 'Detail Level',
                'data'      => $categories,
            ];


            return response()->json($response, 200);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'level_name' => 'required',
            'number_of_enemies' => 'required|integer',
            'heal_point' => 'required|integer',
            'times' => 'required',
        ]);


        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        //find level by ID
        $categories = category::find($id);


        $categories->update([
            'level_name' => $request->level_name,
            'number_of_enemies' => $request->number_of_enemies,
            'heal_point' => $request->heal_point,
            'times' => $request->times,
        ]);


        //response
        $response = [
            'status'    => 'success',
            'message'   => 'Update level success',
            'data'      => $categories,
        ];


        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            //find level by ID
            $categories = category::find($id)->delete();


            $response = [
                'success'   => 'Delete Level Success',
            ];


            return response()->json($response, 200);
    }

}
