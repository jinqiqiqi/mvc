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
		echo '<pre>';
		$client = new \GuzzleHttp\Client();
		$res = $client->request('GET', 'http://finance.yahoo.com/d/quotes.csv', [
			'query' => [
				'e' => '.csv',
				'f' => 'sl1d1t1',
				's' => 'USDCNY=X'
			]
		]);
		$result = str_getcsv($res->getBody());

		$datetime = strtotime($result[3]. ' '. $result[2]);

		$time = new DateTime($datetime, new DateTimeZone('UTC'));
		$time->setTimeZone(new DateTimeZone("Asia/Shanghai"));
		$format = "Y-m-d H:i:s";

		$fields = [[
			'title' => 'Currency name',
			'value' => $result[0],
			'short' => true
		],[
			'title' => 'Value',
			'value' => $result[1],
			'short' => true
		],[
			'title' => 'Exchange Time',
			'value' => $time->format($format),
			'short' => true
		]];
		print_r($fields);
		$this->slack->to("#general")->attach([
			'fallback' => '当前的交易值',
			'text' => '当前的交易值',
			'color' => '#FF0000',
			'fields' => $fields
		])->send('当前的交易值:');
		// $this->slack->send(date('Y-m-d H:i:s'). ': 上午学习时间已经到期. @jinqiqiqi');
	}
}