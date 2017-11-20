<?php
/*
 * File ini digunakan untuk mengatur parameter-parameter standar pada kwitansi yang akan dicetak
 * termasuk nama perusahaan, alamat, nomor telpon, judul kwitansi dan nama kota
 */
Class Pengaturan{
	function __construct(){
	$this->atur['namapt']="PT. PLN (PERSERO) ";
	$this->atur['alamat']="AP2B SISTEM KALSEL & KALTENG";//pastikan ada tanda \n untuk pemisah nama jalan dan nama Kota agar tampilan lebih baik
	$this->atur['judul']="PERMOHONAN PINJAM KENDARAAN DINAS";
	$this->atur['kota']="Banjarbaru";
}
}
?>
