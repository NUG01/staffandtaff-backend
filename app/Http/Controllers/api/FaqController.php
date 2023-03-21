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
    public function index()
    {
        $this->authorize('administrator', Auth()->user());

        return Faq::query()->filter(request('search'))->get();
    }

    public function store(FaqRequest $request)
    {
        $this->authorize('administrator', Auth()->user());

        $faq = Faq::create($request->validated());

        return FaqResource::make($faq);
    }

    public function getSpecificCategory($category): JsonResponse
    {
        $this->authorize('administrator', Auth()->user());

        $faqSection = Faq::where('category', strtolower($category))->get();

        return response()->json($faqSection);
    }

    public function update(FaqRequest $request, Faq $faq): JsonResponse
    {
        $this->authorize('administrator', Auth()->user());

        $updatedFaq = $faq->update($request->validated());

        return response()->json($updatedFaq);
    }

    public function destroy(Faq $faq): JsonResponse
    {
        $faq->delete();
        return response()->json(['message' => 'Deleted!']);
    }
}
