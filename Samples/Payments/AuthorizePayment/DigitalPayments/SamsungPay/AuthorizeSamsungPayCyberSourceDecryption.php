<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function AuthorizeSamsungPayCyberSourceDecryption()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\PaymentApi($apiclient);
	$cliRefInfoArr = [
		"code" => "TC_MPOS_Paymentech_3"
	];
	$client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);

  
  $processingInformationArr = [
    "commerceIndicator" => "vbv",
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
    "address1" => "201 S. Division St.",
    "postalCode" => "48104-2201",
    "firstName" => "RTS"
  ];
  $billto = new CyberSource\Model\V2paymentsOrderInformationBillTo($billtoArr);

  $orderInfoArry = [
    'amountDetails' => $amountDetInfo,
    'billTo' => $billto
  ];

  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);

  
  
  $fluidDataArr = [
    "value" => "ewoJInB1YmxpY0tleUhhc2giOiAiaTRYell5MFRnNnkvaEUwV2RrK0dwOHV4aml4U3I0US91MUxNOVd0VTl2az0iLAoJInZlcnNpb24iOiAiMTAwIiwKCSJkYXRhIjogIlpYZHZTa2x0Um5OYWVVazJTVU5LVTFVd1JYaFllbFZwVEVGdlNrbHRWblZaZVVrMlNVTktRazFxVlRKU01FNU9TV2wzUzBOVFNuSmhWMUZwVDJsQmFXRlVVbGxsYkd3MVRVWlNiazV1YTNaaFJWVjNWakpTY2tzd1pIZFBTRlkwWVcxc05GVXpTVEJWVXpreFRWVjRUazlXWkRCV1ZHd3lZWG93YVV4QmIwcEpibEkxWTBOSk5rbERTa3RVTVU1R1NXbDNTME5UU21waFIwWjFZbTFXYzFVeVZtcGtXRXB3WkVoc1JHSXlOVEJhV0dnd1NXcHZaMGxzU2xSUlZqbFJVekJyYVVOdU1DNUdURGxEYTJScFFtOHlTSEExWDJ0Qk5WOUJNM2hJUjFCaFQwZDBSMmRWVVRoWk5UY3dNVjlzUmxSU1IxbFlNRWRpYlV4d05GVnBhM1JSV1Voa09FaHZUR3RrVVUxRFUwVjJNRGhXU0daZlJVUmtSaloyTW5rMmJURkJSRmhCWjAxeE9FaHlNVjlOT1daalpXWXhTMGgzVmpCVlNYSlRlRWN4TUZneVUwMTJVa2xmTURKcU9FVjJVV2gyZWt4dVMzRXhiRWgxTUUxMmVEZHdhV1IzYkU4NVJVdG5iRmRTY2tGTlh5MVlRMmczVW1WaE4wWmxaVU16VW00d1dqQnRUMFpZVEhaUVdESkxlWEJ5ZDFCemFHOWpZemxhTW5rNFJYVmlSVzVaT1Zka1pqazJNRUZtVTJwTGIyOHRXRlphVGxoNk5WVlZiSFZoWW5WdVlrRkNlSEJ1VWpsTlMzZzRaMnhoWjBwT1RHcFdOMjB4YzFCT1RrMVBaa1YzT1hoU1V6RjBkWE5sV2sxNFdURnRiRFJDVVVSb1IwWTROa1ZXU0hkUmFXbGpWRGhDYmxkVVVFRlBZVk5uWVVwWk1tVndjMTluVDI5aVptY3VZazFaZVdKSE5EVlFRblJNVG14TVUxOUxiRzVOUVM1Mk1tUmZkVmN5T0c5T1JqUnVUV2xPWTBOeVdWSktlSEJ6YlhJd09XZHRiM0ZSUkZkVk5FRldTMFJ6Wm5VNVltdENTRVJuTnpGclNHaGtNMDV6UTJselpXSmlia2swWVUxWE1sTkxNV054UzNCWVgwaFBNRGswU0hoeVZHeEtUV3gwY21kS2VIWjJMWGd4VVU5eVlXNUNTMnRxY0hsNlpVcDNabWRXWXkxblJ6SktPV2d4U25jMFdIRm1Nbk5ZZFZwbWQzSnJSM0pZTjAxcWFXTnRhVWxuZERGU1lURjZkRGRUYUVvemRucFlSRm81V2paTFUyaDFZWEF6TkZFd05VcERaRUpVTUhseFdqZHVaM2hwWjJ4c2EzbDFWazFRWXpkbWRpMUJkMWhzYkRoc2FtUm9la3BsYmxKdFR6ZEhVRnBtY0dsRlVUWkNTVjl2WWpWTmJERllTRlZHWXpSUFRXZG5TR3hOUW0xWFRqWkxhVVJFUldsUlIyaERaVlZpWW01MmJXTXVMVlZhVUVoME4zUkVPVGRmWVdONFgyRk5SakptUVE9PSIKfQ=="
  ];
  $fluidData = new CyberSource\Model\V2paymentsPaymentInformationCard($fluidDataArr);
  $paymentInfoArr = [
      'fluidData' => $fluidData
      
  ];
  $payment_information = new CyberSource\Model\V2paymentsPaymentInformation($paymentInfoArr);

  $paymentRequestArr = [
    'clientReferenceInformation' => $client_reference_information,
    'orderInformation' => $order_information,
    'paymentInformation' => $payment_information,
    'processingInformation' => $processingInformation
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
	AuthorizeSamsungPayCyberSourceDecryption();

}

?>	
