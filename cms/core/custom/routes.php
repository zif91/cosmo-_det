<?php

use EvolutionCMS\Main\Services\LeadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::post('/api/lead', function (Request $request) {
    $result = (new LeadService())->handle($request->all());

    return Response::json($result, $result['ok'] ? 200 : 422);
});
