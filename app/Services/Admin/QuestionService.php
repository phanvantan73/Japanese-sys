<?php

namespace App\Services\Admin;

use DB;
use App\Models\Question;

/**
 * Service class for authentication handling
 */
class QuestionService extends BaseService
{
    public function getList()
    {
        return Question::all();
    }

    public function store(array $inputs)
    {
        DB::beginTransaction();

        try {
            $question = Question::create($inputs);

            if (isset($inputs['image'])) {
                $question->resource()->create([
                    'path' => $inputs['image'],
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            report($e);
        }
    }

    public function getQuestion($id)
    {
        return Question::findOrFail($id);
    }

    public function update(array $inputs, $id)
    {
        $question = Question::findOrFail($id);
        $question->update($inputs);
        $question->answers()->update([
            'is_true' => 0,
        ]);
        $question->answers()->where('id', $inputs['is_true'])->update([
            'is_true' => 1,
        ]);

        foreach ($inputs['answers'] as $key => $answer) {
            $question->answers()->where('id', $key)->update([
                'content' => $answer,
            ]);
        }
    }

    public function delete($id)
    {
        $question = Question::findOrFail($id);
        $question->answers()->delete();
        $question->resource()->delete();
        $question->delete();
    }
}
