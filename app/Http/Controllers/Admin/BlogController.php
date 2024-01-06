<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Admin\BlogRequest;
use DB;
use Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $getBlog = Blog::simplePaginate(3);
        // dd($getBlog);
        return view('Admin.blog.blog', compact('getBlog'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCreate()
    {
        return view('Admin.blog.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(BlogRequest $request)
    {
        $data = $request->all();
        $data['id_auth'] = Auth::id();
        $file = $request->image;
        // dd($file->getClientOriginalExtension());
        if(!empty($file)){
            $ext = $file->extension();
            $file_name = time().'-'.'blog.'.$ext;
            $data['image'] = $file_name;
            $resize = public_path('upload/blog/image/' . $data['image']);
        }
        if (Blog::create($data)) {
            if(!empty($file)){
                Image::make($file->getRealPath())->resize(846, 387)->save($resize);
            }
            return redirect('/admin/list-blog')->with('success', __('Create blog success.'));
        } else {
            return redirect()->back()->withErrors('Create blog error.');
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
        $getBlog = Blog::find($id)->toArray();
        return view('admin.blog.add', compact('getBlog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $data = $request->all();
        $data['id_auth'] = Auth::id();
        $file = $request->image;
        if(!empty($file)){
            $ext = $file->extension();
            $file_name = time().'-'.'blog.'.$ext;
            $data['image'] = $file_name;
            $resize = public_path('upload/blog/image/' . $data['image']);
        }
        if ($blog->update($data)) {
            if(!empty($file)){
                Image::make($file->getRealPath())->resize(846, 387)->save($resize);
            }
            return redirect('/admin/list-blog')->with('success', __('Update blog success.'));
        } else {
            return redirect()->back()->withErrors('Update blog error.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $blog = DB::table('blog')->where('id',$id)->delete();
        if ($blog) {
            return redirect('/admin/list-blog')->with('success', 'Delete blog success.');
        } else {

            return redirect('/admin/list-blog')->withErrors('Delete blog error.');
        }
    }
}
