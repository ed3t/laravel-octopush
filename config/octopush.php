<?php

/*
|--------------------------------------------------------------------------
| Octopush API Configuration
|--------------------------------------------------------------------------
|
| @see http://www.octopush.com/api-sms-documentation
|
*/


return [
  'api' => 'Octopush',
  'login' => env('SMS_API_LOGIN', 'your-email'),
  'api_key' => env('SMS_API_KEY', 'your-api-key'),
  'sms_mode' => env('SMS_MODE', 'octopush-sms-mode'),
  'sms_type' => env('SMS_TYPE', 'octopush-sms-type'),
  'sms_sender' => env('SMS_SENDER', 'your-app-name'),
];
