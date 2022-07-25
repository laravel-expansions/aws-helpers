<?php

use LaravelExpansions\AwsHelpers\Services\Ssm;

if (! function_exists('ssm')) {
    /**
     * @param  array  $secretNames
     * @param  boolean  $withDecryption (optional) default: ture
     * @return  Ssm
     */
    function ssm($secretNames, $withDecryption=true)
    {
        $ssm = new Ssm($secretNames, $withDecryption);
        return $ssm->get();
    }
}
