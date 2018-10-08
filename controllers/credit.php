<?php
global $variables;
global $i;
global $in;

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

if (!$in['id']) {
    header("location: index.php");
    exit;
}

if ($amount = Request\post('amount')) {
    $reference = uniqid();
    $payment = R::dispense('payments');
    $payment->userid = $in['id'];
    $payment->reference = $reference;
    $payment->amount = $amount;
    $payment->date = date("Y-m-d H:i:s");
    R::store($payment);
    
    Response\json(
        [
            'amount' => $amount * 100, 
            'reference' => $reference,
            'key' => $i['paga_mode']? $i['paga_live_public_key'] : $i['paga_test_public_key'],
            'email' => $in['email'],
            'phone' => $in['phone'],
        ]
    );
    exit;
}

if ($reference = Request\get('reference')) {
    $key = $i['paga_mode']? $i['paga_live_private_key'] : $i['paga_test_private_key'];
    $response = verifyPayment($key, $reference);
    error_log('paystack response: '.json_encode($response));
    if ($response['status']) {
        $payment = R::findOne('payments', ' reference = ?', [$reference]);
        $payment['verified'] = true;
        $payment['verify_data'] = serialize($response);
        $payment['modified_date'] = date("Y-m-d H:i:s");
        R::store($payment);
        
        $user = R::findOne('users', ' email = ?', [$response['data']['customer']['email']]);
        $user['balance'] += $response['data']['amount']/100;
        R::store($user);
        Response\json(
            [
                'balance' => $user['balance'],
            ]
        );
        exit;
    } else {
        $payment = R::findOne('payments', ' reference = ?', [$reference]);
        $payment['verify_data'] = serialize($response);
        $payment['verified'] = false;
        $payment['modified_date'] = date("Y-m-d H:i:s");
        R::store($payment);
        Response\json(['error' => true, 'message' => $e->getMessage()], 500);
        exit;
    }    
    
}

$data = array_merge(
    $variables,
    [
        'pagename' => "Load Account",
    ]
);

$shouldTwigDebug = true;
$twig = Twig\init('./views', './views/cache', $shouldTwigDebug);
$twig->addExtension(new Twig_Extension_Debug());
//$twig->addExtension(new Umpirsky\Twig\Extension\PhpFunctionExtension());

echo Twig\render('credit.twig', $data);
