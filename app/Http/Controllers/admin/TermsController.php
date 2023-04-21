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

        $term = Term::where('id', 1);

        if ($term) {

            $term->update([
                'body' => $request->body
            ]);
        } else {
            Term::create([
                'body' => $request->body,
            ]);
        }
        return response()->json($term);
    }
}
