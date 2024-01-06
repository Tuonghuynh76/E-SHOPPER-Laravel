<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\api\LoginRequest;
use App\Http\Requests\api\RegisterRequest;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Http\JsonResponse;
use Auth;
class MemberController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
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
            $user = Auth::user(); 
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                    'success' => 'success',
                    'token' => $token, 
                    'Auth' => Auth::user()
                ], $this->successStatus); 
        } else {
            return response()->json([
                    'response' => 'error',
                    'errors' => ['errors' => 'invalid email or password'],
                ],$this->successStatus); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
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
        if ($user = User::create($data)) {
             if(!empty($file)){
                $file->move('upload/user/avatar', $data['avatar']);
            }
            return response()->json([
                'message' => 'success',
                $user
            ], JsonResponse::HTTP_OK);
        } else {
            return response()->json(['errors' => 'error sever'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
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
