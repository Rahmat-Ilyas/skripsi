<?php 
header('Content-Type: application/json');
$conn = pg_connect("host=localhost port=5444 dbname=i5_MaccaMart user=sysi5adm password=");

if (isset($_POST['get_data'])) {
	// Get Count Data
	$tbl_itemjenis = pg_query($conn, "SELECT jenis FROM tbl_itemjenis");
	$count_itemjenis = pg_num_rows($tbl_itemjenis);

	$tbl_itemstok = pg_query($conn, "SELECT kodeitem FROM tbl_itemstok");
	$count_itemstok = pg_num_rows($tbl_itemstok);

	$tbl_supel = pg_query($conn, "SELECT kode FROM tbl_supel");
	$count_supel = pg_num_rows($tbl_supel);

	$tbl_perkiraan = pg_query($conn, "SELECT kodeacc FROM tbl_perkiraan");
	$count_perkiraan = pg_num_rows($tbl_perkiraan);

	$tbl_item = pg_query($conn, "SELECT kodeitem FROM tbl_item");
	$count_item = pg_num_rows($tbl_item);

	$tbl_accjurnal = pg_query($conn, "SELECT iddetail FROM tbl_accjurnal");
	$count_accjurnal = pg_num_rows($tbl_accjurnal);

	$tbl_ikdt = pg_query($conn, "SELECT iddetail FROM tbl_ikdt");
	$count_ikdt = pg_num_rows($tbl_ikdt);

	$tbl_ikhd = pg_query($conn, "SELECT notransaksi FROM tbl_ikhd");
	$count_ikhd = pg_num_rows($tbl_ikhd);

	$tbl_imdt = pg_query($conn, "SELECT iddetail FROM tbl_imdt");
	$count_imdt = pg_num_rows($tbl_imdt);

	$tbl_imhd = pg_query($conn, "SELECT notransaksi FROM tbl_imhd");
	$count_imhd = pg_num_rows($tbl_imhd);

	$count_data = [
		'tbl_item' => $count_item,
		'tbl_itemjenis' => $count_itemjenis,
		'tbl_itemstok' => $count_itemstok,
		'tbl_supel' => $count_supel,
		'tbl_perkiraan' => $count_perkiraan,
		'tbl_accjurnal' => $count_accjurnal,
		'tbl_ikdt' => $count_ikdt,
		'tbl_ikhd' => $count_ikhd,
		'tbl_imdt' => $count_imdt,
		'tbl_imhd' => $count_imhd,
	];

	// Push Data
	$limit1 = 5000;
	$limit2 = 10000;
	$tbl_item = false;
	$tbl_itemjenis = false;
	$tbl_itemstok = false;
	$tbl_supel = false;
	$tbl_perkiraan = false;
	$tbl_accjurnal = false;
	$tbl_ikdt = false;
	$tbl_ikhd = false;
	$tbl_imdt = false;
	$tbl_imhd = false;

	$cnt_itemjenis = $_POST['data']['tbl_itemjenis'];
	if ($cnt_itemjenis < $count_data['tbl_itemjenis']) {
		$tbl_itemjenis = pg_query($conn, "SELECT jenis, ketjenis FROM tbl_itemjenis ORDER BY jenis ASC OFFSET $cnt_itemjenis LIMIT $limit1");
		$tbl_itemjenis = pg_fetch_all($tbl_itemjenis);
	}

	$cnt_itemstok = $_POST['data']['tbl_itemstok'];
	if ($cnt_itemstok < $count_data['tbl_itemstok']) {
		$tbl_itemstok = pg_query($conn, "SELECT * FROM tbl_itemstok ORDER BY kodeitem ASC OFFSET $cnt_itemstok LIMIT $limit2");
		$tbl_itemstok = pg_fetch_all($tbl_itemstok);
	}

	$cnt_supel = $_POST['data']['tbl_supel'];
	if ($cnt_supel < $count_data['tbl_supel']) {
		$tbl_supel = pg_query($conn, "SELECT kode, tipe, nama, alamat, kota, provinsi, telepon, kontak, keterangan FROM tbl_supel ORDER BY kode ASC OFFSET $cnt_supel LIMIT $limit1");
		$tbl_supel = pg_fetch_all($tbl_supel);
	}

	$cnt_perkiraan = $_POST['data']['tbl_perkiraan'];
	if ($cnt_perkiraan < $count_data['tbl_perkiraan']) {
		$tbl_perkiraan = pg_query($conn, "SELECT * FROM tbl_perkiraan ORDER BY dateupd ASC OFFSET $cnt_perkiraan LIMIT $limit1");
		$tbl_perkiraan = pg_fetch_all($tbl_perkiraan);
	}

	$cnt_item = $_POST['data']['tbl_item'];
	if ($cnt_item < $count_data['tbl_item']) {
		$tbl_item = pg_query($conn, "SELECT kodeitem, namaitem, jenis, tipe, stokmin, rak, satuan, hargapokok, hargajual1, keterangan, supplier1, stok, dept, dateupd, tanggal_add FROM tbl_item ORDER BY tanggal_add ASC OFFSET $cnt_item LIMIT $limit1");
		$tbl_item = pg_fetch_all($tbl_item);
	}

	$cnt_accjurnal = $_POST['data']['tbl_accjurnal'];
	if ($cnt_accjurnal < $count_data['tbl_accjurnal']) {
		$tbl_accjurnal = pg_query($conn, "SELECT * FROM tbl_accjurnal ORDER BY tanggal ASC OFFSET $cnt_accjurnal LIMIT $limit2");
		$tbl_accjurnal = pg_fetch_all($tbl_accjurnal);
	}

	$cnt_ikdt = $_POST['data']['tbl_ikdt'];
	if ($cnt_ikdt < $count_data['tbl_ikdt']) {
		$tbl_ikdt = pg_query($conn, "SELECT iddetail, notransaksi, kodeitem, jumlah, jmlpesan, satuan, harga, total, jmlkeluar, dateupd FROM tbl_ikdt ORDER BY dateupd ASC OFFSET $cnt_ikdt LIMIT $limit2");
		$tbl_ikdt = pg_fetch_all($tbl_ikdt);
	}

	$cnt_ikhd = $_POST['data']['tbl_ikhd'];
	if ($cnt_ikhd < $count_data['tbl_ikhd']) {
		$tbl_ikhd = pg_query($conn, "SELECT notransaksi, kodekantor, tanggal, tipe, kodesupel, keterangan, totalitem, subtotal, totalakhir, jmltunai, dateupd, user1 FROM tbl_ikhd ORDER BY tanggal ASC OFFSET $cnt_ikhd LIMIT $limit2");
		$tbl_ikhd = pg_fetch_all($tbl_ikhd);
	}

	$cnt_imdt = $_POST['data']['tbl_imdt'];
	if ($cnt_imdt < $count_data['tbl_imdt']) {
		$tbl_imdt = pg_query($conn, "SELECT iddetail, nobaris, notransaksi, kodeitem, jumlah, jmlpesan, satuan, harga, total, jmlmasuk, jmlkeluar, dateupd FROM tbl_imdt ORDER BY dateupd ASC OFFSET $cnt_imdt LIMIT $limit1");
		$tbl_imdt = pg_fetch_all($tbl_imdt);
	}

	$cnt_imhd = $_POST['data']['tbl_imhd'];
	if ($cnt_imhd < $count_data['tbl_imhd']) {
		$tbl_imhd = pg_query($conn, "SELECT notransaksi, kodekantor, kantortujuan, tanggal, tipe, kodesupel, keterangan, totalitem, subtotal, totalakhir, dateupd FROM tbl_imhd ORDER BY tanggal ASC OFFSET $cnt_imhd LIMIT $limit1");
		$tbl_imhd = pg_fetch_all($tbl_imhd);
	}

	$status = [];
	foreach ($_POST['data'] as $key => $cnt) {
		if ($key == 'tbl_accjurnal' || $key == 'tbl_ikdt' || $key == 'tbl_ikhd' || $key == 'tbl_itemstok') $limit = $limit2;
		else $limit = $limit1;

		if ($cnt + $limit > $count_data[$key]) $status[] = false;
		else $status[] = true;
	}

	$loop = false;
	if (in_array(true, $status)) $loop = true;

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

	echo json_encode([
		'data' => $data,
		'loop' => $loop
	]);
}

