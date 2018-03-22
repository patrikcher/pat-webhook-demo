<?php 

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	
	$json = json_decode($requestBody);

	$text = $json->result->parameters->text;
	
	$bookReviews = json_decode('http://pat-webhook-demo.herokuapp.com/data/bookreviews.json', true);
	

	switch ($text) {
		case 'hi':
			$speech = 'Hi, Nice to meet you';
			$display = $speech;
			
			break;
			
		case ($text == 'book review' || $text == 'read me a book review' || $text == 'read a book review' || strpos($text, 'sure') !== false || strpos($text, 'yes') !== false || strpos($text, 'sure') !== false):
			$num = rand(1, 3);
			
			switch ($num) {
				case 1:
					$speech = '<speak><audio src="https://pat-webhook-demo.herokuapp.com/rsc/BlackPanther.mp3">' . 
							'<desc>Black Panther: Who is Black Panter?</desc>I did not manage to get your book review.</audio></speak>';
					$display = 'Now reading book review for ' . $bookReviews[0]['title'] . '. Next review?';
					break;
					
				case 2:
					$speech = '<speak><audio src="https://pat-webhook-demo.herokuapp.com/rsc/From%20the%20Belly%20of%20the%20Cat.mp3">' .
							'<desc>From the Belly of the Cat</desc>I did not manage to get your book review.</audio></speak>';
					$display = 'Now reading book review for ' . $bookReviews[1]['title'] . '. Next review?';
					break;
					
				case 3:
					$speech = '<speak><audio src="https://pat-webhook-demo.herokuapp.com/rsc/ArivaalJeevitham_F2.mp3">' .
							'<desc>Arivval Jeevitham</desc>I did not manage to get your book review.</audio></speak>';
					$display = 'Now reading book review for ' . $bookReviews[2]['title'] . '. Next review?';
					break;
				
				default:
					$speech = 'I did not manage to get your book review.';
					$display = $speech;
					break;
			}
			
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
	
	$response = new \stdClass();
	$response->speech = $speech;
	$response->displayText = $display;
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}

?>