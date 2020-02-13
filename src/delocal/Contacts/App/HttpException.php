<?php


namespace delocal\Contacts\App;


use Throwable;

class HttpException extends \Exception
{
	protected $statusCode;

	public function __construct($statusCode, $message = "", $code = 0, Throwable $previous = null)
	{

		$this->statusCode = $statusCode;
		parent::__construct($message, $code, $previous);
	}
}