<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function RetrieveAuthorizationReversal()
{
	$commonElement = new CyberSource\ExternalConfig();
  $config = $commonElement->ConnectionHost();
  $apiclient = new CyberSource\ApiClient($config);
  $api_instance = new CyberSource\Api\ReversalApi($apiclient);
  $id = '5350275921706258204002';
  $api_response = list($response,$statusCode,$httpHeader)=null;
  try {
    $api_response = $api_instance->getAuthReversal($id);
    print_r($api_response);

  } catch (Exception $e) {
    print_r($e->getresponseBody());
    print_r($e->getmessage());
  }
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
	RetrieveAuthorizationReversal();

}

?>	
