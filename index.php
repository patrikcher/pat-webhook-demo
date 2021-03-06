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
	$response = new \stdClass();

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
			
			$response = [
				"speech" => $speech,
				"data" => [
					"google" => [
						"expectUserResponse" => true,
						"richResponse"=>[
							"items" => [
									[
										"simpleResponse" => [
											"textToSpeech" => $speech,
											"displayText" => $display
										]
									],
									[
										"basicCard" => [
											"title" => $title,
											"subtitle" => $author,
											"image" => [
												"url" => $thumbnail,
												"accessibilityText" => "Thumbnail for " . $title
											],
											"formattedText" => $review,
											"buttons" => [
												[
													"title" => "View in NLB Catalogue",
													"openUrlAction" => [
														"url" => $bookurl
													]
												]
											]
										]
									]
								],
								"suggestions" => [
									[
										"title" => "Sure"
									],
									[
										"title" => "No"
									]
								]
						]
					]
				]
			];
			
			break;
		
		case ($text == 'bye' || $text == 'no' || $text == 'pass'):
			$speech = 'Goodbye, come again soon.';
			$display = $speech;
			
			$response = [
				"speech" => $speech,
				"data" => [
					"google" => [
						"expectUserResponse" => false,
						"richResponse"=>[
							"items" => [
								[
									"simpleResponse" => [
										"textToSpeech" => $speech,
										"displayText" => $display
									]
								]
							]
						]
					]
				]
			];
			
			break;
			
		default:
			$speech = 'Sorry, I didnt get that.';
			$display = $speech;
			
			$response = [
				"speech" => $speech,
				"data" => [
					"google" => [
						"expectUserResponse" => false,
						"richResponse"=>[
							"items" => [
								[
									"simpleResponse" => [
										"textToSpeech" => $speech,
										"displayText" => $display
									]
								]
							]
						]
					]
				]
			];
			
			break;
	}
	
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}
?>
