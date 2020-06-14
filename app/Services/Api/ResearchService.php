<?php

namespace App\Services\Api;

use App\Models\User;
use App\Exceptions\ApiException;
use App\Services\Api\BaseService;

/**
 * Class ResearchService
 * @package App\Services\Api
 */
class ResearchService extends BaseService
{
    public function research(array $inputs)
    {
        $results = [];
        $word = $inputs['keyword'] ?? '';
        $targetLanguage = $inputs['selected_language'] ?? 'vi';
        $dictionary = $targetLanguage === 'vi' ? 'viet-nhat' : 'nhat-viet';
        try {
            $html = file_get_html('https://www.lophoctiengnhat.com/tra-cuu/' . $dictionary . '/' . urlencode($word) . '.html');
        
            foreach($html->find('div.tc_nd_wrap') as $element) {
                $example = [];

                foreach ($element->find('li.dict_nd') as $key => $li) {
                    array_push($example, [
                        'ex_jp' => $li->find('span.dict_ndj', 0)->plaintext,
                        'ex_vn' => $li->find('span.dict_ndv', 0)->plaintext,
                    ]);
                }
                array_push($results, [
                    'word' => $element->find('div.tc_tit', 0)->plaintext,
                    'mean' => $element->find('div.tc_mean', 0)->plaintext,
                    'kanji' => $element->find('div.tc_ht', 0)->plaintext,
                    'examples' => $example,
                ]);
            }
        } catch (Exception $e) {
            throw new ApiException('Research fail');
        }

        return $results;
    }
}
