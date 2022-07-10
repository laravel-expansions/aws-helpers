# AWS Helpers
Simple AWS SDK Helpers

## Install

Please install in an existing Laravel project.
```
composer require laravel-expansions/aws-helpers
```

## Helpers

### lambda()

Returns my custom lambda instance for simple operations.

- ->get()

Synchronize the specified Lambda and get the result.
```
$response = lambda($functionName)->get($payload);
```

- ->push()

Executes the specified Lambda asynchronously. You will not receive any results.
```
lambda($functionName)->push($payload);
```

### kinesis()

Returns my custom kinesis instance for simple operations.

- ->putRecord()

Send one record.
```
kinesis()->putRecord($record);
```

- ->putRecords()

Send max 500 records.
```
kinesis()->putRecords($records);
```
