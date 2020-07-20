<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\HttpFoundation\Response;

Trait ApiExceptionTrait
{
    public function apiRequestException($request, $exception)
    {
    	if($exception instanceof ModelNotFoundException){
	        return response()->json([
	            'errors' => 'RECORD NOT FOUND'
	        ], Response::HTTP_NOT_FOUND);
	    }elseif($exception instanceof NotFoundHttpException){
	        return response()->json([
	            'errors' => 'URL NOT FOUND'
	        ], Response::HTTP_NOT_FOUND);
	    }
	    return parent::render($request, $exception);
    }
}
