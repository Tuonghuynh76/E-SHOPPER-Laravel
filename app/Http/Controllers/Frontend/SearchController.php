<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $brand = Brand::all()->toArray();
        $category = Category::all()->toArray();
        $dataSearch = $request->search;
        if ($dataSearch) {
            $product = Product::where('name', 'LIKE', '%' . $dataSearch . '%')->paginate(6);
            return view('frontend.search.search', compact('product', 'brand', 'category'));
        } else {
            $product = Product::orderBy('created_at', 'DESC')->paginate(6);
            return view('frontend.search.search', compact('brand', 'category', 'product'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchAdv(Request $request)
    {
        $brand = Brand::All()->toArray();
        $category = Category::All()->toArray();
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->input('search') . '%');
        }

        if ($request->filled('price')) {
            $maxPrice = $request->input('price');
            $query->whereBetween('price', [0, $maxPrice]);
        }

        if ($request->filled('category')) {
            $query->where('id_category', '=', $request->input('category'));
        }

        if ($request->filled('brand')) {
            $query->where('id_brand', '=', $request->input('brand'));
        }

        if ($request->filled('status')) {
            $query->where('status', '=', $request->input('status'));
        }

        $product = $query->paginate(6);
        return view('frontend.search.search',compact('brand', 'category', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
