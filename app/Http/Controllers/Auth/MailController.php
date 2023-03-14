<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetEmail;
use App\Mail\RegistrationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendVerificationEmail($name, $email, $url)
    {

        $data = [
            'name' => $name,
            'email' => $email,
            'url' => $url,
        ];

        Mail::to($email)->send(new RegistrationEmail($data));
    }
    public static function sendPasswordResetEmail($name, $email, $url)
    {

        $data = [
            'name' => $name,
            'email' => $email,
            'url' => $url,
        ];

        Mail::to($email)->send(new PasswordResetEmail($data));
    }
}