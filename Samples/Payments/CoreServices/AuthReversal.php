<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function AuthReversal()
{
  $commonElement = new CyberSource\ExternalConfig();
  $config = $commonElement->ConnectionHost();
  $apiclient = new CyberSource\ApiClient($config);
  $api_instance = new CyberSource\Api\ReversalApi($apiclient);
  $id = "5347598472216662504005";
  $cliRefInfoArr = [
    "code" => "TC50171_1"
  ];
  $client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);
  $amountDetailsArrRev = [
      "totalAmount" => "100.00"
  ];
  $amountDetInfoRev = new CyberSource\Model\V2paymentsidreversalsReversalInformationAmountDetails($amountDetailsArrRev);
  $reversalInformationArr = [
    "amountDetails" => $amountDetInfoRev,
  ];
  $reversalInformation = new CyberSource\Model\V2paymentsidreversalsReversalInformation($reversalInformationArr);
  
  $amountDetailsArr = [
      "currency" => "USD"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);
  $orderInfoArry = [
    "amountDetails" => $amountDetInfo
  ];

  $orderInformation = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);
  $paymentRequestArr = [
    "clientReferenceInformation" => $client_reference_information,
    "reversalInformation" => $reversalInformation,
    "orderInformation" => $orderInformation
  ];

  $paymentRequest = new CyberSource\Model\AuthReversalRequest($paymentRequestArr);
  print_r($paymentRequest);
  $api_response = list($response,$statusCode,$httpHeader)=null;
  try {
    $api_response = $api_instance->authReversal($id, $paymentRequest);
    print_r($api_response);

  } catch (Exception $e) {
    print_r($e->getresponseBody());
    print_r($e->getmessage());
  }
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
  AuthReversal();

}

?>  
