<?php

namespace App\Traits;

use Log;
use Exception;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

trait RestExceptionHandlerTrait
{
    /**
     * Creates a new JSON response based on exception type.
     *
     * @param Request $request
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException($e)
    {
        if (config('app.env') !== 'production') {
            Log::error($e->getMessage());
        }

        switch (true) {
            case $this->isAuthenticationException($e):
                $retval = $this->unauthorized();
                break;
            case $this->isNotFoundHttpException($e):
                $retval = $this->notFoundHttp();
                break;
            case $this->isModelNotFoundException($e):
                $retval = $this->modelNotFound();
                break;
            case $this->isMethodNotAllowedHttpException($e):
                $retval = $this->methodNotFound();
                break;
            case $this->isApiException($e):
                $retval = $this->handleApiException($e);
                break;
            default:
                $retval = $this->badRequest();
                break;
        }

        return $retval;
    }

    /**
     * Returns json response for generic bad request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function badRequest()
    {
        return $this->jsonResponse('bad_request');
    }

    /**
     * Returns json response for unauthorized exception.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function unauthorized()
    {
        return $this->jsonResponse('unauthorized');
    }

    /**
     * Returns json response for not found http exception.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function notFoundHttp()
    {
        return $this->jsonResponse('not_found_http');
    }

    /**
     * Returns json response for eloquent model not found exception.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function modelNotFound()
    {
        return $this->jsonResponse('model_not_found');
    }

    /**
     * Returns json response for method not found exception.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function methodNotFound()
    {
        return $this->jsonResponse('method_not_allow');
    }

    /**
     * Returns json response for ApiException.
     *
     * @param ApiException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function handleApiException(ApiException $exception, $statusCode = 400)
    {
        $response = [
            'error' => [
                'error_code' => $exception->getErrorCode(),
                'error_description' => $exception->getErrorMessage(),
            ],
        ];

        $errorExtra = $exception->getErrorExtra();

        if ($errorExtra) {
            $response['error']['error_extra'] = $errorExtra;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Returns json response.
     *
     * @param string $errorName
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse($errorName, $statusCode = 400)
    {
        $response = [
            'error' => [
                'error_code' => __('messages.custom_error.' . $errorName . '.code'),
                'error_description' => __('messages.custom_error.' . $errorName . '.description'),
            ],
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * Determines if the given exception is not found http.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isNotFoundHttpException(Exception $e)
    {
        return $e instanceof NotFoundHttpException;
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isModelNotFoundException(Exception $e)
    {
        return $e instanceof ModelNotFoundException;
    }

    /**
     * Determines if the given exception is wrong router method.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isMethodNotAllowedHttpException(Exception $e)
    {
        return $e instanceof MethodNotAllowedHttpException;
    }

    /**
     * Determines if the given exception is unauthentication.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isAuthenticationException(Exception $e)
    {
        return $e instanceof AuthenticationException;
    }

    /**
     * Determines if the given exception is ApiException.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isApiException(Exception $e)
    {
        return $e instanceof ApiException;
    }
}
