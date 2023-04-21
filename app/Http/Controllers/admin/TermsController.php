<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        return response()->json(Term::all());
    }
    public function create(Request $request)
    {

        $term = Term::updateOrCreate([
            'body' => $request->body
        ]);
        return response()->json($term);
    }
}