// if (isset($_POST['get_data'])) {
// 	$date_now = date('Y-m-d H:i:s', strtotime('2022-10-01'));

// 	$tbl_itemjenis = pg_query($conn, "SELECT jenis, ketjenis FROM tbl_itemjenis");
// 	$tbl_itemjenis = pg_fetch_all($tbl_itemjenis);

// 	$tbl_itemstok = pg_query($conn, "SELECT * FROM tbl_itemstok");
// 	$tbl_itemstok = pg_fetch_all($tbl_itemstok);

// 	$tbl_supel = pg_query($conn, "SELECT kode, tipe, nama, alamat, kota, provinsi, telepon, kontak, keterangan FROM tbl_supel");
// 	$tbl_supel = pg_fetch_all($tbl_supel);

// 	$tbl_perkiraan = pg_query($conn, "SELECT * FROM tbl_perkiraan");
// 	$tbl_perkiraan = pg_fetch_all($tbl_perkiraan);

// 	// Get data using time range
// 	$tgl_item = $_POST['date']['tbl_item'];
// 	$tbl_item = pg_query($conn, "SELECT kodeitem, namaitem, jenis, tipe, stokmin, rak, satuan, hargapokok, hargajual1, keterangan, supplier1, stok, dept, dateupd, tanggal_add FROM tbl_item WHERE tanggal_add BETWEEN '$tgl_item' AND '$date_now'");
// 	$tbl_item = pg_fetch_all($tbl_item);

