<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendVerificationEmail($name, $email, $code)
    {

        $data = [
            'name' => $name,
            'email' => $email,
            'code' => $code,
        ];

        Mail::to($email)->send(new RegistrationEmail($data));
    }
}
