<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function AuthorizationOnly()
{
  $commonElement = new CyberSource\ExternalConfig();
  $config = $commonElement->ConnectionHost();
  $apiclient = new CyberSource\ApiClient($config);
  $api_instance = new CyberSource\Api\PaymentApi($apiclient);
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
  $paymentCardInfo = [
    "expirationYear" => "2031",
    "number" => "4111111111111111",
    "securityCode" => "123",
    "expirationMonth" => "12"
  ];
  $card = new CyberSource\Model\V2paymentsPaymentInformationCard($paymentCardInfo);
  $paymentInfoArr = [
      "card" => $card
      
  ];
  $paymentInformation = new CyberSource\Model\V2paymentsPaymentInformation($paymentInfoArr);

  $paymentRequestArr = [
    "clientReferenceInformation" => $client_reference_information,
    "pointOfSaleInformation" => $pointOfSaleInformation,
    "orderInformation" => $orderInformation,
    "paymentInformation" => $paymentInformation
  ];

  $paymentRequest = new CyberSource\Model\CreatePaymentRequest($paymentRequestArr);
  $api_response = list($response,$statusCode,$httpHeader)=null;
  try {
    $api_response = $api_instance->createPayment($paymentRequest);
    print_r($api_response);

  } catch (Exception $e) {
    print_r($e->getresponseBody());
    print_r($e->getmessage());
  }
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
  AuthorizationOnly();

}

?>  
