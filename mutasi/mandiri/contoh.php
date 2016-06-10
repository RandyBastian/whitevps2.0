<?php
$bank_name 		= 'mandiri';
$bank_username 	= "randybas27";
$bank_password 	= "199517";
$start_date 	= date("Y-m-d",strtotime("-3 day"));
$end_date 		= date("Y-m-d");
$server 		= $_SERVER["SERVER_NAME"];

$link 			= "http://$server/mutasi/mandiri/index.php?bank_name=mandiri&bank_username=$bank_username&bank_password=$bank_password&start_date=$start_date&finish_date=$end_date";
echo $link;
$response 		= file_get_contents($link);
echo $response;
?>