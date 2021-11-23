# Laravel Octopush Package

[![Latest Stable Version](https://poser.pugx.org/usefulsomebody/laravel-octopush-sdk/v/stable)](https://packagist.org/packages/usefulsomebody/laravel-octopush-sdk)
[![Total Downloads](https://poser.pugx.org/usefulsomebody/laravel-octopush-sdk/downloads)](https://packagist.org/packages/usefulsomebody/laravel-octopush-sdk)
[![Latest Unstable Version](https://poser.pugx.org/usefulsomebody/laravel-octopush-sdk/v/unstable)](https://packagist.org/packages/usefulsomebody/laravel-octopush-sdk)
[![License](https://poser.pugx.org/usefulsomebody/laravel-octopush-sdk/license)](https://packagist.org/packages/usefulsomebody/laravel-octopush-sdk)
[![composer.lock](https://poser.pugx.org/usefulsomebody/laravel-octopush-sdk/composerlock)](https://packagist.org/packages/usefulsomebody/laravel-octopush-sdk)

Laravel package to send SMS using [Octopush.com](http://www.octopush.com/) API


## Installation

```
composer require usefulsomebody/laravel-octopush-sdk
```

To run tests

```
composer test
```

## Configuration

In your .env defined configuration

```
...

SMS_API_LOGIN=your-email
SMS_API_KEY=your-api-key
```

## Usages


### Get Credit

```php
<?php
...
$api = $this->app->make('octopush');
$credit = $api->getCredit();
?>
<pre>
Remaining Credit :  <?php echo $credit;?> &euro;
</pre>

```

### Get Balance

```php
<?php
...
$api = $this->app->make('octopush');
$balance = $api->getBalance();
$premium = $api->getPremiumBalance();
$low = $api->getLowCostBalance();
?>
<pre>
  <?php var_dump(balance);?>

  Remaining Sms Low cost :  <?php echo $low;?>

  Remaining Sms Premium :  <?php echo $premium;?>
</pre>

```

### Send a simple message

```php
<?php
...
$api = $this->app->make('octopush');
$message = 'this is a simple sms message';
$api->sendMessage($message, [
  'sms_recipients' => TEST_PHONE_NUMBER,
  'sms_text' => $message,
  'sms_type' => Message::SMS_PREMIUM,
  'sms_sender' => 'Laravel Octopush',
]);
?>
<pre>
<?php echo var_dump($api->getResponse());?>
</pre>

```

### Send a publipostage message

```php
<?php
$api = $this->app->make('octopush');

$message = 'Hello {ch1} {nom} {prenom}, your session begin at {ch2} the {ch3}';

$api->sendMessage($message, [
  'sms_recipients' => [TEST_PHONE_NUMBER, TEST_PHONE_NUMBER_ALT],
  'sms_text' => $message,
  'sms_type' => Message::SMS_PREMIUM,
  'sms_sender' => 'Laravel Octopush sdk',
  'request_mode' => Message::SIMULATION_MODE,
  'recipients_first_names' => ['John', 'Jane'],
  'recipients_last_names' => ['John', 'Jane'],
  'sms_fields_1' => ['Mr', 'Miss'],
  'sms_fields_2' => ['08:00 am', '01:00 pm'],
  'sms_fields_3' => ['2021/11/21', '2021/11/22'],
]);
?>
<pre>
<?php echo var_dump($api->getResponse());?>
</pre>
```
