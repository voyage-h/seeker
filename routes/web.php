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

Route::get('/','QuestionController@index');

Auth::routes();

//问题添加
Route::resource('question','QuestionController');

//回答
Route::post('question/{questionId}/answer','AnswerController@store')->name('question.answer');

//标签
Route::get('/label/{id}','LabelController@show')->name('label.show');

//用户
Route::get('/user/{id?}','UserController@show')->name('user.show');
Route::get('/user/{id?}/questions','UserController@show')->name('user.questions');
Route::get('/user/{id?}/answers','UserController@show')->name('user.answers');
Route::get('/user/{id?}/follows','UserController@show')->name('user.follows');
Route::get('/user/{id?}/followers','UserController@show')->name('user.followers');

//头像
Route::post('/user/avatar','UserController@avatar')->name('user.avatar');
    
//点赞
Route::get('/answer/{id}/like','LikeController@answer')->name('answer.like');

//关注
Route::get('/user/{id}/follow','FollowController@user')->name('user.follow');
Route::get('/question/{id}/follow','FollowController@question')->name('question.follow');
Route::get('/label/{id}/follow','FollowController@label')->name('label.follow');

//评论
Route::get('/answer/{id}/comment','CommentController@answer')->name('answer.comment');
Route::get('/question/{id}/comment','CommentController@question')->name('question.comment');
Route::post('/comment','CommentController@store')->name('comment.store');

//通知
Route::get('/notification/show','NotificationController@show')->name('notification.show');
Route::get('/notification/read','NotificationController@read')->name('notification.read');

//私信
Route::post('/user/message','messagecontroller@store')->name('user.message');
Route::get('/user/{id}/message','messagecontroller@show')->name('message.read');

//搜索
Route::get('/search/content','SearchController@content')->name('search.content');
Route::get('/search/user','SearchController@user')->name('search.user');
Route::get('/search/label','SearchController@label')->name('search.label');
