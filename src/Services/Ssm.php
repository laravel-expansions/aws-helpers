<?php

namespace LaravelExpansions\AwsHelpers\Services;

use Aws\Ssm\SsmClient;
use Aws\Exception\AwsException;
use Exception;

class Ssm
{
    protected $client;
    protected $secretNames;
    protected $withDecryption;

    /**
     * SSMインスタンスを作成します。
     */
    public function __construct($secretNames, $withDecryption=true)
    {
        $this->client = new SsmClient([
            'version' => '2014-11-06',
            'region' => env('AWS_DEFAULT_REGION'),
        ]);
        $this->secretNames = $secretNames;
        $this->withDecryption = $withDecryption;
    }

    /**
     * Get Secret Object
     * 
     * @return  object
     */
    public function get()
    {
        try {
            $result = $this->client->getParameters([
                'Names' => collect($this->secretNames)->toArray(),
                'WithDecryption' => $this->$withDecryption,
            ]);
            return (object) collect($result['Parameters'])
            ->mapWithKeys(function ($item) {
                return [$item['Name'] => $item['Value']];
            })
            ->toArray();
        } catch (AwsException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
