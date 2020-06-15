<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\LessonService;
use App\Services\Admin\QuestionService;
use App\Http\Requests\Admin\Question\StoreRequest;
use App\Http\Requests\Admin\Question\UpdateRequest;

class QuestionController extends Controller
{
    protected $service;
    protected $lessonService;

    public function __construct(QuestionService $service, LessonService $lessonService)
    {
        $this->service = $service;
        $this->lessonService = $lessonService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->service->getList();

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lessons = $this->lessonService->getLessonNamesAndIds();
        $questionTypes = config('data.questions_types');

        return view('questions.create', compact('lessons', 'questionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();

        if ($request->has('image')) {
            $path = $request->file('image')->store('public/questions');
            $data['image'] = $path;
        }
        $this->service->store($data);

        return redirect()->route('questions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->service->getQuestion($id);
        $lessons = $this->lessonService->getLessonNamesAndIds();
        $questionTypes = config('data.questions_types');

        return view('questions.edit', compact('question', 'lessons', 'questionTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->service->update($request->all(), $id);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->delete($id);
        
        return redirect()->back();
    }
}
