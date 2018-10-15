<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function OriginalRequestAuth()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\PaymentApi($apiclient);
	$cliRefInfoArr = [
    "code" => "TC50171_1"
  ];
  $client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);

  $subMerchantArr = [
    "cardAcceptorId" => "1234567890",
    "country" => "US",
    "phoneNumber" => "650-432-0000",
    "address1" => "900 Metro Center",
    "postalCode" => "94404-2775",
    "locality" => "Foster City",
    "name" => "Visa Inc",
    "administrativeArea" => "CA",
    "region" => "PEN",
    "email" => "test@cybs.com"
  ];

  $subMerchant = new CyberSource\Model\V2paymentsAggregatorInformationSubMerchant($subMerchantArr);

  $aggregatorInformationArr = [
    "subMerchant" => $subMerchant,
    "name" => "V-Internatio",
    "aggregatorId" => "123456789"
  ];
  $aggregatorInformation = new CyberSource\Model\V2paymentsAggregatorInformation($aggregatorInformationArr);

  $processingInformationArr = [
     "commerceIndicator" => "recurring"
  ];
  $processingInformation = new CyberSource\Model\V2paymentsProcessingInformation($processingInformationArr);
  $billtoArr = [
    "country" => "US",
    "lastName" => "VDP",
    "address2" => "Address 2",
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
  $amountDetailsArr = [
    "totalAmount" => "3000.00",
    "currency" => "USD"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);
  $orderInfoArry = [
      'amountDetails' => $amountDetInfo,
      'billTo' => $billto
  ];

  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);

  $emvArr = [
    "cardSequenceNumber" => "123",
    "tags" => "9F2608EF7753429A5D16B19F100706010A03A0000095058000040000"
  ];
  $emv = new CyberSource\Model\V2paymentsPointOfSaleInformationEmv($emvArr);

  $pointOfSaleInfoArr = [
    "cardPresent" => "Y",
    "emv" => $emv ,
    "entryMode" => "contact",
    "terminalCapability" => "4"
  ];
  $pointOfSaleInformation = new CyberSource\Model\V2paymentsPointOfSaleInformation($pointOfSaleInfoArr);

  $paymentCardInfo = [
    "expirationYear" => "2031",
    "number" => "5555555555554444",
    "securityCode" => "123",
    "expirationMonth" => "12",
    "type" => "002"
  ];
  $card = new CyberSource\Model\V2paymentsPaymentInformationCard($paymentCardInfo);
  $paymentInfoArr = [
      'card' => $card
      
  ];
  $payment_information = new CyberSource\Model\V2paymentsPaymentInformation($paymentInfoArr);

  $paymentRequestArr = [
    'clientReferenceInformation' => $client_reference_information,
    'aggregatorInformation' => $aggregatorInformation,
    'orderInformation' => $order_information,
    'paymentInformation' => $payment_information,
    'pointOfSaleInformation' => $pointOfSaleInformation
  ];

  $paymentRequest = new CyberSource\Model\CreatePaymentRequest($paymentRequestArr);
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
	OriginalRequestAuth();
}

?>	
