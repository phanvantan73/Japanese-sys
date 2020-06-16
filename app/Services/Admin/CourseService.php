<?php

namespace App\Services\Admin;

use DB;
use App\Models\Course;

/**
 * Service class for authentication handling
 */
class CourseService extends BaseService
{
    public function getList()
    {
        return Course::all();
    }

    public function store(array $inputs)
    {
        DB::beginTransaction();

        try {
            $course = Course::create($inputs);

            if (isset($inputs['image'])) {
                $course->resource()->create([
                    'path' => $inputs['image'],
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            report($e);
        }
    }

    public function getCourse($id)
    {
        return Course::findOrFail($id);
    }

    public function update(array $inputs, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($inputs);
    }

    public function delete($id)
    {
        $course = Course::findOrFail($id);
        $course->lessons()->delete();
        $course->resource()->delete();
        $course->delete();
    }

    public function getCourseNamesAndIds()
    {
        return Course::all()->pluck('name', 'id')->toArray();
    }
}
