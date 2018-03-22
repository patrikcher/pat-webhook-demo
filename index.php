<?php 

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	
	$json = json_decode($requestBody);

	$text = $json->result->parameters->text;
	
	$bookReviews = file_get_contents('http://pat-webhook-demo.herokuapp.com/data/bookreviews.json');
	$bookReviewsJson = json_decode($bookReviews, true);

	switch ($text) {
		case 'hi':
			$speech = 'Hi, Nice to meet you';
			$display = $speech;
			
			break;
			
		case ($text == 'book review' || $text == 'read me a book review' || $text == 'read a book review' || strpos($text, 'sure') !== false || strpos($text, 'yes') !== false || strpos($text, 'sure') !== false):
			$num = rand(1, 3);
			
			switch ($num) {
				case 1:
					$speech = '<speak><audio src="' . $bookReviewsJson[$num-1]['filepath']  . 
							'<desc>' . $bookReviewsJson[$num-1]['title'] . '</desc>I did not manage to get your book review.</audio></speak>';
					$display = 'Now reading book review for ' . $bookReviewsJson[$num-1]['title'] . '. URL is . ' . $bookReviewsJson[$num-1]['filepath'] . 
							' Next review?';
					break;
					
				case 2:
					$speech = '<speak><audio src="https://pat-webhook-demo.herokuapp.com/rsc/From%20the%20Belly%20of%20the%20Cat.mp3">' .
							'<desc>From the Belly of the Cat</desc>I did not manage to get your book review.</audio></speak>';
					$display = 'Now reading book review for ' . $bookReviewsJson[$num-1]['title'] . '. URL is . ' . $bookReviewsJson[$num-1]['filepath'] . 
							' Next review?';
					break;
					
				case 3:
					$speech = '<speak><audio src="https://pat-webhook-demo.herokuapp.com/rsc/ArivaalJeevitham_F2.mp3">' .
							'<desc>Arivval Jeevitham</desc>I did not manage to get your book review.</audio></speak>';
					$display = 'Now reading book review for ' . $bookReviewsJson[$num-1]['title'] . '. URL is . ' . $bookReviewsJson[$num-1]['filepath'] . 
							' Next review?';
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