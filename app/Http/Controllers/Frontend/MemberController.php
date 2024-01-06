<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Http\Requests\Frontend\LoginRequest;
use App\Http\Requests\Frontend\UpdateAccRequest;
use Auth;
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('Frontend.users.login');
    }
    public function logout()
    {   
        Auth::logout();
        return redirect('frontend/login');
    }
    public function getLogin(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];
        $remember = false;
        if ($request->remember_me) {
            $remember = true;
        }
        if (Auth::attempt($login, $remember)) {
            return redirect('/frontend/home');
        } else {
            return redirect()->back()->withErrors('Email or password is not correct.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $country = Country::All()->toArray();
        return view('Frontend.users.register', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getRegister(RegisterRequest $request)
    {
        $data = $request->all();
        $file = $request->avatar;
        if(!empty($file)){
            $ext = $request->avatar->extension();
            $file_name = time().'-'.'avatarFE.'.$ext;
            $data['avatar'] = $file_name;
        }
        $data['password'] = bcrypt($data['password']);
        $data['level'] = 0;
        if (User::create($data)) {
             if(!empty($file)){
                $file->move('upload/user/avatar', $data['avatar']);
            }
            return redirect()->back()->with('success', __('Register profile success.'));
        } else {
            return redirect()->back()->withErrors('Register profile error.');
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
        $country = Country::All()->toArray();
        $user = Auth::user()->toArray();
        return view('Frontend.users.account', compact('user', 'country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAcc(UpdateAccRequest $request)
    {
        $userId = Auth::id();
        $user = User::find($userId); 
        $data = $request->all();
        $file = $request->avatar;
        if(!empty($file)){
            $ext = $request->avatar->extension();
            $file_name = time().'-'.'avatarFE.'.$ext;
            $data['avatar'] = $file_name;
        }
        
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }
        if ($user->update($data)) {
            return redirect()->back()->with('success', __('Update account success.'));
        } else {
            return redirect()->back()->withErrors('Update account error.');
        }
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
