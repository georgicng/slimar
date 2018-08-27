<?php
//require_once SITE_ROOT.'/inc/config.php';
//require_once SITE_ROOT.'/lib/db.php';
//$variables = include SITE_ROOT.'/lib/variables.php';
global $variables;

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

$sort = Request\get('s');
$cat = Request\get('c');

$category = R::findOne('games_categories', ' title = ?', [$cat]);
                    
$primary = null;
$query = ' status = ? && category_id = ?';

switch ($sort) {
    case "rated":
        $primary = "rated";
        $query .= ' ORDER BY current_votes DESC';
        break;
    case "popular":
        $primary= "popular";
        $query .= ' ORDER BY view_count DESC';
        break;
    case "random":
        $primary= "random";
        $query = ' ORDER BY rand()';
        break;
    default:
        $primary= "latest";
        $query .= ' ORDER BY id DESC';
}

$data = array_merge(
    $variables,
    [
        'pagename' => "Category: ".$cat,
        'games' => R::find('games', $query, [1, $category['id']]),
        'sort' => $sort,
        'primary' => $primary,
        'category' => $category
    ]
);

$shouldTwigDebug = true;
Twig\init('./templates', './templates/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());
    
echo Twig\render('cat.twig', $data);
