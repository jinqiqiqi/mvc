<?php

/**
* HomeController
*/
class HomeController extends BaseController
{
	
	function __construct()
	{
		parent::__construct();	
	}

	public function home() {

		// $this->view = View::make('home')->with('Currency', Currency::first())->withTitleYes('MFFC :-D')->withFate('OK.');
		// $Currency = Currency::first();
		// require dirname(__FILE__). '/../views/home.php';
		// echo 'home controller.';
		// $this->slack->channel = ['general', 'random'];
		// date_default_timezone_set("Asia/Shanghai");

		// $ax = $this->slack->send("时间: ". date("Y-m-d H:i:s"). ", 好的,已经可以完成了.");

		$settings = [
			'link_names' => true,
		];
		$client = new Maknz\Slack\Client('https://hooks.slack.com/services/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', $settings);
		$client->to("#general")->attach([
			'fallback' => 'Server hexxalth: good',
			'text' => 'Server health: good',
			'color' => 'danger',
		])->send('New alert. @jinqiqiqi');
		echo "yes";
	}
}