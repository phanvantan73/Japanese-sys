<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'], function() {
    Route::get('login', 'Auth\LoginController@getLogin')->name('get_login');
    Route::post('login', 'Auth\LoginController@postLogin')->name('post_login');
    Route::post('logout', 'Auth\LoginController@logout')->name('post_logout');

    Route::group(['namespace' => 'Admin', 'middleware' => 'auth'], function() {
    	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    	Route::resource('users', 'UserController');
    	Route::resource('courses', 'CourseController');
    	Route::resource('lessons', 'LessonController');
    	Route::resource('questions', 'QuestionController');
    	Route::resource('vocabularies', 'VocabularyController');
    });
});

Route::get('get-ka', function() {
    $html = file_get_html('https://www.nhk.or.jp/lesson/vi/letters/katakana.html');

    foreach ($html->find('img') as $key => $el) {
        echo $el->src . '</br>';
        // if ($key === 0) {
        //     continue;
        // }

        // $fileName = Arr::last(explode('/', $el->src));
        // $image = file_get_contents('https://www.nhk.or.jp' . $el->src);

        // if ($this->isDetailLetter($el->src)) {
        //     Storage::put('public/alphabets/hiragana/detail/' . $fileName, $image);
        //     $alphabet = Alphabet::firstOrCreate([
        //         'content' => Arr::first(explode('.', $fileName)),
        //         'type' => 1,
        //         'image' => str_replace('storage', 'public', Storage::url('public/alphabets/hiragana/' . $fileName)),
        //     ]);
        //     $alphabet->detail()->create([
        //         'description' => str_replace('storage', 'public', Storage::url('public/alphabets/hiragana/detail/' . $fileName)),
        //     ]);
        // } else {
        //     Storage::put('public/alphabets/hiragana/' . $fileName, $image);
        //     $alphabet = Alphabet::updateOrCreate(
        //         [
        //             'content' => Arr::first(explode('.', $fileName)),
        //             'type' => 1,
        //             'image' => str_replace('storage', 'public', Storage::url('public/alphabets/hiragana/' . $fileName)),
        //         ]
        //     );
        // }
    }
});
