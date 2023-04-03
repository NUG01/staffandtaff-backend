<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        Comment::create([
            'user_id' => Auth::user()->id,
            'establishment_id' => $request->establishment_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
    }
}
