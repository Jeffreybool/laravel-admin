<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/11/11
 * Time: 12:14
 */

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthorizeException extends HttpException
{
    /**
     * Create a new logic exception instance.
     *
     * @param string                               $message
     * @param int                                  $code
     * @param \Exception                           $previous
     * @param array                                $headers
     *
     * @return void
     */
    public function __construct($message = null, $code = 0, Exception $previous = null, $headers = [])
    {
        parent::__construct(401, $message, $previous, $headers, $code);
    }
}