<?php 

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	
	$json = json_decode($requestBody);

	$text = $json->result->parameters->text;

	switch ($text) {
		case 'hi':
			$speech = 'Hi, Nice to meet you';
			$display = $speech;
			break;
			
		case ($text == 'book review' || $text == 'read me a book review' || $text == 'read a book review' || $text == 'next'):
			$num = rand(1, 3);
			//$speech = 'Here is a book review that may interest you.';
			
			switch ($num) {
				case 1:
					$speech = '<speak><audio src="https://pat-webhook-demo.herokuapp.com/rsc/BlackPanther.mp3"><desc>Black Panther: Who is Black Panter?</desc>did not get your audio file</audio></speak>';
					$display = 'Black Panther: Who is Black Panther?';
					break;
					
				case 2:
					$speech = '<speak><audio src="https://pat-webhook-demo.herokuapp.com/rsc/From%20the%20Belly%20of%20the%20Cat.mp3"><desc>From the Belly of the Cat</desc>did not get your audio file</audio></speak>';
					$display = 'From the Belly of the Cat';
					break;
					
				case 3:
					$speech = '<speak><audio src="https://pat-webhook-demo.herokuapp.com/rsc/ArivaalJeevitham_F2.mp3"><desc>Arivval Jeevitham</desc>did not get your audio file</audio></speak>';
					$display = 'Arivval Jeevitham';
					break;
				
				default:
					$speech = 'Something went wrong. I did not manage to get your book review.';
					$display = $speech;
					break;
			}
			
			break;

		case 'bye':
			$speech = 'Bye, good night';
			$display = $speech;
			break;

		case 'anything':
			$speech = 'Yes, you can type anything here.';
			$display = $speech;
			break;
		
		default:
			$speech = 'Sorry, I didnt get that. Please ask me something else.';
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