<?php

use App\Models\Alphabet;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KatakanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $html = file_get_html('https://www.nhk.or.jp/lesson/vi/letters/katakana.html');

        DB::beginTransaction();

        try {
            foreach ($html->find('img') as $key => $el) {
                if ($key === 0) {
                    continue;
                }

                $fileName = Arr::last(explode('/', $el->src));
                $content = Arr::first(explode('.', $fileName));
                $resource = Alphabet::where('content', $content)->first();
                $audio = $resource ? $resource->getOriginal('audio') : '';
                $image = file_get_contents('https://www.nhk.or.jp' . $el->src);

                if ($this->isDetailLetter($el->src)) {
                    Storage::put('public/alphabets/katakana/detail/' . $fileName, $image);
                    $alphabet = Alphabet::firstOrCreate([
                        'content' => $content,
                        'type' => 2,
                        'image' => 'public/alphabets/katakana/' . $fileName,
                        'audio' => $audio,
                    ]);
                    $alphabet->detail()->create([
                        'description' => 'public/alphabets/katakana/detail/' . $fileName,
                    ]);
                } else {
                    Storage::put('public/alphabets/katakana/' . $fileName, $image);
                    $alphabet = Alphabet::updateOrCreate(
                        [
                            'content' => $content,
                            'type' => 2,
                            'image' => 'public/alphabets/katakana/' . $fileName,
                            'audio' => $audio,
                        ]
                    );
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    private function isDetailLetter(string $str)
    {
        return strpos($str, 'detail') !== false;
    }
}
