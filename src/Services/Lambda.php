<?php

namespace LaravelExpansions\AwsHelpers\Services;

use Aws\Lambda\LambdaClient;
use Aws\Lambda\Exception\LambdaException;
use Illuminate\Support\Str;
use Exception;

class Lambda
{
    protected $lambdaClient;
    protected $functionName;

    /**
     * Lambdaインスタンスを作成します。
     * 
     * @param  string  $functionName 起動するLambda関数名
     */
    public function __construct(string $functionName)
    {
        $this->functionName = $functionName;
        $this->lambdaClient = LambdaClient::factory(array(
            //'profile' => 'default',
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => '2015-03-31'
        ));
    }

    /**
     * 指定のLambdaを起動して結果を取得します。
     * 
     * @param  object  $payload
     * @return LambdaResponse
     */
    public function get($payload)
    {
        return $this->invoke($payload, 'RequestResponse');
    }

    /**
     * 指定のLambdaを起動します。結果は受け取りません。
     * 
     * @param  object  $payload
     * @return promise
     */
    public function push($payload)
    {
        return $this->invoke($payload, 'Event');
    }

    /**
     * プライベートメソッド
     */
    protected function invoke($payload, $invocationType)
    {
        try {
            return $this->lambdaClient->invoke([
                'FunctionName' => $this->functionName,
                'InvocationType' => $invocationType,
                'LogType' => 'Tail',
                'Payload' => collect($payload)->toJson(),
            ]);
        } catch (LambdaException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
