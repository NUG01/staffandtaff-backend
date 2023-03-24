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
            'etablissement_id' => $request->etablissement_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
    }
}
