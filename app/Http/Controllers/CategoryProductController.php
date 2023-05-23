<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class CategoryProductController extends Controller
{

    public function __construct(Request $request)
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryProduct::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate data
        $data = $request->only('name');
        $validator = Validator::make($data, [
            'name' => 'required:string'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new product
        $product = CategoryProduct::create([
            'name' => $request->name
        ]);

        //Product created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Category Product created successfully',
            'data' => $product
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CategoryProduct $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = CategoryProduct::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, category product not found.'
            ], 400);
        }

        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CategoryProduct $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CategoryProduct $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validate data
        $data = $request->only('name');
        $validator = Validator::make($data, [
            'name' => 'required|string'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, update category product
        CategoryProduct::where('id', $id)->update([
            'name' => $request->name
        ]);

        //Product updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'Category Product updated successfully',
            'data' => $data
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CategoryProduct $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = CategoryProduct::find($id);
        if ($check != null) {
            CategoryProduct::where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category Product deleted successfully',
                'data' => $check->name
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category Product Not Found'
            ], 400);
        }
    }
}
