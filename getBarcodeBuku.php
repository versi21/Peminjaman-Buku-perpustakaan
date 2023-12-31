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
$db->where('uid_buku', $id);
$ang = $db->getOne('buku');
?>
<button class="cetak" id="cetak" onclick="cetak()">Cetak</button>
<p></p>
<h3><?php echo $ang['judul'] ?></h3>
<img src="data:image/png;base64,<?= base64_encode($barcodepng->getBarcode($ang['uid_buku'], $barcodepng::TYPE_CODE_128)) ?>" alt="">
</body>
<script type="text/javascript">
	function cetak() {
		window.print();
	}
</script>
</html>