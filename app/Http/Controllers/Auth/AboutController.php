<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\MailController;
use Illuminate\Support\Facades\Auth;


class AboutController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::user()){
            $userName = Auth::user()->name;
            $userMail = Auth::user()->email;
            $userSms = $request->sms;
        }else{
            $userName = $request->name;
            $userMail = $request->email;
            $userSms = $request->sms;
        }


        if($userName != null && $userMail != null && $userSms != null){
            MailController::sendUserMail($userName,$userMail,$userSms);
        }
    }
}
