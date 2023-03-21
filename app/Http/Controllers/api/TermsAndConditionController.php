<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TermsAndConditionRequest;
use App\Http\Resources\TermsAndConditionResource;
use App\Models\TermsAndCondition;
use Illuminate\Auth\Access\AuthorizationException;

class TermsAndConditionController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return TermsAndConditionResource::collection(TermsAndCondition::all());
    }

    /**
     * @throws AuthorizationException
     */
    public function store(TermsAndConditionRequest $request): TermsAndConditionResource
    {
        $this->authorize('administrator', Auth()->user());

        $termsAndCondition = TermsAndCondition::create($request->validated());

        return TermsAndConditionResource::make($termsAndCondition);
    }

    /**
     * @throws AuthorizationException
     */
    public function show(TermsAndCondition $termsAndCondition): TermsAndConditionResource
    {
        $this->authorize('administrator', Auth()->user());

        return TermsAndConditionResource::make($termsAndCondition);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(TermsAndCondition $termsAndCondition, TermsAndConditionRequest $request): TermsAndConditionResource
    {
        $this->authorize('administrator', Auth()->user());

        $termsAndCondition->update($request->validated());

        return TermsAndConditionResource::make($termsAndCondition);
    }
}
