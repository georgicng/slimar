<?php
global $i;
use RedBeanPHP\Facade as R;
$key = $i['paga_mode']? $i['paga_live_private_key'] : $i['paga_test_private_key'];

// Retrieve the request's body
$body = @file_get_contents("php://input");
$signature = (isset($_SERVER['HTTP_X_PAYSTACK_SIGNATURE']) ? $_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] : '');

/* It is a good idea to log all events received. Add code *
 * here to log the signature and body to db or file       */

if (!$signature) {
    // only a post with paystack signature header gets our attention
    exit();
}

// confirm the event's signature
if ($signature !== hash_hmac('sha512', $body, $key)) {
    // silently forget this ever happened
    exit();
}

http_response_code(200);
// parse event (which is json string) as object
// Give value to your customer but don't give any output
// Remember that this is a call from Paystack's servers and
// Your customer is not seeing the response here at all
$event = json_decode($body);
switch ($event->event) {
    // charge.success
    case 'charge.success':
        $payment = R::findOne('payments', ' reference = ?', [$event->data->reference]);
        $payment['charged'] = true;
        $payment['charge_data'] = serialize(event);
        $payment['modified_date'] = date("Y-m-d H:i:s");
        R::store($payment);
        break;
    case 'transfer.success':
        $recipient = $event->data->recipient->recipient_code;
        $payout = R::findOne('payouts', ' recipient = ? and status = ?', [$recipient, 'otp']);
        $payout['status'] = 'Completed';
        $payout['date_modified'] = date("Y-m-d H:i:s");
        R::store($payout);        
        $user = R::load('users', $payout['user_id']);
        $user['holding'] = 0;
        R::store($user); 
        //send email
        $subject = "Transfer Completed";
        $message = "Your transfer has been made.";
        mailer($i, $user['email'], $subject, $message);
        break;
}
exit();
