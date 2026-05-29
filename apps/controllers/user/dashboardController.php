<?php
require_once '../auth/auth_check.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/userModel.php';
require_once '../../models/produkModel.php';
require_once '../../models/kategoriModel.php';
require_once '../../models/ulasanModel.php';

$id_user = $_SESSION['id_user'];
$dataUser = getDataUSer($conn, $id_user);

$allowedSortValues = ['terbaru', 'termurah', 'termahal'];
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $allowedSortValues, true)
    ? $_GET['sort']
    : 'terbaru';

$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : null;
$currentKategori = isset($_GET['kat']) ? trim($_GET['kat']) : 'semua';

$dataKategori = getAllKategori($conn);
$validKategoriSlugs = array_map(fn($kategori) => slugKategori($kategori['nama_kategori']), $dataKategori);
if ($currentKategori !== 'semua' && !in_array($currentKategori, $validKategoriSlugs, true)) {
    $currentKategori = 'semua';
}

$dataProdukMarketplace = formatProdukUntukJs(getAllProdukMarketplace($conn, $sort, 8, $searchQuery));
$selectedSort = $sort;
$searchValue = $searchQuery;

$daftarUlasanBelumDiisi = getUlasanKosong($conn, $id_user);


require_once '../../views/user/dashboard.php';
?>
