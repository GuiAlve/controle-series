<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('/series', \App\Http\Controllers\Api\SerieApiControler::class);

    Route::get('/series/{series}/seasons', function (\App\Models\Series $series) {
        return $series->seasons;
    });

    Route::get('/series/{series}/episodes', function (\App\Models\Series $series) {
        return $series->episodes;
    });
    Route::patch('/episodes/{episode}', function (\App\Models\Episode $episode, Request $request) {

        $episode->watched = $request->watched;
        $episode->save();

        return $episode;
    });

    Route::post('/series/uploadImage', [\App\Http\Controllers\Api\SerieApiControler::class, 'uploadImage']);

});

Route::post('/login', function (Request $request){
    $credencitals = $request->only(['email', 'password']);
    if (Auth::attempt($credencitals) === false){
        return response()->json('Unauthorized', '401');
    }

    $user = Auth::user();
    $token = $user->createToken('token');

    return response()->json($token->plainTextToken);
});


