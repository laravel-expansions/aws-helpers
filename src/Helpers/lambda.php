<?php

use LaravelExpansions\AwsHelpers\Services\Lambda;

if (! function_exists('lambda')) {
    /**
     * @return Lambda
     */
    function lambda(string $functionName)
    {
        return new Lambda($functionName);
    }
}
