<?php
global $variables;

use Siler\Twig;
$data = array_merge(
    $variables,
    [
        'pagename' => "Load Account",
    ]
);

$shouldTwigDebug = true;
$twig = Twig\init('./templates', './templates/cache', $shouldTwigDebug);
$twig->addExtension(new Twig_Extension_Debug());
//$twig->addExtension(new Umpirsky\Twig\Extension\PhpFunctionExtension());

echo Twig\render('error.twig', $data);