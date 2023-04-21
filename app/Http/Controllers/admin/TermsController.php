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

        $data = $request->validated();
        $term = Term::updateOrCreate([
            'body' => $data->body
        ]);
        return response()->json($term);
    }
}
