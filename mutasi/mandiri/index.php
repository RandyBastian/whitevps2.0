<?php
/*
    Title: Script cek mutasi bank Mandiri
    Description: Digunakan untuk memudahkan dalam pengecekan mutasi bank mandiri
    Author: terminaldx@gmail.com
    Version: 1.2
    Last Updated: 12 Dec 2015 12:39
    Licence: Hanya untuk dipakai personal, satu akun internet banking mandiri.
             Tidak boleh disebarkan, diperjualbelikan, digunakan untuk aktifitas ilegal, dan melanggar hukum di Indonesia.

Update 13 desember 2015
Bisa untuk rekening ke 1, 2, 3, dst..
dengan parameter 'index_rekening' bisa POST['index_rekening'] atau GET['index_rekening']             
*/
require("../connection.php");
require_once('Cekmutasi.php');

if (date_default_timezone_get() != 'ASIA/Jakarta')
    date_default_timezone_set('ASIA/Jakarta');

if (!isset($_REQUEST['bank_name']) OR !isset($_REQUEST['bank_username']) OR !isset($_REQUEST['bank_password'])) exit('invalid parameters');

$cekmutasi = new Cekmutasi();

$json_response = json_encode(array());
if (strtolower($_REQUEST['bank_name'])=='mandiri') {
    $json_response = $cekmutasi->mandiri();
}

$array_data = json_decode($json_response,true);
echo '<pre>';
print_r($array_data);
echo '</pre>';

if(!empty($array_data["results"]))
{
	foreach($array_data["results"] as $a)
	{
		$tanggal 			= date("Y-m-d",strtotime($a["date"]));
		$keterangan			= $a["description"];
		$type 				= $a["type"];
		$value 				= (int)$a["nominal"];
		
		if($type == "credit")
		{
			$sql = "SELECT * FROM bank WHERE nama='MANDIRI' AND value=$value AND keterangan='$keterangan' AND tanggal='$tanggal'";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) > 0)
			{
				continue;
			}
			$sql	= "INSERT INTO bank (nama,value,keterangan,tanggal,status) VALUES ('MANDIRI',".$value.",'".$keterangan."','".$tanggal."','0')";
			$conn->query($sql);
		}
	}
}

$update_date 	= date("Y-m-d H:i:s");
$sql = "UPDATE info_bank SET update_date='$update_date' WHERE nama='MANDIRI'";
$conn->query($sql);
$conn->close();	


