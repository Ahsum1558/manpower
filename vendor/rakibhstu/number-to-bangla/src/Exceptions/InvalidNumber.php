<?php

namespace Rakibhstu\Banglanumber\Exceptions;

use Exception;

class InvalidNumber extends Exception
{
    /**
     * @return static
     */
	public static function message()
	{
		return new static("The given value is not a valid number.");
	}
}
