<?php

define('WEBROOT', __DIR__. '/');
define('APP_PATH', WEBROOT. '../');
define('BASE_PATH', WEBROOT. '../../');

// Autoload 
require BASE_PATH. 'vendor/autoload.php';

require APP_PATH. 'config/bootstrap.php';
require APP_PATH. 'config/routes.php';


