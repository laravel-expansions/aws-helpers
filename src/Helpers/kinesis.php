<?php

use LaravelExpansions\AwsHelpers\Services\Kinesis;

if (! function_exists('kinesis')) {
    /**
     * @return Kinesis
     */
    function kinesis()
    {
        return new Kinesis;
    }
}
