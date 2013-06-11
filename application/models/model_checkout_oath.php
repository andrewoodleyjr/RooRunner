<?php
class model_checkout_oath extends CI_Model{

# Sandbox
public $host = 'https://api.paypal.com';
public $clientId = 'AelqbRB0IreKEAOKSHFTUobqqFrOH5DnVX8xrHgxMA4YSMx_j5OxgRO4anJQ';
public $clientSecret = 'EKq5shADatzHs6FoEoKi2qZDNoQ-FRIkc3sF8X-UQatxrOWpYYBllNnk3gGo';

public $token = '';
public $url = '';
public $json_card_data = '';




public function __construct() {
    $url = $this->host.'/v1/oauth2/token'; 
    $postArgs = 'grant_type=client_credentials';
    $this->token = $this->get_access_token($url,$postArgs);
    $this->url =  $this->host.'/v1/payments/payment';
    
    
}
// function to read stdin
function read_stdin() {
        $fr=fopen("php://stdin","r");   // open our file pointer to read from stdin
        $input = fgets($fr,128);        // read a maximum of 128 characters
        $input = rtrim($input);         // trim any trailing spaces.
        fclose ($fr);                   // close the file handle
        return $input;                  // return the text entered
}

public function createCardData($payment_data){
    $payment = array(
		'intent' => 'sale',
		'payer' => array(
			'payment_method' => 'credit_card',
			'funding_instruments' => array ( array(
					'credit_card' => array (
						'number' => $payment_data['num'],
						'type'   => $payment_data['type'],
						'expire_month' => $payment_data['month'],
						'expire_year' => $payment_data['year'],
						'cvv2' => 111,
						'first_name' => $payment_data['first'],
						'last_name' => $payment_data['last']
						)
					))
			),
		'transactions' => array (array(
				'amount' => array(
					'total' => $payment_data['amount'],
					'currency' => 'USD'
					),
				'description' => $payment_data['description']
				))
		);
$this->json_card_data = json_encode($payment);

}



function get_access_token($url, $post_data) {
	$curl = curl_init($url); 
	curl_setopt($curl, CURLOPT_POST, true); 
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_USERPWD, $this->clientId . ":" . $this->clientSecret);
	curl_setopt($curl, CURLOPT_HEADER, false); 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data); 
#	curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
	$response = curl_exec( $curl );
        
        curl_close($curl); // close cURL handler
	// Convert the result from JSON format to a PHP array 
	$jsonResponse = json_decode( $response );
	return $jsonResponse->access_token;
}

function make_get_call() {
	$curl = curl_init($this->url); 
	curl_setopt($curl, CURLOPT_POST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Authorization: Bearer '.$token,
				'Accept: application/json',
				'Content-Type: application/json'
				));

	#curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
	$response = curl_exec( $curl );

	// Convert the result from JSON format to a PHP array 
	$jsonResponse = json_decode($response, TRUE);
	return $jsonResponse;
}

function make_post_call() {
	$curl = curl_init($this->url); 
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Authorization: Bearer '. $this->token,
				'Accept: application/json',
				'Content-Type: application/json'
				));

	curl_setopt($curl, CURLOPT_POSTFIELDS, $this->json_card_data); 
	#curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
	$response = curl_exec( $curl );
	

	// Convert the result from JSON format to a PHP array 
	$jsonResponse = json_decode($response, TRUE);
	return $jsonResponse;
}


}
