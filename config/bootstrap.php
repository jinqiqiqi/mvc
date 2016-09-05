<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Whoops\Handler\PrettyPageHandler as Pagehandler;

$capsule = new Capsule;
$capsule->addConnection(require BASE_PATH. 'config/database.php');
$capsule->bootEloquent();

$whoops = new Whoops\Run;
$whoops->pushHandler(new Pagehandler);
$whoops->register();