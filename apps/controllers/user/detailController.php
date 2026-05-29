<?php
require_once '../auth/auth_check.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/userModel.php';
require_once '../../models/produkModel.php';
require_once '../../models/kategoriModel.php';

$id_user = $_SESSION['id_user'];
$dataUser = getDataUSer($conn, $id_user);
$id_produk = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$idProduk = $id_produk;
$dataProdukMarketplace = formatProdukUntukJs(getAllProdukMarketplace($conn));
$dataProdukDetail = $id_produk > 0 ? getProdukMarketplaceById($conn, $id_produk) : null;

$product = $dataProdukDetail;
if ($product) {
    $product['nama'] = $product['nama_barang'] ?? '';
}
$notFound = $product === null;
$fotoProduk = $product ? resolveFotoProdukPath($product['foto_barang'] ?? '') : 'produk/produk.png';
$kategoriSlug = $product ? slugKategori($product['nama_kategori']) : 'semua';
$kategoriLabel = $product['nama_kategori'] ?? 'Kategori';
$kondisi = $product['kondisi'] ?? 'bekas';
$kondisiLabelMap = [
    'baru' => 'Baru',
    'seperti-baru' => 'Seperti Baru',
    'bekas' => 'Bekas',
];
$kondisiLabel = $kondisiLabelMap[$kondisi] ?? ucfirst($kondisi);
$sellerName = !empty($product['nama_toko']) ? $product['nama_toko'] : ($product['username'] ?? 'Penjual Secondify');
$sellerInitial = strtoupper(substr(trim($sellerName), 0, 1)) ?: 'S';
$terjualLabel = ($product['status'] ?? '') !== 'available' ? 'Sudah Terjual' : 'Tersedia';
$chatUrl = $product ? SECONDIFY . "/apps/views/user/chat.php?id_produk={$product['id_produk']}&id_penjual={$product['id_user']}" : '#';
$title = $notFound ? 'Produk Tidak Ditemukan — Secondify' : htmlspecialchars($product['nama'] . ' — Secondify');
$bcSubKategori = $product && !empty($product['sub_kategori']) ? htmlspecialchars($product['sub_kategori']) : '';
$hasSubKategori = !$notFound && $bcSubKategori !== '';
$detailsKategori = $hasSubKategori ? htmlspecialchars($kategoriLabel) . ' › ' . $bcSubKategori : htmlspecialchars($kategoriLabel);

require_once '../../views/user/detail.php';
?>
