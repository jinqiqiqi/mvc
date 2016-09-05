<?php

define('PUBLIC_PATH', __DIR__. '/');
define('BASE_PATH', PUBLIC_PATH. '../');

// Autoload 
require BASE_PATH. 'vendor/autoload.php';


require BASE_PATH. 'config/bootstrap.php';

require BASE_PATH. 'config/routes.php';