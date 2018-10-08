<?php
global $variables;
global $in;
global $i;
global $error;

if (!$in['id']) {
    header("location: index.php");
    exit;
}
//check if he already has a payment request or if he has a minium debit
use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

$user = R::load('users', $in['id']);
if (!empty($in['holding']) || !empty($in['request'])) {
    header("location: payment.php");
    exit;
}

if ($id = Request\get('request') && $id == $in['request']) {
    $payout = R::load('payout_requests', $in['request']);
    if ($payout->status == "Processing" || $payout->status == "Paid") {
        $error = "Your payout has been initiated and cannot be cancelled";
    } else {
        $payout->status = "Cancelled";
        R::store($payout);
        $user->holding = 0;
        $user->request = null;
        R::store($user);
        $success = "Your payout request has been successfully cancelled";
    }
    

}

$key = $i['paga_mode']? $i['paga_live_private_key'] : $i['paga_test_private_key']; 
$data = array_merge(
    $variables,
    [
        'pagename' => "Request Payout",
        'banks' => getBankList($key),
        'maximum' => $in['balance'],
        'minimum' => 1000
    ]
);

$shouldTwigDebug = true;
$twig = Twig\init('./views', './views/cache', $shouldTwigDebug);
$twig->addExtension(new Twig_Extension_Debug());
$twig->addGlobal('_session', $_SESSION);
$twig->addGlobal('_post', $_POST);
$twig->addGlobal('_get', $_GET);

echo Twig\render('payout.twig', $data);
