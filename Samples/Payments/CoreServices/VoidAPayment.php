<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function VoidAPayment()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\VoidApi($apiclient);
  $id = "5348457211526874803002";
	$cliRefInfoArr = [
     "code" => "1234567890"
  ];
  $client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);

  $pointOfSaleInformationArr = [
    "cardPresent" => "false",
    "catLevel" => "6",
    "terminalCapability" => "4"
  ];
  $pointOfSaleInformation = new CyberSource\Model\V2paymentsPointOfSaleInformation($pointOfSaleInformationArr);

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
  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);
  $paymentRequestArr = [
    "clientReferenceInformation" => $client_reference_information,
    "orderInformation" => $order_information,
    "pointOfSaleInformation" => $pointOfSaleInformation
  ];

  $paymentRequest = new CyberSource\Model\VoidPaymentRequest($paymentRequestArr);
  $api_response = list($response,$statusCode,$httpHeader)=null;
  try {
    $api_response = $api_instance->voidPayment($paymentRequest, $id);
		echo "<pre>";print_r($api_response);

	} catch (Exception $e) {
		print_r($e->getresponseBody());
    print_r($e->getmessage());
	}
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
	VoidAPayment();

}

?>	
