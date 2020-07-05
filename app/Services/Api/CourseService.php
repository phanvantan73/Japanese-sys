<?php

namespace App\Services\Api;

use App\Models\Alphabet;
use App\Services\Api\BaseService;

/**
 * Class CourseService
 * @package App\Services\Api
 */
class CourseService extends BaseService
{
    public function getList(string $course)
    {
        $type = $course === 'hiragana' ? 1 : 2;

        return Alphabet::with('detail:id,alphabet_id,description')->where('type', $type)->get();
    }
}
