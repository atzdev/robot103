<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// LINEBot 
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\GuzzleHTTPClient;
// add 
use LINE\LINEBot\Response;

class RobotController extends Controller
{

	protected $config;
	protected $bot;
	protected $req;

	public function __construct(Request $request) {
		$this->config = [
			'channelId' => getenv('CHANNEL_ID'),
			'channelSecret' => getenv('CHANNEL_SECRET'),
			'channelMid' => getenv('MID'),
		];
		$this->bot = new LINEBot($this->config, new GuzzleHTTPClient($this->config));
		$this->req = $request;
	}

    public function index() {
    	return 'ok';
    }

    public function callback() {
    	$bot = $this->bot;
    	$receives = $bot->createReceivesFromJSON($this->req->getContent());
    	foreach ($receives as $receive) {
    		if ($receive->isMessage()) {
    			if ($receive->isText()) {
    				$text = $receive->getText();
    				$bot->sendText($receive->getFromMid(), $text);
    			} else {
    				$bot->sendText($receive->getFromMid(), 'not text!!');
    			}
    		} else {
    			$bot->sendText($receive->getFromMid(), 'not Message');
    		}
    	}
    	return ;
    }
}
