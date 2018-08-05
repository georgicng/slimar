<?php
require_once SITE_ROOT.'/inc/config.php';
require_once SITE_ROOT.'/lib/db.php';

$variables = include SITE_ROOT.'/lib/variables.php';

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;


$sort = Request\get('s');
$cat = Request\get('c');
$search = Request\post('search-text');

if (!empty($search)) {
    if (!empty(Request\get('go')) { 
        //Extra input security. Only letters and numbers are allowed
        if (preg_match("/[^A-Za-z0-9\ ]/", $search)) {
            $searchvalue = "error-wrong";
        } else {
            $searchvalue = $search; 
        }
    } else { 
        $searchvalue = "error-wrong";
    } 
}

$category = R::findOne('games_categories', ' title = ?', [$cat]);

$games = R::find('games', ' status = `1` && title LIKE ? ORDER BY id DESC', [$searchvalue]);

$data = array_merge(
    $variables,
    [
        'pagename' => "Search: ".$cat,
        'sort' => $sort,
        'games' => $games,
        'category' => $category
    ]
);

$shouldTwigDebug = true;
Twig\init('./templates', './templates/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());
    
echo Twig\render('cat.twig', $data);
