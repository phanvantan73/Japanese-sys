<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiException extends HttpException
{
    private $errorCode;
    private $errorMessage;
    private $errorExtra;

    /**
     * ApiException constructor
     *
     * @param string $errorName
     * @param string $errorMessage
     * @param array $errorExtra
     * @param integer $httpCode
     * @param Exception $previous
     * @param array $headers
     * @param integer $code
     *
     * @return void
     */
    public function __construct(
        $errorName,
        $errorMessage = null,
        $errorExtra = [],
        $httpCode = 400,
        Exception $previous = null,
        array $headers = [],
        int $code = 0
    ) {
        $this->errorCode = __('messages.custom_error.' . $errorName . '.code');

        $this->errorMessage = $errorMessage ?? __('messages.custom_error.' . $errorName . '.description');

        if (!empty($errorExtra)) {
            $this->errorExtra = $errorExtra;
        }

        parent::__construct($httpCode, $this->errorMessage, $previous, $headers, $code);
    }

    /**
     * Get error code
     *
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Get error message
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Get error extra
     *
     * @return array
     */
    public function getErrorExtra()
    {
        return $this->errorExtra;
    }
}
