<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function SamsungPayRetailRetailEMVcontact()
{
  $commonElement = new CyberSource\ExternalConfig();
  $config = $commonElement->ConnectionHost();
  $apiclient = new CyberSource\ApiClient($config);
  $api_instance = new CyberSource\Api\PaymentApi($apiclient);
  $cliRefInfoArr = [
    "code" => "33557799"
  ];
  $client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);
  
  $processingInformationArr = [
    "commerceIndicator" => "retail",
    "paymentSolution" => "008"
  ];
  $processingInformation = new CyberSource\Model\V2paymentsProcessingInformation($processingInformationArr);

  $amountDetailsArr = [
    "totalAmount" => "100.00",
    "currency" => "USD"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);

  $billtoArr = [
    "country" => "US",
    "lastName" => "VDP",
    "address2" => "test",
    "address1" => "201 S. Division St.",
    "postalCode" => "48104-2201",
    "locality" => "Ann Arbor",
    "administrativeArea" => "MI",
    "firstName" => "RTS",
    "phoneNumber" => "999999999",
    "district" => "MI",
    "buildingNumber" => "123",
    "company" => "Visa",
    "email" => "test@cybs.com"
  ];
  $billto = new CyberSource\Model\V2paymentsOrderInformationBillTo($billtoArr);

  $orderInfoArry = [
    'amountDetails' => $amountDetInfo,
    'billTo' => $billto
  ];

  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);

  $emvArr = [
    "cardSequenceNumber" => "123",
    "tags" => "9C01019A031207109F33036040209F1A0207849F370482766E409F3602001F82025C009F2608EF7753429A5D16B19F100706010A03A00000950580000400009F02060000000700009F6E0482766E409F5B04123456789F2701809F3403AB12349F0902AB129F4104AB1234AB9F0702AB129F0610123456789012345678901234567890AB9F030200005F2A0207849F7C031234569F350123"
  ];
  $emv = new CyberSource\Model\V2paymentsPointOfSaleInformationEmv($processingInformationArr);
  $pointOfSaleInfoArr = [
    "terminalId" => "terminal",
    "cardPresent" => "Y",
    "emv" => $emv,
    "entryMode" => "contact",
    "terminalCapability" => "4"
  ];
  $pointOfSaleInformation = new CyberSource\Model\V2paymentsPointOfSaleInformation($pointOfSaleInfoArr);

  $paymentCardInfo = [
    "type" => "001",
    "trackData" => ";4111111111111111=21121019761186800000?"
  ];
  $card = new CyberSource\Model\V2paymentsPaymentInformationTokenizedCard($paymentCardInfo);
  $tokenizedCardArr = [
    "transactionType" => "1",
    "requestorId" => "12345678901"
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
  SamsungPayRetailRetailEMVcontact();

}

?>  
