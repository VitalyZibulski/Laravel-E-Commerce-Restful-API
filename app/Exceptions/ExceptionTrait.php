<?php

namespace App\Exceptions;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait{
	/**
	 * @param $request
	 * @param $e
	 * @return \Illuminate\Http\JsonResponse
	 *
	 */
	public function apiException($request, $e)
	{
		if ($this->isModel($e)) {
			return $this->ModelResponse($e);
		}

		if ($this->isHttp($e)) {
			return $this->HttpResponse();
		}

		return parent::render($request, $exception);
	}

	protected function isModel($e){
		return $e instanceof ModelNotFoundException;
	}

	protected function isHttp($e){
		return $e instanceof lNotFoundHttpException;
	}

	protected function ModelResponse($e){
		return response()->json([
			'errors' => 'Product Model not found'
		], Response::HTTP_NOT_FOUND);
	}

	protected function HttpResponse($e){
		return response()->json([
			'errors' => 'Incorrect route'
		], Response::HTTP_NOT_FOUND);
	}
}



