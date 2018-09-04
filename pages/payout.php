<?php
global $variables;
global $in;

if (!$in['id']) {
    header("location: index.php");
    exit;
}
//check if he already has a payment request or if he has a minium debit
use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

$data = array_merge(
    $variables,
    [
        'pagename' => "Request Payout",
        'banks' => getBankList(),
        'maximum' => 5000,
        'minimum' => 1000
    ]
);

$shouldTwigDebug = true;
Twig\init('./templates', './templates/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());

echo Twig\render('payout.twig', $data);
