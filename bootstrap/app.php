<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $exception, Request $request) {
            if($request->is("api/*")){
                return response()->json([
                    'mensaje' => 'Recurso no encontrado',
                ], Response::HTTP_NOT_FOUND);
            }
            throw $exception;
        });

         $exceptions->render(function (ValidationException $exception, Request $request) {
            if($request->is("api/*")){
                return response()->json([
                    'mensaje' => 'Error de validation',
                    'errors' => $exception->errors(),
                ], Response::HTTP_NOT_FOUND);
            }
            throw $exception;
         });
         $exceptions->dontReportDuplicates();


    })->create();
