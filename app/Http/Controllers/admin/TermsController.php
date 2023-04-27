<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermsController extends Controller
{
    public function index()
    {
        return response()->json(Term::all());
    }
    public function create(Request $request)
    {

        $term = DB::table('terms_and_conditions')->where('id', 1)->first();

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
