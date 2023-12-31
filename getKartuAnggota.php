<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cetak kartu anggota</title>
	<link rel="stylesheet" href="">
	<style >
	@media print{
		.cetak{
			display: none;
			height: 0;
		}
		.namakartu{
			font-family: arial;
			font-size: 14px;
			text-align: center;
		}
		.namajl{
			font-size: 11px;
 			text-align: center;
		}
		.namasd{
			font-size: 18px;
			text-align: center;
			font-weight: bold;
		}
		tr.border_bawah{
	 	
		    border-bottom: solid 1px #000;
		}
		table{
			width: 400px;
			/*table-layout: fixed;*/
			border-collapse: collapse;
		}
	}

	/*untuk tampil sblm cetak klik*/
		.namakartu{
			font-family: arial;
			font-size: 14px;
			text-align: center;
		}
		.namajl{
			font-size: 11px;
 			text-align: center;
		}
		.namasd{
			font-size: 18px;
			text-align: center;
			font-weight: bold;
		}
		tr.border_bawah{
	 	
		    border-bottom: solid 1px #000;
		}
		table{
			width: 400px;
			/*table-layout: fixed;*/
			border-collapse: collapse;
		}
	</style>
</head>
<body>
<?php 
include('system/php-mysqli/MysqliDb.php');
include('system/php-barcode/src/BarcodeGenerator.php');
include('system/php-barcode/src/BarcodeGeneratorPNG.php');
include('system/php-barcode/src/BarcodeGeneratorHTML.php');

$db = new MysqliDb();
$barcode = new Picqer\Barcode\BarcodeGeneratorHTML();
$barcodepng = new Picqer\Barcode\BarcodeGeneratorPNG();

$id = $_GET['uid'];
$db->where('uid', $id);
$ang = $db->getOne('anggota');
?>
<button class="cetak" id="cetak" onclick="cetak()">Cetak</button>
<p></p>
	<table class="tab" >
		<!-- header -->
		<tr class="border_bawah">
			<td rowspan="4"><img src="assets/images/logo.png" alt="" width="50" height="50"></td>
		</tr>
		<tr>
			<td class="namakartu">KARTU PERPUSTAKAAN</td>
		</tr>
		<tr>
			<td class="namasd">SDN 01 GABUS PATI</td>
		</tr>
		<tr class="border_bawah">
			<td class="namajl">Jl. Sembarang ngalor ngidul asolole</td>
		</tr>
	</table>
		<!-- isi -->
	<table class="tab">
		<tr>
			<td rowspan="6"><img src="assets/images/3x4.png" alt="" width="80" height="60"></td>
		</tr>
		<tr>
			<td>UID</td>
			<td>:</td>
			<td><?= $ang['uid'] ?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?= $ang['nama'] ?></td>
		</tr>
		<tr>
			<td>TTL</td>
			<td>:</td>
			<td><?= $ang['ttl'] ?></td>
		</tr>
		<tr>
			<td>Masa berlaku</td>
			<td>:</td>
			<td><?= $ang['tgl_berakhir'] ?></td>
		</tr>
		<tr>
			<td>Gambar</td>
			<td>:</td>
			<td><?php //$barcode->getBarcode($ang['id_anggota'], $barcodepng::TYPE_CODE_128); ?>
			<img src="data:image/png;base64,<?= base64_encode($barcodepng->getBarcode($ang['uid'], $barcodepng::TYPE_CODE_128)) ?>" alt="">
			</td>
		</tr>
	</table>
</body>
<script type="text/javascript">
	function cetak() {
		window.print();
	}
</script>
</html>