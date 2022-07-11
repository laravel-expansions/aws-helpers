<?php

namespace LaravelExpansions\AwsHelpers\Services;

use Aws\Kinesis\KinesisClient; 
use Aws\Exception\AwsException;
use Illuminate\Support\Str;
use Exception;

class Kinesis
{
    protected $kinesisClient;

    /**
     * Kinesisインスタンスを作成します。
     */
    public function __construct()
    {
        $this->kinesisClient = new KinesisClient([
            //'profile' => 'default',
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => '2013-12-02',
        ]);
    }

    /**
     * １件のレコードを送信します。
     * 
     * @param  object  $record
     * @return  object
     */
    public function putRecord($record)
    {
        try {
            return $this->kinesisClient->PutRecord([
                'StreamName' => env('STREAM_NAME'),
                'PartitionKey' => (string) Str::uuid(),
                'Data' => collect($record)->toJson(),
            ]);
        } catch (AwsException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 最大500件のレコードを送信します。
     * 
     * @param  array  $records
     * @return object
     */
    public function putRecords($records)
    {
        try {
            return $this->kinesisClient->putRecords([
                'StreamName' => env('STREAM_NAME'),
                'Records' => collect($records)
                ->map(function ($record) {
                    return [
                        'PartitionKey' => (string) Str::uuid(),
                        'Data' => collect($record)->toJson(),
                    ];
                })
                ->toArray(),
            ]);
        } catch (AwsException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
