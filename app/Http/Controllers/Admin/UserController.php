<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Admin\UpdateUserRequest;
use Auth;
use DB;
use App\Models\User;
use App\Models\Country;

class UserController extends Controller
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
        $userId = Auth::id();
        $user = User::find($userId); 
        $country = Country::All()->toArray();
        return view('Admin.user.user', compact('user','country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
    public function list()
    {
        $id = Auth::id();
        $user = User::all()->toArray();
        // dd($user);
        return view('Admin.user.list', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $data = $request->all();
        $file = $request->image;

        if(!empty($file)){
            $ext = $request->image->extension();
            $file_name = time().'-'.'avatar.'.$ext;
            $data['avatar'] = $file_name;
        }
        
        if ($data['Password']) {
            $data['Password'] = bcrypt($data['Password']);
        }else{
            $data['Password'] = $user->password;
        }
        if ($user->update($data)) {
            if(!empty($file)){
                $ext = $request->image->extension();
                $file_name = time().'-'.'avatar.'.$ext;
                $file->move('upload/user/avatar', $file_name);
                DB::table('users')
                ->where('id', $userId)
                ->update(
                    [
                        'name' => $data['Name'],
                        'email' => $data['Email'],
                        'password' => $data['Password'],
                        'avatar' => $data['avatar'],
                        'id_country' => $data['country'],
                    ]
                );
            }
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
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
