<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\CourseService;

class CourseController extends Controller
{
    protected $service;

    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }

    public function getLists(string $course)
    {
        $lessons = $this->service->getList();

        return response()->json([
            'data' => [
                'lessons' => $lessons,
            ],
        ]);
    }
}
