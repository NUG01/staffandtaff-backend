<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Http\Resources\admin\FaqResource;
use App\Http\Resources\FaqResource as ResourcesFaqResource;
use App\Models\Faq;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {

        return FaqResource::collection(Faq::all());
    }
    public function store(FaqRequest $request)
    {

        $faq = Faq::create($request->validated());

        return ResourcesFaqResource::make($faq);
    }

    public function show(Faq $faq)
    {

        $data = [
            'id' => $faq['id'],
            'category' => $faq['category'],
            'question' => $faq['question'],
            'answer' => $faq['answer'],
            'created_at' => (Carbon::createFromFormat('Y-m-d H:i:s', $faq['created_at']))->format('Y-m-d'),
        ];
        return response()->json($data);
    }

    public function destroy($id)
    {
        Faq::where('id', $id)->delete();
        return response()->noContent();
    }
}
