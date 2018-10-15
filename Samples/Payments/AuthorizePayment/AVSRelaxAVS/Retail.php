<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function Retail()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\PaymentApi($apiclient);
	
	$cliRefInfoArr = [
    "code" => "TC1102345"
  ];
  $client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);

  

  $processingInformationArr = [
    "commerceIndicator" => "retail",
    "paymentSolution" => "007"
  ];
  $processingInformation = new CyberSource\Model\V2paymentsProcessingInformation($processingInformationArr);

  $emvArr = [
    "cardSequenceNumber" => "123",
    "tags" => "9C01019A031207109F33036040209F1A0207849F370482766E409F3602001F82025C009F2608EF7753429A5D16B19F100706010A03A00000950580000400009F02060000000700009F6E0482766E409F5B04123456789F2701809F3403AB12349F0902AB129F4104AB1234AB9F0702AB129F0610123456789012345678901234567890AB9F030200005F2A0207849F7C031234569F350123"
  ];
  $emv = new CyberSource\Model\V2paymentsPointOfSaleInformationEmv($processingInformationArr);
  $pointOfSaleInfoArr = [
    "terminalId" => "terminal",
    "cardPresent" => "Y",
    "emv" => $emv,
    "entryMode" => "QRCode",
    "terminalCapability" => "4"
  ];
  $pointOfSaleInformation = new CyberSource\Model\V2paymentsPointOfSaleInformation($pointOfSaleInfoArr);

  
  
  $billtoArr = [
    "country" => "US",
    "lastName" => "Deo",
    "address2" => "test",
    "address1" => "201 S. Division St.",
    "postalCode" => "48104-2201",
    "locality" => "Ann Arbor",
    "administrativeArea" => "MI",
    "firstName" => "John",
    "phoneNumber" => "999999999",
    "district" => "MI",
    "buildingNumber" => "123",
    "company" => "Visa",
    "email" => "test@cybs.com"
  ];
  $billto = new CyberSource\Model\V2paymentsOrderInformationBillTo($billtoArr);
  $amountDetailsArr = [
    "totalAmount" => "100.00",
      "currency" => "USD"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);
  $orderInfoArry = [
    'amountDetails' => $amountDetInfo,
    'billTo' => $billto
  ];

  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);
  
  $paymentCardInfo = [
    "type" => "001",
    "trackData" => ";4111111111111111=21121019761186800000?"
  ];
  $card = new CyberSource\Model\V2paymentsPaymentInformationCard($paymentCardInfo);
  $fluidDataArr = [
    "transactionType" => "1",
    "requestorId" => "12345678901"
  ];
  $fluidData = new CyberSource\Model\V2paymentsPaymentInformationFluidData($fluidDataArr);

  $paymentInfoArr = [
      'card' => $card,
      'fluidData' => $fluidData
      
  ];
  $payment_information = new CyberSource\Model\V2paymentsPaymentInformation($paymentInfoArr);

  $paymentRequestArr = [
    'clientReferenceInformation' => $client_reference_information,
    'pointOfSaleInformation' => $pointOfSaleInformation,
    'orderInformation' => $order_information,
    'paymentInformation' => $payment_information,
    'processingInformation' => $processingInformation
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
	Retail();

}

?>	
