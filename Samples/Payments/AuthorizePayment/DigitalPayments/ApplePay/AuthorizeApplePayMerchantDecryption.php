<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function AuthorizeApplePayMerchantDecryption()
{
  $commonElement = new CyberSource\ExternalConfig();
  $config = $commonElement->ConnectionHost();
  $apiclient = new CyberSource\ApiClient($config);
  $api_instance = new CyberSource\Api\PaymentApi($apiclient);
  $cliRefInfoArr = [
    "code" : "TC_MPOS_Paymentech_2"
  ];
  $client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);
  
  $processingInformationArr = [
    "paymentSolution" => "001"
  ];
  $processingInformation = new CyberSource\Model\V2paymentsProcessingInformation($processingInformationArr);

  $amountDetailsArr = [
    "totalAmount" => "100",
    "currency" => "USD"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);

  $billtoArr = [
    "country" : "US",
    "firstName" : "John",
    "lastName" : "Deo",
    "phoneNumber" : "6504327113",
    "address2" : "Desk M3-5573",
    "address1" : "901 Metro Center Blvd",
    "postalCode" : "94404",
    "locality" : "Foster City",
    "company" : "Visa",
    "administrativeArea" : "CA",
    "email" : "test@cybs.com"
  ];
  $billto = new CyberSource\Model\V2paymentsOrderInformationBillTo($billtoArr);

  $orderInfoArry = [
    'amountDetails' => $amountDetInfo,
    'billTo' => $billto
  ];

  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);

  $paymentCardInfo = [
    "type" => "001",
    "trackData" => ";4111111111111111=21121019761186800000?"
  ];
  $card = new CyberSource\Model\V2paymentsPaymentInformationTokenizedCard($paymentCardInfo);
  $tokenizedCardArr = [
    "expirationYear" : "2031",
    "number" : "4111111111111111",
    "expirationMonth" : "12",
    "transactionType" : "1",
    "cryptogram" : "AceY+igABPs3jdwNaDg3MAACAAA="
  ];
  $tokenizedCard = new CyberSource\Model\V2paymentsPaymentInformationTokenizedCard($tokenizedCardArr);
  $paymentInfoArr = [
      'card' => $card,
      'tokenizedCard' => $tokenizedCard
      
  ];
  $payment_information = new CyberSource\Model\V2paymentsPaymentInformation($paymentInfoArr);

  $paymentRequestArr = [
    'clientReferenceInformation' => $client_reference_information,
    'orderInformation' => $order_information,
    'paymentInformation' => $payment_information,
    'processingInformation' => $processingInformation,
    'pointOfSaleInformation' => $pointOfSaleInformation
  ];

  $paymentRequest = new CyberSource\Model\CreatePaymentRequest($paymentRequestArr);
  //echo "<pre>";print_r($paymentRequest);die;
  $api_response = list($response,$statusCode,$httpHeader)=null;
  try {
    $api_response = $api_instance->createPayment($paymentRequest);
    //echo "<pre>";print_r($api_response);

  } catch (Exception $e) {
    print_r($e->getresponseBody());
    print_r($e->getmessage());
  }
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
  AuthorizeApplePayMerchantDecryption();

}

?>  
