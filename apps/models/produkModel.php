<?php

function getDataProdukById($conn, $id_user){
    $query = $conn -> prepare("
        SELECT * FROM produk 
        JOIN kategori ON produk.id_kategori = kategori.id_kategori
        WHERE id_user = ?
    ");
    $query -> bind_param("i", $id_user);
    $query -> execute();
    $dataProduk = $query -> get_result();
    return $dataProduk -> fetch_all(MYSQLI_ASSOC);
}

function postProduk($conn, $id_user, $kategori, $namaBarang, $deskripsi, $harga, $lokasi, $kondisi, $nama_file_baru){
    $query = $conn -> prepare("INSERT INTO produk (id_user, id_kategori, nama_barang, deskripsi, harga, lokasi, kondisi, foto_barang) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $query -> bind_param("iississs", $id_user, $kategori, $namaBarang, $deskripsi, $harga, $lokasi, $kondisi, $nama_file_baru);
    $post = $query -> execute();
    return $post;
}

function totalProduk($conn, $id_user){
    $query = $conn -> prepare(  "SELECT COUNT(*) AS total
                                FROM produk
                                WHERE id_user = ?");
    $query -> bind_param("i", $id_user);
    $query -> execute();
    $total = $query -> get_result();
    $totalProduk = $total -> fetch_assoc();
    
    return $totalProduk;
}

function updateProduk($conn,$id_produk, $id_user, $kategori, $namaBarang, $deskripsi, $harga, $lokasi, $kondisi){
    $query = $conn->prepare("UPDATE produk SET id_kategori = ?, nama_barang = ?, deskripsi = ?, harga = ?, lokasi = ?, kondisi = ? WHERE id_produk = ? AND id_user = ?");
    $query->bind_param("ississii", $kategori, $namaBarang, $deskripsi, $harga, $lokasi, $kondisi, $id_produk, $id_user);
    $update = $query -> execute();
    return $update;
}

function getAllProdukMarketplace($conn, $sort = 'terbaru', $limit = null, $search = null){
    $allowedSort = [
        'terbaru' => 'produk.tgl_dibuat DESC, produk.id_produk DESC',
        'termurah' => 'produk.harga ASC, produk.tgl_dibuat DESC',
        'termahal' => 'produk.harga DESC, produk.tgl_dibuat DESC',
    ];

    $orderBy = $allowedSort[$sort] ?? $allowedSort['terbaru'];
    $sql = "SELECT
            produk.id_produk,
            produk.id_user,
            produk.id_kategori,
            produk.nama_barang,
            produk.deskripsi,
            produk.harga,
            produk.lokasi,
            produk.kondisi,
            produk.foto_barang,
            produk.status,
            produk.tgl_dibuat,
            kategori.nama_kategori,
            users.nama_lengkap,
            users.username,
            users.nama_toko,
            users.is_penjual
        FROM produk
        JOIN kategori ON produk.id_kategori = kategori.id_kategori
        JOIN users ON produk.id_user = users.id_user";

    $types = '';
    $params = [];

    if ($search !== null && trim($search) !== '') {
        $searchTerm = '%' . $search . '%';
        $sql .= " WHERE produk.nama_barang LIKE ? OR produk.deskripsi LIKE ? OR kategori.nama_kategori LIKE ? OR users.nama_lengkap LIKE ? OR users.username LIKE ? OR users.nama_toko LIKE ?";
        $types .= 'ssssss';
        $params = [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm];
    }

    $sql .= " ORDER BY {$orderBy}";

    if ($limit !== null) {
        $sql .= " LIMIT ?";
        $types .= 'i';
        $params[] = $limit;
    }

    $query = $conn -> prepare($sql);
    if (!empty($types)) {
        $query->bind_param($types, ...$params);
    }
    $query -> execute();
    $dataProduk = $query -> get_result();
    return $dataProduk -> fetch_all(MYSQLI_ASSOC);
}

function getProdukMarketplaceById($conn, $id_produk){
    $query = $conn -> prepare("
        SELECT
            produk.id_produk,
            produk.id_user,
            produk.id_kategori,
            produk.nama_barang,
            produk.deskripsi,
            produk.harga,
            produk.lokasi,
            produk.kondisi,
            produk.foto_barang,
            produk.status,
            produk.tgl_dibuat,
            kategori.nama_kategori,
            users.nama_lengkap,
            users.username,
            users.nama_toko,
            users.is_penjual
        FROM produk
        JOIN kategori ON produk.id_kategori = kategori.id_kategori
        JOIN users ON produk.id_user = users.id_user
        WHERE produk.id_produk = ?
    ");
    $query -> bind_param("i", $id_produk);
    $query -> execute();
    $dataProduk = $query -> get_result();
    return $dataProduk -> fetch_assoc();
}

function resolveFotoProdukPath($fotoBarang){
    if (empty($fotoBarang)) {
        return 'produk/produk.png';
    }

    if (strpos($fotoBarang, '/') !== false || strpos($fotoBarang, '\\') !== false) {
        $fotoBarang = basename(str_replace('\\', '/', $fotoBarang));
    }

    $basePath = realpath(__DIR__ . '/../../assets/images');

    if ($basePath && file_exists($basePath . DIRECTORY_SEPARATOR . 'produk' . DIRECTORY_SEPARATOR . $fotoBarang)) {
        return 'produk/' . $fotoBarang;
    }

    return 'produk/' . $fotoBarang;
}

function formatProdukUntukJs($produkList){
    return array_map(function($produk) {
        $namaKategori = $produk['nama_kategori'] ?? 'Lainnya';
        $slugKategori = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $namaKategori), '-'));
        $kondisi = strtolower(str_replace(' ', '-', $produk['kondisi'] ?? 'bekas'));
        $namaPenjual = !empty($produk['nama_toko']) ? $produk['nama_toko'] : ($produk['username'] ?: $produk['nama_lengkap']);
        $fotoProduk = resolveFotoProdukPath($produk['foto_barang'] ?? '');

        return [
            'id' => (int) $produk['id_produk'],
            'idUser' => (int) $produk['id_user'],
            'idKategori' => (int) $produk['id_kategori'],
            'nama' => $produk['nama_barang'],
            'harga' => (int) $produk['harga'],
            'kondisi' => $kondisi,
            'kategori' => $slugKategori,
            'kategoriLabel' => $namaKategori,
            'subKategori' => '',
            'merek' => 'lainnya',
            'merekLabel' => 'Lainnya',
            'lokasi' => $produk['lokasi'],
            'deskripsi' => $produk['deskripsi'],
            'terjual' => ($produk['status'] ?? '') !== 'available',
            'gambar' => $fotoProduk,
            'gambarList' => [$fotoProduk],
            'seller' => $namaPenjual,
            'sellerJoined' => 'Penjual Secondify',
            'createdAt' => $produk['tgl_dibuat'],
            'slug' => 'detailController.php?id=' . $produk['id_produk'],
        ];
    }, $produkList);
}

?>
