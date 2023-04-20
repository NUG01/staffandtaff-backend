<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Http\Resources\admin\FaqResource;
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

        $faqData = [
            'category' => $request->category,
            'question' => $request->question,
            'answer' => ($request->answer),
        ];

        $faq = Faq::create($faqData);

        return response()->noContent();
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

    public function update(FaqRequest $request, $id)
    {
        Faq::where('id', $id)->update([
            'category' => $request->category,
            'answer' => $request->answer,
            'question' => $request->question,
        ]);

        return response()->noContent();
    }

    public function destroy($id)
    {
        Faq::where('id', $id)->delete();
        return response()->noContent();
    }
}
