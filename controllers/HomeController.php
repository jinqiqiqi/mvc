<?php

/**
* HomeController
*/
class HomeController extends BaseController
{
	
	function __construct()
	{
		
	}

	public function home() {

		$this->view = View::make('home')->with('article', Article::first())->withTitleYes('MFFC :-D')->withFate('OK.');
		// $article = Article::first();
		// require dirname(__FILE__). '/../views/home.php';
		// echo 'home controller.';
	}
}