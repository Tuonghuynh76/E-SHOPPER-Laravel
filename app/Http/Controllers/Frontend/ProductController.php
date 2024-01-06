<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Http\Requests\Frontend\AddProdRequest;
use App\Http\Requests\Frontend\UpdateProdRequest;
use App\Models\Product;
use Auth;
use Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myProd()
    {
        $product = Product::orderBy('created_at','DESC')->paginate(2);
        return view('frontend.product.list', compact('product'));
    }
    public function addProd()
    {
        $brand = Brand::All()->toArray();
        $category = Category::All()->toArray();
        return view('frontend.product.add', compact('brand', 'category'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // AddProdRequest
    public function getProd(Request $request)
    {
            if($request->hasfile('files'))
            {
                $data = $this->hanldeImg($request->file('files'));
                // foreach($request->file('files') as $image)
                // {
                //     $name = $image->getClientOriginalName();
                //     $name_2 = "hinh85_".$image->getClientOriginalName();
                //     $name_3 = "hinh329_".$image->getClientOriginalName();
                //     $path = public_path('upload/product/images/' . $name);
                //     $path2 = public_path('upload/product/images/' . $name_2);
                //     $path3 = public_path('upload/product/images/' . $name_3);

                //     Image::make($image->getRealPath())->save($path);
                //     Image::make($image->getRealPath())->resize(50, 70)->save($path2);
                //     Image::make($image->getRealPath())->resize(200, 300)->save($path3);
                //     $data[] = $name;
                // }
            }

            $prod = $request->all();
            $prod['id_user'] = Auth::id();
            $prod['image'] = json_encode($data);
            if(Product::create($prod)) {
                return redirect()->back()->with('success', __('Add product success.'));
            } else {
                return redirect()->back()->withErrors('Add product error.');
            }
    }

    public function hanldeImg($arrImg){
        $data = [];
        foreach($arrImg as $image)
            {
                $name = $image->getClientOriginalName();
                $name_2 = "hinh85_".$image->getClientOriginalName();
                $name_3 = "hinh329_".$image->getClientOriginalName();
                $path = public_path('upload/product/images/' . $name);
                $path2 = public_path('upload/product/images/' . $name_2);
                $path3 = public_path('upload/product/images/' . $name_3);

                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(50, 70)->save($path2);
                Image::make($image->getRealPath())->resize(200, 300)->save($path3);
                $data[] = $name;
            }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProd($id)
    {   
        $brand = Brand::All()->toArray();
        $category = Category::All()->toArray();
        $product = Product::find($id)->toArray();
        // dd($product);
        return view('frontend.product.update', compact('product', 'brand', 'category'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getUpdate(UpdateProdRequest $request, $id)
    {
        $product = Product::find($id);
        $img = json_decode($product->image);
        $data = $request->all();
        $data['id_user'] = Auth::id();
        // dd($img);
        if(array_key_exists('img_delete', $data)) {
            foreach ($data['img_delete'] as $key => $value) {
                if (in_array($value, $img)) {
                    unlink('upload/product/images/'.$value);
                    unlink('upload/product/images/hinh85_'.$value);
                    unlink('upload/product/images/hinh329_'.$value);
                    $anhxoa = array_search($value, $img);
                    unset($img[$anhxoa]);
                }
            }
        }
        $img = array_values($img);
        $data['image'] = json_encode($img);
        if($request->hasfile('files')) {
            if ((count($img) + count($request->file('files')) > 3)) {
                return redirect()->back()->withErrors('Please upload only up to 3 images for a product.');
            } else {
                $updateImg = $this->hanldeImg($request->file('files'));
                $imgTotal = array_merge($updateImg, $img);
                $data['image'] = json_encode($imgTotal);
            }
        }


        if($product->update($data)) {
            return redirect()->back()->with('success', __('Update product success.'));
        } else {
            return redirect()->back()->withErrors('Update product error.');
        }
    }
    public function deleteProd($id)
    {
        $product = Product::find($id)->toArray();

        $arrImg = json_decode($product['image'], true);
        $deleteProduct = Product::find($id)->delete();
        
        if ($deleteProduct) {
            foreach ($arrImg as $value) {
                if (file_exists('upload/product/images/'.$value)) {
                    unlink('upload/product/images/'.$value);
                    unlink('upload/product/images/hinh85_'.$value);
                    unlink('upload/product/images/hinh329_'.$value);
                }
            }
            return redirect('frontend/account/my-product')->with('deleted','Delete product '.$product['name'].' successfully.');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
