<?php

namespace Phpro\SoapClient\Exception;

use Throwable;

/**
 * Class SoapException
 *
 * @package Phpro\SoapClient\Exception
 */
class SoapException extends RuntimeException
{
    /**
     * @var mixed
     */
    private $detail;

    public function __construct($message = "", $code = 0, Throwable $previous = null, $detail = null)
    {
        $this->detail = $detail;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param \Throwable $throwable
     *
     * @return SoapException
     */
    public static function fromThrowable(\Throwable $throwable): self
    {
        $detail = null;

        if ($throwable instanceof \SoapFault) {
            $detail = $throwable->detail;
        }

        return new self($throwable->getMessage(), (int)$throwable->getCode(), $throwable, $detail);
    }

    public function getDetail()
    {
        return $this->detail;
    }
}
