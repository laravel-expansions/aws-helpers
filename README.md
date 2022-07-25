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
```php
$response = lambda($functionName)->get($payload);
```

- ->push()

Executes the specified Lambda asynchronously. You will not receive any results.
```php
lambda($functionName)->push($payload);
```

### kinesis()

Returns my custom kinesis instance for simple operations.

- ->putRecord()

Send one record.
```php
kinesis()->putRecord($record);
```

- ->putRecords()

Send max 500 records.
```php
kinesis()->putRecords($records);
```

### ssm()

Returns my custom ssm instance for simple operations.

```php
$secret = ssm(['SecretName1', 'SecretName2']);

$secretValue1 = $secret->SecretName1;
$secretValue2 = $secret->SecretName2;
```

If you want not decryption value then set second argument to false.

```php
$secret = ssm(['SecretName1', 'SecretName2'], false);
```