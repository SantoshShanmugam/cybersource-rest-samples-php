<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function RefundPayment()
{
  $commonElement = new CyberSource\ExternalConfig();
  $config = $commonElement->ConnectionHost();
  $apiclient = new CyberSource\ApiClient($config);
  $api_instance = new CyberSource\Api\RefundApi($apiclient);
  $id = '5336247664156712803527';
  $cliRefInfoArr = [
    "code" => "Testing-Payments-Refund"
  ];
  $client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);
  $amountDetailsArr = [
      "totalAmount" => "102.21",
      "currency" => "USD"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);
  
  $orderInfoArry = [
    "amountDetails" => $amountDetInfo
  ];

  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);
  

  $paymentRequestArr = [
    "clientReferenceInformation" => $client_reference_information,
    "orderInformation" => $order_information
  ];

  $paymentRequest = new CyberSource\Model\RefundPaymentRequest($paymentRequestArr);
  $api_response = list($response,$statusCode,$httpHeader)=null;
  try {
    $api_response = $api_instance->refundPayment($paymentRequest, $id);
    print_r($api_response);

  } catch (Exception $e) {
    print_r($e->getresponseBody());
    print_r($e->getmessage());
  }
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
  RefundPayment();

}

?>  
