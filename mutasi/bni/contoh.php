<?php

require("../connection.php");

$username = 'RABA418184'; // Username ibanking BNI
$password = 'randy27bast'; // Password ibanking BNI
$nomor_rekening = '0334152829'; // Nomor rekening BNI
$jangka_waktu = 3; // Jangka waktu ambil mutasi dari hari ini ke belakang, misal: 7 (seminggu kebelakang)
$cek_saldo = true; // Ngecek saldo akhir, value true atau false

include 'mutasi_bni.php';

if (date_default_timezone_get() != 'ASIA/Jakarta')
    date_default_timezone_set('ASIA/Jakarta');

header("Content-Type: text/plain");
$data_bni = mutasi_bni($username, $password, $nomor_rekening, $jangka_waktu, $cek_saldo);
print_r($data_bni);
// Select Database

foreach($data_bni["trx"] as $d)
{
	if(!empty($d["kredit"]))
	{
		//echo $d["tanggal"]." |".$d["keterangan"]." |".$d["kredit"]."<br/>";
		$tanggal 	= date("Y-m-d", strtotime($d["tanggal"]));
		$keterangan = $d["keterangan"];
		$kredit		= $d["kredit"];
		$sql = "SELECT * FROM bank WHERE nama='BNI' AND value=$kredit AND keterangan='$keterangan' AND tanggal='$tanggal'";

		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0)
		{
			continue;
		}
		
		// Status 0 = data belum Terpakai
		$sql	= "INSERT INTO bank (nama,value,keterangan,tanggal,status) VALUES ('BNI',".$d['kredit'].",'".$d['keterangan']."','".$tanggal."','0')";
		$conn->query($sql);
	}
}


$update_date 	= date("Y-m-d H:i:s");
$sql = "UPDATE info_bank SET update_date='$update_date' WHERE nama='BNI'";
$conn->query($sql);
$conn->close();	

?>