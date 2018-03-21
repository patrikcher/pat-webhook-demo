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
			break;
			
		case 'book review':
			$num = rand(1, 3);
			//$speech = 'Random num is ' . $num;
			
			switch ($num) {
				case 1:
					$speech = '<speak><audio src="https://pat-webhook-demo.herokuapp.com/rsc/BlackPanther.mp3">did not get your audio file</audio></speak>';
					break;
					
				case 2:
					$speech = '<speak><audio src="https://pat-webhook-demo.herokuapp.com/rsc/From%20the%20Belly%20of%20the%20Cat.mp3">did not get your audio file</audio></speak>';
					break;
					
				case 3:
					$speech = '<speak><audio src="https://pat-webhook-demo.herokuapp.com/rsc/ArivaalJeevitham_F2">did not get your audio file</audio></speak>';
					break;
				
				default:
					$speech = 'Random num is ' . $num;
					break;
			}
			
			break;

		case 'bye':
			$speech = 'Bye, good night';
			break;

		case 'anything':
			$speech = 'Yes, you can type anything here.';
			break;
		
		default:
			$speech = 'Sorry, I didnt get that. Please ask me something else.';
			break;
	}

	$response = new \stdClass();
	$response->speech = $speech;
	$response->displayText = $speech;
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}

?>