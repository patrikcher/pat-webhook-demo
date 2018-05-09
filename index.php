<?php 
$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	
	$json = json_decode($requestBody);

	$text = $json->result->parameters->text;
	
	$bookReviews = file_get_contents('./data/bookreviews.json');
	$bookReviewsJson = json_decode($bookReviews, true);
	
	// array to store messages
	$messages=[];

	switch ($text) {
		case 'hi':
			$speech = 'Hi, Nice to meet you';
			$display = $speech;
			
			break;
			
		case ($text == 'book review' || $text == 'read me a book review' || $text == 'read a book review' || strpos($text, 'sure') !== false || strpos($text, 'yes') !== false || strpos($text, 'sure') !== false):
			$num = rand(0, count($bookReviewsJson)-1);
			
			$title = $bookReviewsJson[$num]['title'];
			$filepath = $bookReviewsJson[$num]['filepath'];
			$thumbnail = $bookReviewsJson[$num]['thumbnail'];
			$bookurl = $bookReviewsJson[$num]['bookurl'];
			$author = $bookReviewsJson[$num]['author'];
			$review = $bookReviewsJson[$num]['review'];
			
			$speech = '<speak>' . $title . ' written by ' . $author . '<break time="2s"/>' . 
				'<audio src="' . $filepath  . '"><desc>' . $title . '</desc>I did not manage to get your book review.</audio>' . 
				'Would you like me to read another review?</speak>';
			$display = 'Now reading book review for ' . $title . '. Would you like me to read another review?';
			
			break;
		
		case ($text == 'bye' || $text == 'no' || $text == 'pass'):
			$speech = 'Goodbye, come again soon.';
			$display = $speech;
			
			break;
			
		default:
			$speech = 'Sorry, I didnt get that.';
			$display = $speech;
			
			break;
	}
	
	// push initial messages of selected book title
	array_push($messages, array(
			"type"=> "simple_response",
			"platform" => "google",
			"textToSpeech" => $speech,
			"displayText" => $display
		)
	);
	
	if ($action == 'General.General-repeat') {
		$speech = 'Repeat selected. I am supposed to repeat something.';
		$display = $speech;
	}
	
	// build card for selected book title
	array_push($messages, array(
			"type"=> "basic_card",
			"platform"=> "google",
	
			// options for cards
			"title"=> $title,
			"subtitle"=> $author,
			"image"=> [
				"url"=> $thumbnail,
				"accessibilityText"=> "Thumbnail for " . $title
			],
			//"formattedText"=> 'Text for card',
			"formattedText"=> $review,
			"buttons"=> [
				[
					"title"=> "View in NLB Catalogue",
					"openUrlAction"=> [
						"url"=> $bookurl
					]
				]
			]
		)
	);
	
	array_push($messages, array(
			"type"=> "suggestion_chip"
			"platform"=> "google"
			
			"suggestions"=> [
				[
					"title"=> "Sure"
				]
			]
		)
	);
	
	$response = new \stdClass();
	$response->source = "webhook";
	//$response->speech = $speech;
	//$response->displayText = $display;
	$response->messages = $messages;
	$response->contextOut = array();
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}
?>
