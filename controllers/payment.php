<?php
global $variables;
global $in;
global $error;

if (!$in['id']) {
    header("location: index.php");
    exit;
}
//check if he already has a payment request or if he has a minium debit
use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;

$user = R::load('users', $in['id']);
if (empty($in['request'])) {
    header("location: payout.php");
    exit;
}

$payout = R::load('payout_requests', $in['request']);
switch($payout['status']) {
    case 'Pending';
        $title = "Request Pending";
        $message = "Your payout request is under review. You will be updated via email after processing";
        $action = '<a href="payout.php?request='.$in['request'].'" class="btn btn-lg btn-secondary">Cancel Request</a>';
        break;
    case 'Approved';
        $title = "Request Approved";
        $message = 'Your payment is currently been processed';
        $action = '<a href="#" class="btn btn-lg btn-secondary">Confirm Receipt</a><a href="contact.php" class="btn btn-lg btn-secondary">Report an Issue</a>';
        break;
    default:
        $title = "Payment Request Status";
        $message = 'We cannot verify the status of your request, please contact 080-chapgames for updates.';
        $action = '<a href="#" class="btn btn-lg btn-secondary">Go back</a>';
}

$data = array_merge(
    $variables,
    [
        'pagename' => "Payment Request Status",
        'title' => $title,
        'message' => $message,
        'action' => $action
    ]
);

$shouldTwigDebug = true;
$twig = Twig\init('./views', './views/cache', $shouldTwigDebug);
$twig->addExtension(new Twig_Extension_Debug());

echo Twig\render('payment.twig', $data);
