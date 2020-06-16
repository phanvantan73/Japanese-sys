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
    public function getList()
    {
        return Alphabet::with('detail:id,alphabet_id,description')->where('type', 1)->get();
    }
}
