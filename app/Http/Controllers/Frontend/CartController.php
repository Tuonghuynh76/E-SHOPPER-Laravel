<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->has('cart')) {
            $prod = session()->get('cart');
            return view('frontend.cart.cart', compact('prod'));
        } else {
            return view('frontend.cart.cart');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteProd(Request $request)
    {
        $id = $request->id_prod;
        if(session()->has('cart')) {
            $data = session()->get('cart');
            foreach ($data as $key => $value) {
                if($value['id'] == $id) {
                    unset($data[$key]);
                    break;
                }
            }
            session()->put('cart', $data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function downupProd(Request $request)
    {
        $id = $request->id_prod;
        $qty = $request->qty;
        if(session()->has('cart')) {
            $data = session()->get('cart');
            foreach ($data as $key => $value) {
                if($value['id'] == $id) {
                    $data[$key]['qty'] = $qty;
                    break;
                }
            }
            session()->put('cart', $data);
        }
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
