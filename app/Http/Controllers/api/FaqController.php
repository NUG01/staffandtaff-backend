<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function store(FaqRequest $request)
    {
        $this->authorize('admin', Auth()->user());

        $faq = Faq::create([
            'category' => $request->category,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return FaqResource::make($faq);
    }

    public function index()
    {
        $this->authorize('admin', Auth()->user());
        return Faq::query()->filter(request('search'))->get();
    }

    public function getSpecificCategory($category): JsonResponse
    {

        $this->authorize('admin', Auth()->user());
        $faqSection = Faq::where('category', strtolower($category))->get();
        return response()->json($faqSection);
    }

    public function destroy(Faq $faq): JsonResponse
    {
        $faq->delete();
        return response()->json(['message' => 'Deleted!']);
    }

    public function update(Request $request, Faq $faq): JsonResponse
    {
        $updatedFaq =  $faq->update([
            'category' => $request->category,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);
        return response()->json($updatedFaq);
    }
}