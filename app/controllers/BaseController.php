<?php

/**
* BaseController
*/
class BaseController
{
	protected $view;
	protected $slack;
	
	function __construct()
	{
		$this->slack = new Slack();
	}

	function __destruct() {
		$view = $this->view;
		if($view instanceof View) {
			extract($view->data);
			require $view->view;
		}
	}
}