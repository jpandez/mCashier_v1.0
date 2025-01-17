<?php
require_once('Libraries/Wrappers/nusoap.php');
// Create the client instance
$client = new soapclient('http://localhost:8080/GUI?wsdl', 'WSDL');
// Check for an error
$err = $client->getError();
if ($err) {
    // Display the error
    echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
    // At this point, you know the call that follows will fail
}
// Call the SOAP method
//$result = $client->call('sendOperation', array('txn_id' => '5243242','payment_status' => 'Completed','payment_amount' => '50','payment_currency' => 'PHP','item_name' => $_POST['txtItemName'],'item_number' => $_POST['txtItemNumber'],'payers_email' => 'thenapster.project@gmail.com','first_name' => 'Erwin','last_name' => 'de torres','address_city' => 'Lucena City','address_state' => 'Quezon','address_country' => 'Philippines','receiver_email' => 'thenapster.project@yahoo.com','option1' => '','option2' => '','option3' => '','option4' => '','option5' => ''));
$result = $client->call('search', array('inp'=>'639108202362','option'=>'1'));
// Check for a fault
if ($client->fault) {
    echo '<h2>Fault</h2><pre>';
    print_r($result);
    echo '</pre>';
} else {
    // Check for errors
    $err = $client->getError();
    if ($err) {
        // Display the error
        echo '<h2>Error</h2><pre>' . $err . '</pre>';
    } else {
        // Display the result
        echo '<h2>Result</h2><pre>';
		$obj = json_decode(base64_decode($result));
		var_dump($obj);
        //print_r($result);
    echo '</pre>';
    }
}
// Display the request and response
echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
// Display the debug messages
//echo '<h2>Debug</h2>';
//echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
?>
