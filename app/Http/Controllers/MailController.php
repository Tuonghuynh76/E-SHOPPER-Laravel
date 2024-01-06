<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;
use App\Models\Product;
use App\Http\Requests\Frontend\CheckoutRequest;
use Auth;
use App\Models\History;
class MailController extends Controller
{
    public function index(Request $request) 
    {
        $product = session()->get('cart');
        $getUser = [];
        $email = "";
        $history = [];
        if(Auth::check()) {
            $getUser = Auth::user();
            $email = $getUser->email;
        }
        $sum = 0;
        foreach ($product as $key => $value) {
            $sum = $sum+$value['price']*$value['qty'];
        }
        $data = [
            'subject' => 'Mail Order',
            'body' => $product,
            'user' => $getUser,
            'sum' => $sum
        ];
        if(Auth::check()) {
            $history = [
                'email' => $email,
                'name' => Auth::user()->name,
                'phone' => Auth::user()->phone,
                'id_user' => Auth::id(),
                'price' => $sum
            ];
        }
        try {
            if(History::create($history)) {
                Mail::to($email)->send(new MailNotify($data));
                session()->forget('cart');
                return response()->json(['message' => 'Great, check your mailbox'])->header('Refresh', '1;url=home');
            } else {
                return response()->json(['failed']);
            }
        } catch (Exception $th) {
            // dd($th);
            return response()->json(['sorry']);
        }
    }
}
