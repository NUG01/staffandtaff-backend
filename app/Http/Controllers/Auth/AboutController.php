<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\MailController;


class AboutController extends Controller
{
    public function store(Request $request)
    {
        $userName = $request->name;
        $userMail = $request->email;
        $userSms = $request->sms;


        if($userName != null && $userMail != null && $userSms != null){
            MailController::sendUserMail($userName,$userMail,$userSms);
        }
    }
}
