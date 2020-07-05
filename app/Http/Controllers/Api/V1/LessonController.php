<?php

namespace App\Http\Controllers\Api\V1;

use DB;
use App\Models\Answer;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Services\Api\LessonService;

class LessonController extends Controller
{
    protected $service;

    public function __construct(LessonService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lessons = $this->service->getList($request->only('course_id'));

        return  response()->json([
            'data' => [
                'lessons' => $lessons,
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = $this->service->getLesson($id);

        return response()->json([
            'data' => [
                'lesson' => $lesson,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveTest(Request $request)
    {
        $user = $request->user('api');
        $lesson = Lesson::findOrFail($request->lesson_id);
        $questionIds = $lesson->questions->pluck('id')->toArray();
        $score = Answer::whereIn('id', collect($request->answers)
            ->pluck('answer_id'))
            ->where('is_true', 1)
            ->count();
        DB::beginTransaction();

        try {
            $test = $user->tests()->create();
            $test->questions()->sync(array_values($questionIds));
            $test->result()->create([
                'log' => json_encode($request->answers),
                'score' => $score,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new ApiException('Nộp bài thất bại');
        }

        return response()->json([
            'data' => [
                'success' => 'true',
            ],
        ]);
    }

    public function getListTest(Request $request)
    {
        $tests = $request->user('api')->tests()->with('result')->get();

        return response()->json([
            'data' => [
                'tests' => $tests,
            ],
        ]);
    }
}
