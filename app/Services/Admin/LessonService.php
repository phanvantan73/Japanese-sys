<?php

namespace App\Services\Admin;

use DB;
use App\Models\Lesson;

/**
 * Service class for authentication handling
 */
class LessonService extends BaseService
{
    public function getList()
    {
        return Lesson::all();
    }

    public function store(array $inputs)
    {
        DB::beginTransaction();

        try {
            $lesson = Lesson::create($inputs);

            if (isset($inputs['image'])) {
                $lesson->resource()->create([
                    'path' => $inputs['image'],
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            report($e);
        }
    }

    public function getLesson($id)
    {
        return Lesson::findOrFail($id);
    }

    public function update(array $inputs, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->update($inputs);
    }

    public function delete($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->questions()->delete();
        $lesson->resource()->delete();
        $lesson->delete();
    }

    public function getLessonNamesAndIds()
    {
        return Lesson::all()->pluck('name', 'id')->toArray();
    }
}
