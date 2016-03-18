<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Uuid;


class ProductController extends ApiController
{
    /**
     * [$failReason gets all products - paginates by page]
     * @var array
     */
    protected $failReason = array();
    /**
     * [index bring all products]
     * @param  integer $page [optional page]
     * @return [json]        [json response]
     */
    public function index()
    {
        $products        = Product::all();
        $returnArray     = array_map( function ($product) {
                return  [
                    'name'=> $product['name'],
                    'price'=> $product['price'],
                    'in_stock' => (boolean) $product['in_stock']
                ];
                }, $products->toArray());
        return $this->respondOk($returnArray);  
    }
    /**
     * [show product]
     * @param  [int] $id [id of product]
     * @return [json]        [json response]
     */
    public function show($id) {
        $product  = Product::find($id);
        if ($product) {
            return $this->respondOk([
                    'name'=> $product->name,
                    'price'=> $product->price,
                    'in_stock' => (boolean) $product->in_stock
                ]);     
        }
        else {
            return $this->respondWith404();
        }       
    }     
    /**
     * [store saves one product to database]
     * @param  Request $request [request vars]
     * @return [json]        [json response]
     */
    public function store(Request $request)
    {       
        $validator = Validator::make($request->all(), [
            'name'=> 'required'
            ,'price'=>'required|numeric'
            ,'in_stock'=>'required|boolean'
        ]);        
        if ($validator->fails()) {
            return $this->respondWithBadRequest($validator->errors()->all());
        }
        else {           
            $product = new Product;           
            $product->name      = $request->input('name');
            $product->price       = $request->input('price');
            $product->in_stock    = $request->input('in_stock');
            $product->save();                                            
            return $this->respondCreated([                
                'id' => $product->id, 
                'status' => 'created'                
            ]);             
        }  
    }

    /**
     * [update product]
     * @param  [int] $id [id of product]
     * @return [json]        [json response]
     */
    public function update($id, Request $request)
    {       
        $product = Product::find($id);     
        if (!$product) {
            return $this->respondWith404();
        }
        else {           
                     
            $product->name        = $request->input('name');
            $product->price       = $request->input('price');
            $product->in_stock    = $request->input('in_stock');
            $product->save();                                            
            return $this->respondOk([                
                'id' => $product->id, 
                'status' => 'updated'                
            ]);             
        }  
    }
           
}
