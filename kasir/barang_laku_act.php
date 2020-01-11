<?php 

include '../fungsi.php';
if (isset($_POST['simpan'])) {
$id_penjualan = $_POST['id_penjualan'];
$id_kasir = $_POST['id_kasir'];
$id_buku = $_POST['id_buku'];
$judul = $_POST['judul'];
$harga = $_POST['harga'];
$jumlah = $_POST['jumlah'];
$total = $_POST['total'];
$laba = $_POST['laba'];
$tanggal = $_POST['tanggal'];
    $qu = "INSERT INTO tbl_sementara_penjualan VALUES ('$id_penjualan', '$id_buku', '$id_kasir', '$judul', '$harga', '$jumlah', '$total', '$laba', '$tanggal')";
    $con->exec($qu);
    header("location:barang_laku.php");
}elseif (isset($_POST['proses'])) {
	$id_penjualan = $_POST['id_penjualan'];
	$id_kasir = $_POST['id_kasir'];
	$jumlah = $_POST['jumlah'];	
$total = $_POST['total'];
$bayar = $_POST['bayar'];
$kembali = $_POST['kembali'];
$laba = $_POST['laba'];
$tanggal = $_POST['tanggal'];
$qu = "INSERT INTO penjualan VALUES ('$id_penjualan', '$id_kasir', '$jumlah', '$total', '$bayar', '$kembali', '$laba', '$tanggal')";
    $con->exec($qu);
     if($qu){
        $prepare = $con->prepare("SELECT * from tbl_sementara_penjualan");
            $prepare->execute();
       foreach ($prepare as $data) :
         $prepare1 = $con->prepare("INSERT INTO detail_penjualan VALUES ('$data[id_penjualan]','$data[id_buku]','$data[id_kasir]','$data[judul]','$data[harga]','$data[jumlah]','$data[total]','$data[laba]','$data[tanggal]')");
            $prepare1->execute();
             $prepare2 = $con->prepare("UPDATE buku set stok=stok-'$data[jumlah]'
                        where id_buku='$data[id_buku]'");
            $prepare2->execute();
      endforeach;
        $prepare3 = $con->prepare("TRUNCATE TABLE tbl_sementara_penjualan");
            $prepare3->execute();
            
}
header("location:barang_laku.php");
} 

?>