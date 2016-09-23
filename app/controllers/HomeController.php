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
				's' => 'JPYCNY=X'
			]
		]);
		$result = str_getcsv($res->getBody());

		$datetime = date("Y-m-d H:i:s", strtotime($result[3]. ' '. $result[2]));
		$time = new DateTime($datetime, new DateTimeZone('Europe/London'));
		$time->setTimeZone(new DateTimeZone("Asia/Shanghai"));
		$format = "Y-m-d H:i:s";

		if($result[1] > 0.067 || $result[1] < 0.064) {
			$fields = [[
				'title' => 'Currency name',
				'value' => $result[0],
				'short' => true
			],[
				'title' => $time->format($format). ': ',
				'value' => $result[1],
				'short' => true
			]];
			$color = '#00FF00';
			$text = '建议抛：';
			$diff = $result[1] - 0.065538;
			if($result[1] < 0.064) {
				$color = '#FF0000';
				$text = '目前涨幅为：'. $diff;
			}

			$this->slack->to("#general")->attach([
				'fallback' => $text,
				'text' => $text,
				'color' => $color,
				'fields' => $fields
			])->send('日元：人民币 汇率提醒:');
		}
		print_r($result);
		
		// $this->slack->send(date('Y-m-d H:i:s'). ': 上午学习时间已经到期. @jinqiqiqi');
	}

	public function usd() {

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

		$datetime = date("Y-m-d H:i:s", strtotime($result[3]. ' '. $result[2]));
		$time = new DateTime($datetime, new DateTimeZone('Europe/London'));
		$time->setTimeZone(new DateTimeZone("Asia/Shanghai"));
		$format = "Y-m-d H:i:s";

		if($result[1] > 6.70 || $result[1] < 6.69) {
			$fields = [[
				'title' => 'Currency name',
				'value' => $result[0],
				'short' => true
			],[
				'title' => $time->format($format). ': ',
				'value' => $result[1],
				'short' => true
			]];
			$color = '#00FFFF';
			$text = '建议买入：';
			$diff = $result[1] - 0.065538;
			if($result[1] < 6.4) {
				$color = '#FFFF00';
				$text = '目前涨幅为：'. $diff;
				$text = '建议抛出：';
			}

			$this->slack->to("#general")->attach([
				'fallback' => $text,
				'text' => $text,
				'color' => $color,
				'fields' => $fields
			])->send('美元：人民币 汇率提醒:');
		}
		print_r($result);
		
		// $this->slack->send(date('Y-m-d H:i:s'). ': 上午学习时间已经到期. @jinqiqiqi');
	}
}
