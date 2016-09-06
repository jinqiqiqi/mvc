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
		// $this->slack = new Slack();
		$settings = [
			'link_names' => true,
		];
		$this->slack = new Maknz\Slack\Client('https://hooks.slack.com/services/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', $settings);
	}

	function __destruct() {
		$view = $this->view;
		if($view instanceof View) {
			extract($view->data);
			require $view->view;
		}
	}
}