<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function CaptureAPayment()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\CaptureApi($apiclient);
  $id = "5347670571396669404003";
	$cliRefInfoArr = [
    'code' => '1234567890'
  ];
  $client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);

  $pointOfSaleInfoArr = [
    "cardPresent" => "false",
    "catLevel" => "6",
    "terminalCapability" => "4"
  ];
  $pointOfSaleInformation = new CyberSource\Model\V2paymentsPointOfSaleInformation($pointOfSaleInfoArr);
  
  $amountDetailsArr = [
      "totalAmount" => "100.00",
      "currency" => "USD"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);
  $billtoArr = [
    "country" => "US",
    "firstName" => "John",
    "lastName" => "Deo",
    "address1" => "901 Metro Center Blvd",
    "postalCode" => "40500",
    "locality" => "Foster City",
    "administrativeArea" => "CA",
    "email" => "test@cybs.com"
  ];
  $billto = new CyberSource\Model\V2paymentsOrderInformationBillTo($billtoArr);
  $orderInfoArry = [
    "amountDetails" => $amountDetInfo,
    "billTo" => $billto
  ];

  $orderInformation = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);
 

  $paymentRequestArr = [
    "clientReferenceInformation" => $client_reference_information,
    "pointOfSaleInformation" => $pointOfSaleInformation,
    "orderInformation" => $orderInformation
  ];

  $paymentRequest = new CyberSource\Model\CapturePaymentRequest($paymentRequestArr);
  $api_response = list($response,$statusCode,$httpHeader)=null;
  try {
    $api_response = $api_instance->capturePayment($paymentRequest, $id);
		print_r($api_response);

	} catch (Exception $e) {
		print_r($e->getresponseBody());
    print_r($e->getmessage());
	}
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
	CaptureAPayment();

}

?>	
