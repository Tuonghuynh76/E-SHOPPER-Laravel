<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::All()->toArray();
        $category = Category::All()->toArray();
        $product = Product::orderBy('created_at','DESC')->paginate(6);
        return view('frontend.home.home', compact('product','category','brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailProd($id)
    {
        $detail = Product::find($id)->toArray();
        // dd($detail);
        return view('frontend.product.detail', compact('detail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // session()->has('cart'): kiem tra SS co k 
        // session()->get('cart'): lay ss ra 
        // session()->push('cart',$array); dua mang vao ss
        // session()->put('cart',$getSession); thay dôi 1 cai trong SS
    public function addCart(Request $request)
    {
        $id = $request->id_prod;
        $infoprod = Product::findOrFail($id)->toArray();
        $infoprod['id'] = $id;
        $infoprod['qty'] = 1;
        if(session()->has('cart')) {
            $getSS = session()->get('cart');
            $flag = 1;
            foreach ($getSS as $key => $value) {
                if ($id == $value['id']) {
                    $getSS[$key]['qty'] += 1;
                    $flag = 0;
                }
            }
            if ($flag == 1) {
                $getSS[] = $infoprod;
            }
            session()->put('cart', $getSS);
        } else {
            session()->push('cart',$infoprod);
        }
    }

    public function priceRange(Request $request) 
    {
        $min = $request->min;
        $max = $request->max;
        $product = Product::whereBetween('price', [$min, $max])->get();
        return response()->json(['product' => $product]);
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
        //
    }
}
