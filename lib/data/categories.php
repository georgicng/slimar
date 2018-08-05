<?php 
use RedBeanPHP\Facade as R;

return R::find('games_categories', ' status = ? ORDER BY id', [ 1 ]);
