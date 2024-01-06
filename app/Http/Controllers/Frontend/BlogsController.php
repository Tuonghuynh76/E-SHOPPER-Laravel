<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Rate_blog;
use App\Models\Comment;
use db;
use Auth;
class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getBlog = Blog::orderBy('created_at','DESC')->simplePaginate(3);
        return view('frontend.blog.blog-list', compact('getBlog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blogdetail($id)
    {   
        $tb = 0;
        $tong = 0;
        $rate = Rate_blog::where('id_blog', $id)->get()->toArray();
        $dateTime = Comment::where('id_blog', $id)->get('created_at');
        $comment = Comment::where('id_blog', $id)->get();
        foreach($rate as $key => $value) {
            $tong = $tong + $value['rate'];
            $tb = $tong / count($rate);
        }
        $result = round($tb, 1);
        $detail = Blog::where('id', $id)->get();
        $prev = Blog::where('id', '<', $id)->get()->toArray();
        $next = Blog::where('id', '>', $id)->get()->toArray();
        return view('frontend.blog.blog-detail', compact('detail','prev', 'next', 'result', 'comment', 'dateTime'));
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
    public function rate(Request $request)
    {
        $data = $request->all();
        if (Rate_blog::create($data)) {
           return response()->json([
                'message' => 'Danh gia thanh cong!'
            ]);
        } else {
            return response()->json([
                'message' => 'Danh gia that bai!'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request)
    {
        $data = $request->all();
        $data['name'] = Auth::user()->name;
        $data['avatar'] = Auth::user()->avatar;
        if (Comment::create($data)) {
           return response()->json([
                'message' => 'Binh luan thanh cong!'
            ]);
        } else {
            return response()->json([
                'message' => 'Binh luan that bai!'
            ]);
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
        //
    }
}
