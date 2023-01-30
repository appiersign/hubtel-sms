# Hubtel SMS
A composer package that integrates Hubtel's SMS API. This version only supports sending single SMS. 

Install package with the code below:

```composer require appiersign/hubtel-sms```

Import and Create an instance of the sender class

```
use AppierSign\HubtelSMS\HubtelSMS;

$sms = new HubtelSMS($apiId, $apiSecret, $senderId)
```

Call send() on the instance and pass the phone number and message as seen below:

```
$response = $sms->send('2332496xxxxx', 'your text message');
```
