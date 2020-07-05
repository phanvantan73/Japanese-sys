<?php

namespace App\Services\Api;

use App\Models\Lesson;
use App\Services\Api\BaseService;

/**
 * Class LessonService
 * @package App\Services\Api
 */
class LessonService extends BaseService
{
    public function getList(array $input)
    {
        return Lesson::with('resource')->where('course_id', $input['course_id'])->get();
    }

    public function getLesson($id)
    {
        return Lesson::with(['resource', 'questions.answers'])->findOrFail($id);
    }
}
