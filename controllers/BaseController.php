<?php

/**
* BaseController
*/
class BaseController
{
	protected $view;
	
	function __construct()
	{
		# code...
	}

	function __destruct() {
		$view = $this->view;
		if($view instanceof View) {
			extract($view->data);
			require $view->view;
		}
	}
}