<?php
require_once '../auth/auth_check.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/userModel.php';
require_once '../../models/produkModel.php';
require_once '../../models/kategoriModel.php';

$id_user = $_SESSION['id_user'];
$dataUser = getDataUSer($conn, $id_user);

$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : null;
$currentKategori = isset($_GET['kat']) ? trim($_GET['kat']) : 'semua';

$dataKategori = getAllKategori($conn);
$validKategoriSlugs = array_map(fn($kategori) => slugKategori($kategori['nama_kategori']), $dataKategori);
if ($currentKategori !== 'semua' && !in_array($currentKategori, $validKategoriSlugs, true)) {
    $currentKategori = 'semua';
}

$currentKategoriId = null;
$currentKategoriName = 'Semua';
foreach ($dataKategori as $kategori) {
    if (slugKategori($kategori['nama_kategori']) === $currentKategori) {
        $currentKategoriName = $kategori['nama_kategori'];
        $currentKategoriId = $kategori['id_kategori'];
        break;
    }
}

$dataProdukMarketplace = formatProdukUntukJs(getAllProdukMarketplace($conn, 'terbaru', null, $searchQuery, $currentKategoriId));

require_once '../../views/user/kategori.php';
?>
