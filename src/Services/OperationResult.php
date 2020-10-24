<?php

namespace Core\Services;

class OperationResult
{   
    /**
     * if this operation was successful
     *
     * @var bool
     */
    protected $success;

    /**
     * error code if operation was not successful
     *
     * @var int
     */
    protected $error;

    /**
     * initializes an operation error
     *
     * @param bool $success
     * @param int|null $errorCode
     */
    public function __construct($success, $errorCode = null) {
        $this->success = $success;
        $this->error = $errorCode;
    }

    /**
     * creates a new successful result
     *
     * @return OperationResult
     */
    public static function createSuccess() {
        return new static(true);
    }

    /**
     * creates a new failed result
     *
     * @param int $code
     * @return OperationResult
     */
    public static function createFail($code) {
        return new static(false, $code);
    }

    /**
     * @return boolean
     */
    public function isSuccess() {
        return $this->success;
    }

    /**
     * @return int
     */
    public function getErrorCode() {
        return $this->error;
    }

    /**
     * @return string
     */
    public function getErrorMessage() {
        if ($this->error) {
            return OperationErrors::getErrorMessage($this->error);
        }
        return false;
    }
}