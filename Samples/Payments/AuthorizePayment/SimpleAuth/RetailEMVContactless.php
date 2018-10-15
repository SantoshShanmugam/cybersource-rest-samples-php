<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function RetailEMVContactless()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\PaymentApi($apiclient);
	$cliRefInfoArr = [
    "code" => "TC50171_16"
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
    "commerceIndicator" => "retail",
    "paymentSolution" => "011"
  ];
  $processingInformation = new CyberSource\Model\V2paymentsProcessingInformation($processingInformationArr);

  $pointOfSaleInfoArr = [
    "cardPresent" => "Y",
    "catLevel" => "1",
    "endlessAisleTransactionIndicator" => "true",
    "entryMode" => "msd",
    "terminalCapability" => "1"
  ];
  $pointOfSaleInformation = new CyberSource\Model\V2paymentsPointOfSaleInformation($pointOfSaleInfoArr);
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
    "totalAmount" => "115.00",
    "currency" => "USD"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);
  $orderInfoArry = [
    'amountDetails' => $amountDetInfo,
    'billTo' => $billto
  ];

  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);
  $paymentFluidDataArr = [
     "descriptor" => "EMV.PAYMENT.AnywhereCommerce.Walker",
      "value" => "ewogICJkYXRhIiA6ICJOZmNwRURiK1dLdzBnQkpsaTRcL1hlWm1ITzdUSng0bnRoMnc2Mk9ITVJQK3hCRlFPdFE0WWpRcnY0RmFkOHh6VExqT2VFQm5iNHFzeGZMYTNyNXcxVEdXblFGQnNzMWtPYnA0XC95alNtVE1JSGVjbGc5OFROaEhNb0VRcjJkRkFqYVpBTFAxSlBsdVhKSVwvbTZKSmVwNGh3VHRWZE16Z2laSUhnaWFCYzNXZVd1ZnYzc1l0cGRaZDZYZENEUFdLeXFkYjBJdUtkdkpBPT0iLAogICJzaWduYXR1cmUiIDogIkFxck1pKzc0cm1GeVBKVE9HN3NuN2p5K1YxTlpBZUNJVE56TW01N1B5cmc9IiwKICAic2lnbmF0dXJlQWxnSW5mbyIgOiAiSE1BQ3dpdGhTSEEyNTYiLAogICJoZWFkZXIiIDogewogICAgInRyYW5zYWN0aW9uSWQiIDogIjE1MTU2MjI2NjIuMTcyMjIwIiwKICAgICJwdWJsaWNLZXlIYXNoIiA6ICJcLzdmdldqRVhMazJPRWpcL3Z5bk1jeEZvMmRWSTlpRXVoT2Nab0tHQnpGTmM9IiwKICAgICJhcHBsaWNhdGlvbkRhdGEiIDogIkN5YmVyU291cmNlLlZNcG9zS2l0IiwKICAgICJlcGhlbWVyYWxQdWJsaWNLZXkiIDogIk1Ga3dFd1lIS29aSXpqMENBUVlJS29aSXpqMERBUWNEUWdBRW1JN0tScnRNN2NNelk5Zmw2UWt2NEQzdE9jU0NYR1hoOFwvK2R4K2s5c1Zrbk05UFQrOXRqMzk2YWF6QjRcL0hYaWlLRW9DXC9jUzdoSzF6UFk3MVwvN0pUUT09IgogIH0sCiAgInZlcnNpb24iIDogIjEuMCIKfQ=="
  ];
  $fluidData = new CyberSource\Model\V2paymentsPaymentInformationFluidData($paymentFluidDataArr);
  $paymentInfoArr = [
      "fluidData" => $fluidData
      
  ];
  $payment_information = new CyberSource\Model\V2paymentsPaymentInformation($paymentInfoArr);

  $paymentRequestArr = [
    'clientReferenceInformation' => $client_reference_information,
    'aggregatorInformation' => $aggregatorInformation,
    'pointOfSaleInformation' => $pointOfSaleInformation,
    'orderInformation' => $order_information,
    'paymentInformation' => $payment_information,
    'processingInformation' => $processingInformation
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
	RetailEMVContactless();

}

?>	
