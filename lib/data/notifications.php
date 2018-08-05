<?php 
use RedBeanPHP\Facade as R;

return R::find('site_notifications', ' enabled = ? ORDER BY id', [ 1 ]);
