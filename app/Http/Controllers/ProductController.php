<?php

namespace App\Http\Controllers;

use App\Exceptions\CheckBelongsToUser;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct()    
    {
        $this->middleware('auth:api')->except('index', 'show');
    }
    public function index()
    {
        return ProductCollection::collection(Product::paginate(10));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // $rules =[
        //     'name' => 'required|max:255|unique:products',
        //     'details' => 'required',
        //     'price' => 'required|max:10',
        //     'stock' => 'required|max:6',
        //     'discount' => 'required|max:2',
        // ];
        // $validator=Validator::make($request->all(), $rules);

        // if($validator->fails()){
        //     return response()->json($validator->errors(), 400); //Bad Request
        // }

        $product = Product::create($request->all());
        // return response()->json($product, 201); this one also working
        return response()->json(new ProductResource($product), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // return $product;
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // $rules =[
        //     'name' => 'required|max:255|unique:products',
        //     'details' => 'required',
        //     'price' => 'required|max:10',
        //     'stock' => 'required|max:6',
        //     'discount' => 'required|max:2',
        // ];
        // $validator=Validator::make($request->all(), $rules);

        // if($validator->fails()){
        //     return response()->json($validator->errors(), 400); //Bad Request
        // }

        $this->ProductUserCheck($product);
        
        $product->update($request->all());
        // return response()->json($product, Response::HTTP_OK ); //200

        return response()->json(new ProductResource($product), Response::HTTP_CREATED ); //201
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // $product=Product::find($id);
        // if(is_null($product)){
        //     return response()->json(["message" => "Record not found!"], Response::HTTP_NOT_FOUND); //404 
        // }  THIS ONE GO EXCEPTION HANDLER
        $this->ProductUserCheck($product);
        $product->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT ); //204
    }
    public function ProductUserCheck($product)
    {
        if(Auth::id() != $product->user_id ){
            throw new CheckBelongsToUser;
            
        }
    }
}
