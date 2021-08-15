<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Model\Product;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('products')
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->join('suppliers', 'products.supplier_id', 'suppliers.id')
                    ->select('categories.category_name', 'suppliers.name', 'products.*')
                    ->orderBy('products.id', 'DESC')
                    ->get();
                    return response()->json($product);
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
        $validateData = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
        ]);

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->root = $request->root;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->buying_date = $request->buying_date;
        $product->product_quantity = $request->product_quantity;

        if($request->image){
            $pos = strpos($request->image, ';');
            $sub = substr($request->image, 0, $pos);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;

            $upload_path = "backend/product/";
            $image_url = $upload_path.$name;

            $image = Image::make($request->image)->resize(240,200);
            $new_image = $image->save($image_url);

            $product->image = $image_url;

        }
        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $product = DB::table('products')->whereId($id)->first();
        return response()->json($product);
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
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['root'] = $request->root;
        $data['category_id'] = $request->category_id;
        $data['supplier_id'] = $request->supplier_id;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $data['buying_date'] = $request->buying_date;
        $data['product_quantity'] = $request->product_quantity;

        if($request->newimage){
            $pos = strpos($request->newimage, ';');
            $sub = substr($request->newimage, 0, $pos);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;

            $upload_path = "backend/product/";
            $image_url = $upload_path.$name;

            $image = Image::make($request->newimage)->resize(240,200);
            $success = $image->save($image_url);
            if($success){
                $old_image = DB::table('products')->whereId($id)->first();
                unlink($old_image->image);
                $data['image'] = $image_url;
                DB::table('products')->whereId($id)->update($data);
                
            }

        } else {
            $data['image'] = $request->image;
            DB::table('products')->whereId($id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = DB::table('products')->whereId($id)->first();
        if($image->image){
            unlink($image->image);
        }
        DB::table('products')->whereId($id)->delete();
    }
}
