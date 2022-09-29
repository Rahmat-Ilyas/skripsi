<?php 
header('Content-Type: application/json');
$conn = pg_connect("host=localhost port=5444 dbname=i5_MaccaMart user=sysi5adm password=");

if (isset($_POST['get_data'])) {
	$date_now = date('Y-m-d H:i:s', strtotime('2022-08-01'));

	$tbl_itemjenis = pg_query($conn, "SELECT jenis, ketjenis FROM tbl_itemjenis");
	$tbl_itemjenis = pg_fetch_all($tbl_itemjenis);

	$tbl_itemstok = pg_query($conn, "SELECT * FROM tbl_itemstok");
	$tbl_itemstok = pg_fetch_all($tbl_itemstok);

	$tbl_supel = pg_query($conn, "SELECT kode, tipe, nama, alamat, kota, provinsi, telepon, kontak, keterangan FROM tbl_supel");
	$tbl_supel = pg_fetch_all($tbl_supel);

	$tbl_perkiraan = pg_query($conn, "SELECT * FROM tbl_perkiraan");
	$tbl_perkiraan = pg_fetch_all($tbl_perkiraan);

	// Get data using time range
	$tgl_item = $_POST['date']['tbl_item'];
	$tbl_item = pg_query($conn, "SELECT kodeitem, namaitem, jenis, tipe, stokmin, rak, satuan, hargapokok, hargajual1, keterangan, stok, dept, dateupd, tanggal_add FROM tbl_item WHERE tanggal_add BETWEEN '$tgl_item' AND '$date_now'");
	$tbl_item = pg_fetch_all($tbl_item);

	$tgl_accjurnal = $_POST['date']['tbl_accjurnal'];
	$tbl_accjurnal = pg_query($conn, "SELECT * FROM tbl_accjurnal WHERE tanggal BETWEEN '$tgl_accjurnal' AND '$date_now'");
	$tbl_accjurnal = pg_fetch_all($tbl_accjurnal);

	$tgl_ikdt = $_POST['date']['tbl_ikdt'];
	$tbl_ikdt = pg_query($conn, "SELECT iddetail, notransaksi, kodeitem, jumlah, jmlpesan, satuan, harga, total, jmlkeluar, dateupd FROM tbl_ikdt WHERE dateupd BETWEEN '$tgl_ikdt' AND '$date_now'");
	$tbl_ikdt = pg_fetch_all($tbl_ikdt);

	$tgl_ikhd = $_POST['date']['tbl_ikhd'];
	$tbl_ikhd = pg_query($conn, "SELECT notransaksi, kodekantor, tanggal, tipe, kodesupel, keterangan, totalitem, subtotal, totalakhir, jmltunai, dateupd, user1 FROM tbl_ikhd WHERE tanggal BETWEEN '$tgl_ikhd' AND '$date_now'");
	$tbl_ikhd = pg_fetch_all($tbl_ikhd);

	$tgl_imdt = $_POST['date']['tbl_imdt'];
	$tbl_imdt = pg_query($conn, "SELECT iddetail, nobaris, notransaksi, kodeitem, jumlah, jmlpesan, satuan, harga, total, jmlmasuk, jmlkeluar, dateupd FROM tbl_imdt WHERE dateupd BETWEEN '$tgl_imdt' AND '$date_now'");
	$tbl_imdt = pg_fetch_all($tbl_imdt);

	$tgl_imhd = $_POST['date']['tbl_imhd'];
	$tbl_imhd = pg_query($conn, "SELECT notransaksi, kodekantor, kantortujuan, tanggal, tipe, kodesupel, keterangan, totalitem, subtotal, totalakhir, dateupd FROM tbl_imhd WHERE tanggal BETWEEN '$tgl_imhd' AND '$date_now'");
	$tbl_imhd = pg_fetch_all($tbl_imhd);

	$data = [
		'tbl_item' => $tbl_item,
		'tbl_itemjenis' => $tbl_itemjenis,
		'tbl_itemstok' => $tbl_itemstok,
		'tbl_supel' => $tbl_supel,
		'tbl_perkiraan' => $tbl_perkiraan,
		'tbl_accjurnal' => $tbl_accjurnal,
		'tbl_ikdt' => $tbl_ikdt,
		'tbl_ikhd' => $tbl_ikhd,
		'tbl_imdt' => $tbl_imdt,
		'tbl_imhd' => $tbl_imhd,
	];

	echo json_encode($data);
}