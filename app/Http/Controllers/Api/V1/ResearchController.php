<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\ResearchService;
use App\Http\Requests\Research\IndexRequest;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ResearchController extends Controller
{
    protected $service;

    public function __construct(ResearchService $service)
    {
        $this->service = $service;
    }

    public function research(IndexRequest $request)
    {
        $results = $this->service->research($request->all());

        return response()->json([
            'data' => [
                'results' => $results,
            ],
        ]);
    }
}
