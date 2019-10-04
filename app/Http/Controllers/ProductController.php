<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = isset($request->search) ? $request->search : '';
        $products = Product::where('description', 'like', '%'.$search.'%')->get();
        return json_encode($products);
    }


    public function indexRemoved(Request $request)
    {
        $products = Product::select('*')->onlyTrashed()->get();
        return json_encode($products);
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
    public function store(Request $request)
    {
        $rules = [
            'description' => ['required', 'unique:products', 'max:255'],
            'cost_price' => ['numeric', 'nullable'],
            'sell_price' => ['required','numeric']
        ];

        $messages = [
            'description.required' => "Description's Field is required",
            'description.unique' => "Description already exists",
            'description.max' => "Description is to longer, Máx allow is 255 caracters",
            'cost_price.numeric' => "Cost price value must be numeric",
            'sell_price.numeric' => "Sell price value must be numeric",
            'sell_price.required' => "Sell Price's Field is required",
            'exists' => "This product already exists"
        ];

        $request->validate($rules, $messages);
        
        Product::create([
            "description" => $request->description,
            "cost_price" => $request->cost_price,
            "sell_price" => $request->sell_price
        ]);

        return response('Product inserted with success', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!isset($id)) return response('Id not informed', 400);

        $product = Product::find($id);
        if(isset($product)){
            return json_encode($product);
        }
        
        return response('Product not found', 404);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!isset($id)) return response('Id not informed', 400);

        $product = Product::find($id);
        if(isset($product)){
            $product->description = $request->description;
            $product->cost_price = $request->cost_price;
            $product->sell_price = $request->sell_price;

            $product->save();

            return json_encode($product);
        }
        return response('Product not found', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!isset($id)) return response('Id not informed', 400);

        $product = Product::find($id);
        if(isset($product)){
            $product->delete();

            return response('Removed with success', 200);
        }
        
        return response('Product not found', 404);
    }

    public function restore($id)
    {
        if(!isset($id)) return response('Id not informed', 400);

        $product = Product::find($id);
        if(isset($product)){
            $product->delete();

            return response('Removed with success', 200);
        }
        
        return response('Product not found', 404);
    }
}
