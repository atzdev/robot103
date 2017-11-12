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
	/*protected $events;


	protected $config;
	protected $bot;
	protected $req;*/

	/*public function __construct() {
		$content = file_get_contents('php://input');
		$this->events = json_decode($content, true);
		$this->config = [
			'channelId' => getenv('CHANNEL_ID'),
			'channelSecret' => getenv('CHANNEL_SECRET'),
			'channelMid' => getenv('MID'),
		];
		
		$httpClient = new CurlHTTPClient($this->config['channelMid']);
		$bot = new LINEBot($httpClient, $this->config);
		
	}*/

    public function index() {
    	return 'ok';
    }

    public function callback() {
/*
CHANNEL_ID=1545811741
CHANNEL_SECRET=e4231788b61ba4311b188f1f8fc7d374
MID=tFjmP/fFD+ykyqTmymYgweAZBdHw2lQQFO2d3TY3rOn6Mxw15Z6AmV1xBz3KfL1EL1Lr/PYJXNyxGFG0Mtw78pz0/dqu7hoyA7OGk9NfYrD3GggXb3OgGezjLIknJQEZjf6xAGCY4/Z60lW0+inyzAdB04t89/1O/w1cDnyilFU=
*/


		//Token
		$channel_token = 'tFjmP/fFD+ykyqTmymYgweAZBdHw2lQQFO2d3TY3rOn6Mxw15Z6AmV1xBz3KfL1EL1Lr/PYJXNyxGFG0Mtw78pz0/dqu7hoyA7OGk9NfYrD3GggXb3OgGezjLIknJQEZjf6xAGCY4/Z60lW0+inyzAdB04t89/1O/w1cDnyilFU=';
		$channel_secret = 'e4231788b61ba4311b188f1f8fc7d374';

		// Get message from Line API
		$content = file_get_contents('php://input');
		$events = json_decode($content, true);

		if(!is_null($events['events'])) {

			// Loop through each event
			foreach($events['events'] as $event) {



				// Line API send a lot of event type, we interested in message only
				if($event['type'] == 'message') {
				// Get replyToken
				$replyToken = $event['replyToken'];

				switch ($event['message']['type']) {
					case 'text':
						$respMessage = 'Hello, your message is '. $event['message']['text'];
						$httpClient = new CurlHTTPClient($channel_token);
						$bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
						$TextMessageBuilder = new TextMessageBuilder($respMessage);
						$response = $bot->replyMessage($replyToken, $TextMessageBuilder);

						break;
					
						}
						
					}
			}
		}

    	/*$bot = $this->bot;
    	
    	dd($this->events['events']);
    	if(!is_null($this->events['events'])) {
	    	foreach ($this->events['events'] as $event) {
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
    	}


    	return ;
    }*/
}
