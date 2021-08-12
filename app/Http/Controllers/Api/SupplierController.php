<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Supplier;
use DB;
use Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
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
            'name' => 'required|unique:suppliers|max:255',
            'email' => 'required|unique:suppliers',
            'phone' => 'required',
            'address' => 'required'
            
        ]);

        $supplier = new Supplier();
        $supplier['name'] = $request->name;
        $supplier['email'] = $request->email;
        $supplier['phone'] = $request->phone;
        $supplier['address'] = $request->address;
        if($request->shopname){
            $supplier['shopname'] = $request->shopname;
        }
        $image = $request->photo;
        if($image){

            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;

            $proccessed_img = Image::make($image)->resize(240,200);

            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;
            $proccessed_img->save($image_url);

            $supplier['photo'] = $image_url;
        } 
            $supplier->save();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = DB::table('suppliers')->where('id', $id)->first();
        if($supplier->photo){
            unlink($supplier->photo);
        }
        DB::table('suppliers')->where('id', $id)->delete();
    }
}
