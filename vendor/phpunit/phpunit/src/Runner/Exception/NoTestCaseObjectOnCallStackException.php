<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Runner;

use RuntimeException;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class NoTestCaseObjectOnCallStackException extends RuntimeException implements Exception
{
    public function __construct()
    {
        parent::__construct('Cannot find TestCase object on call stack');
    }
}
