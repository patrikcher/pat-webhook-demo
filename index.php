<?php 

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	
	$json = json_decode($requestBody);

	$text = $json->result->parameters->text;
	
	$bookReviews = file_get_contents('https://nlbbot-webhook.herokuapp.com/data/bookreviews.json');
	$bookReviewsJson = json_decode($bookReviews, true);

	switch ($text) {
		case 'hi':
			$speech = 'Hi, Nice to meet you';
			$display = $speech;
			
			break;
			
		case ($text == 'book review' || $text == 'read me a book review' || $text == 'read a book review' || strpos($text, 'sure') !== false || strpos($text, 'yes') !== false || strpos($text, 'sure') !== false):
			$num = rand(0, count($bookReviewsJson)-1);
			
			$title = $bookReviewsJson[$num]['title'];
			$filepath = $bookReviewsJson[$num]['filepath'];
			
			$speech = '<speak><audio src="' . $filepath  . '"><desc>' . $title . '</desc>I did not manage to get your book review.</audio>Would you like me to read another review?</speak>';
			$display = 'Now reading book review for ' . $title . '. Would you like me to read  another review?';			
			
			break;

		case ($text == 'bye' || $text == 'no'):
			$speech = 'Goodbye, come again soon.';
			$display = $speech;
			
			break;
			
		default:
			$speech = 'Sorry, I didnt get that.';
			$display = $speech;
			
			break;
	}
	
	$messages=[];
    array_push($messages, array(
            "type"=> "simple_response",
            "platform"=> "google",
            "textToSpeech"=> $speech
        )
    );
	
	// build card
	array_push($messages, array(
            "type"=> "basic_card",
            "platform"=> "google",
			// options for cards
            //"title"=> "Card title",
            //"subtitle"=> "card subtitle",
            "image"=> [
                "url"=>'http://lorempixel.com/600/200',
                "accessibility_text"=>'image-alt'
            ],
            //"formattedText"=> 'Text for card',
            /*"buttons"=> [
                [
                    "title"=> "Button title",
                    "openUrlAction"=> [
                        "url"=> "http://lorempixel.com/200/200"
                    ]
                ]
            ]*/
        )
    );
	
	$response = new \stdClass();
	$response->speech = $speech;
	$response->displayText = $display;
	$response->messages $messages;
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}

?>