// 	$tgl_accjurnal = $_POST['date']['tbl_accjurnal'];
// 	$tbl_accjurnal = pg_query($conn, "SELECT * FROM tbl_accjurnal WHERE tanggal BETWEEN '$tgl_accjurnal' AND '$date_now'");
// 	$tbl_accjurnal = pg_fetch_all($tbl_accjurnal);

// 	$tgl_ikdt = $_POST['date']['tbl_ikdt'];
// 	$tbl_ikdt = pg_query($conn, "SELECT iddetail, notransaksi, kodeitem, jumlah, jmlpesan, satuan, harga, total, jmlkeluar, dateupd FROM tbl_ikdt WHERE dateupd BETWEEN '$tgl_ikdt' AND '$date_now'");
// 	$tbl_ikdt = pg_fetch_all($tbl_ikdt);

// 	$tgl_ikhd = $_POST['date']['tbl_ikhd'];
// 	$tbl_ikhd = pg_query($conn, "SELECT notransaksi, kodekantor, tanggal, tipe, kodesupel, keterangan, totalitem, subtotal, totalakhir, jmltunai, dateupd, user1 FROM tbl_ikhd WHERE tanggal BETWEEN '$tgl_ikhd' AND '$date_now'");
// 	$tbl_ikhd = pg_fetch_all($tbl_ikhd);

// 	$tgl_imdt = $_POST['date']['tbl_imdt'];
// 	$tbl_imdt = pg_query($conn, "SELECT iddetail, nobaris, notransaksi, kodeitem, jumlah, jmlpesan, satuan, harga, total, jmlmasuk, jmlkeluar, dateupd FROM tbl_imdt WHERE dateupd BETWEEN '$tgl_imdt' AND '$date_now'");
// 	$tbl_imdt = pg_fetch_all($tbl_imdt);

// 	$tgl_imhd = $_POST['date']['tbl_imhd'];
// 	$tbl_imhd = pg_query($conn, "SELECT notransaksi, kodekantor, kantortujuan, tanggal, tipe, kodesupel, keterangan, totalitem, subtotal, totalakhir, dateupd FROM tbl_imhd WHERE tanggal BETWEEN '$tgl_imhd' AND '$date_now'");
// 	$tbl_imhd = pg_fetch_all($tbl_imhd);

// 	$data = [
// 		'tbl_item' => $tbl_item,
// 		'tbl_itemjenis' => $tbl_itemjenis,
// 		'tbl_itemstok' => $tbl_itemstok,
// 		'tbl_supel' => $tbl_supel,
// 		'tbl_perkiraan' => $tbl_perkiraan,
// 		'tbl_accjurnal' => $tbl_accjurnal,
// 		'tbl_ikdt' => $tbl_ikdt,
// 		'tbl_ikhd' => $tbl_ikhd,
// 		'tbl_imdt' => $tbl_imdt,
// 		'tbl_imhd' => $tbl_imhd,
// 	];

// 	echo json_encode($data);
// }