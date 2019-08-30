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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'QuestionController@index')->name('home');
Route::resource('/question', 'QuestionController')->except('show');
Route::get('/question/{slug}', 'QuestionController@show')->name('question.show');
Route::post('/answer/{answer}/accept', 'AcceptAnswerController')->name('answer.accept');

Route::resource('questions.answers', 'AnswerController')->except(['create', 'show']);
Route::post('/questions/{question}/favorites', 'FavoritesController@store')->name('questions.favorite');
Route::delete('/questions/{question}/favorites', 'FavoritesController@destroy')->name('questions.unfavorite');

Route::post('/questions/{question}/vote', 'VoteQuestionController');
Route::post('/answers/{answer}/vote', 'VoteAanswerController');
Route::resource('/api/tasks', 'TaskController');
Route::get('/taskPage', 'TaskController@task_page')->name('taskpage');;