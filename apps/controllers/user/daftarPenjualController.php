<?php
require_once '../auth/auth_check.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/sellerApplicationModel.php';

$id_user = $_SESSION['id_user'];
// Menangkap pesan dari URL jika ada (setelah proses redirect)
$pesan = $_GET['pesan'] ?? "";

$dataPengajuanPenjual = getPengajuanPenjual($conn, $id_user);

// buat deklarasi status biar di formpenjual.php bisa dicek statusnya
$status = "";
if($dataPengajuanPenjual){
    $status = $dataPengajuanPenjual['status'];
}

if(isset($_POST['kirim_pengajuan'])){
    $nama_toko = trim($_POST['nama_toko']);
    $catatan_tambahan = trim($_POST['catatan_tambahan']);

    // Ambil info file
    $foto_name = $_FILES['foto_ktp']['name'];
    $foto_tmp  = $_FILES['foto_ktp']['tmp_name'];
    $foto_size = $_FILES['foto_ktp']['size'];
    $foto_error = $_FILES['foto_ktp']['error'];

    if(empty($nama_toko) || empty($foto_name)){
        $pesan = "Nama toko dan foto KTP wajib diisi.";
    } elseif (strlen($nama_toko) > 30 ){
        $pesan = "Nama toko terlalu panjang.";
    } elseif ($foto_size > 2000000){
        $pesan = "Ukuran file terlalu besar.";
    } else {
        $ekstensi = pathinfo($foto_name, PATHINFO_EXTENSION);
        $nama_file_baru = "ktp_" . $id_user . "_" . time() . "." . $ekstensi;
        $folder_tujuan = "../../../assets/images/ktp/" . $nama_file_baru;

        if(move_uploaded_file($foto_tmp, $folder_tujuan)){
            $query = "INSERT INTO seller_application (id_user, nama_toko, foto_data_diri, catatan, status) VALUES (?, ?, ?, ?, 'pending')";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("isss", $id_user, $nama_toko, $nama_file_baru, $catatan_tambahan);
        
            if($stmt->execute()){
                header("Location: daftarPenjualController.php");
                exit();
            } else {
                $pesan = "Gagal menyimpan data: " . $conn->error;
            }
        } else {
            $pesan = "Gagal mengunggah file.";
        }
    }
    // Redirect kembali ke Controller ini agar pesan bisa ditampilkan dan mencegah form tersubmit ulang saat refresh
    header("Location: daftarPenjualController.php?pesan=" . urlencode($pesan));
    exit();
} 


require_once '../../views/user/formDaftarPenjual.php';
?>
