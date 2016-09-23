<?php

use NoahBuscher\Macaw\Macaw;

Macaw::get('just', function(){
	echo "testing page";
});

Macaw::get('home', 'HomeController@home');


Macaw::get('usd', 'HomeController@usd');


Macaw::get('/', function(){
	echo "root / index.php";
});

// Macaw::get('(:all)', function($fu){
// 	echo 'not matched: '. $fu;
// });

Macaw::$error_callback = function() {
	throw new Exception('404. 文件无法找到.');
};

Macaw::dispatch();