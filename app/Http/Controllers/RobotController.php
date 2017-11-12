<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// LINEBot 
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
// add 
use LINE\LINEBot\Response;

class RobotController extends Controller
{

	//protected $content;
	protected $events;


	protected $config;
	protected $bot;
	protected $req;

	public function __construct() {
		$content = file_get_contents('php://input');
		$this->events = json_decode($content, true);
		$this->config = [
			'channelId' => getenv('CHANNEL_ID'),
			'channelSecret' => getenv('CHANNEL_SECRET'),
			'channelMid' => getenv('MID'),
		];
		
		$httpClient = new CurlHTTPClient($this->config['channelMid']);
		$bot = new LINEBot($httpClient, $this->config);
		
	}

    public function index() {
    	return 'ok';
    }

    public function callback() {
    	$bot = $this->bot;
    	
    	//dd($this->events);
    	//if(!is_null($this->events)) {
	    	foreach ($this->events as $event) {
	    		// Get replyToken
	    		$replyToken = $event['replyToken'];

	    		if ($event['type'] == 'message') {

	    			if ($event['message']['type'] == 'text') {
	    				

	    				//Reply Message
	    				$respMessage = 'Hello, your message is : '. $event['message']['text'];

	    				$textMessageBuilder = new TextMessageBuilder($respMessage);
	    				$response = $bot->replyMessage($replyToken, $TextMessageBuilder);
	    				//$bot->sendText($event->getFromMid(), $text);
	    			} else {
	    				//$bot->sendText($event->getFromMid(), 'not text!!');
	    				$response = $bot->replyMessage($replyToken, 'not text');
	    			}
	    		} else {
	    			//$bot->sendText($event->getFromMid(), 'not Message');
	    			$response = $bot->replyMessage($replyToken, 'not Message');
	    		}
	    	}
    	//}


    	return ;
    }
}
