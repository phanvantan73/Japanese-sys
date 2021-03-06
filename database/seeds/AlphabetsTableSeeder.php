<?php

use App\Models\Alphabet;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AlphabetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            $html = file_get_html('https://www.nhk.or.jp/lesson/vi/letters/hiragana.html');

            foreach ($html->find('img') as $key => $el) {

                if ($key === 0) {
                    continue;
                }

                $fileName = Arr::last(explode('/', $el->src));
                $image = file_get_contents('https://www.nhk.or.jp' . $el->src);

                if ($this->isDetailLetter($el->src)) {
                    Storage::put('public/alphabets/hiragana/detail/' . $fileName, $image);
                    $alphabet = Alphabet::firstOrCreate([
                        'content' => Arr::first(explode('.', $fileName)),
                        'type' => 1,
                        'image' => str_replace('storage', 'public', Storage::url('public/alphabets/hiragana/' . $fileName)),
                    ]);
                    $alphabet->detail()->create([
                        'description' => str_replace('storage', 'public', Storage::url('public/alphabets/hiragana/detail/' . $fileName)),
                    ]);
                } else {
                    Storage::put('public/alphabets/hiragana/' . $fileName, $image);
                    $alphabet = Alphabet::updateOrCreate(
                        [
                            'content' => Arr::first(explode('.', $fileName)),
                            'type' => 1,
                            'image' => str_replace('storage', 'public', Storage::url('public/alphabets/hiragana/' . $fileName)),
                        ]
                    );
                }
            }

            $html1 = file_get_html('https://www.thoughtco.com/how-to-pronounce-hiragana-japanese-hiragana-with-audio-files-4077351');
            foreach ($html1->find('tr') as $key => $value) {
                foreach ($value->find('a') as $k => $v) {
                    $fileName = Arr::last(explode('/', $v->href));
                    $audio = file_get_contents($v->href);
                    Storage::put('public/alphabets/hiragana/' . $fileName, $audio);
                    $let = Arr::first(explode('.', $fileName));
                    Alphabet::where('content', $let)->update([
                        'audio' => 'public/alphabets/hiragana/' . $fileName,
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            DB::rollback();
        }
    }

    private function isDetailLetter(string $str)
    {
        return strpos($str, 'detail') !== false;
    }
}
