<?php

function getAllKategori($conn){
    $query = $conn -> prepare("
        SELECT id_kategori, nama_kategori
        FROM kategori
        ORDER BY id_kategori ASC
    ");
    $query -> execute();
    $dataKategori = $query -> get_result();
    return $dataKategori -> fetch_all(MYSQLI_ASSOC);
}

function slugKategori($namaKategori){
    return strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $namaKategori), '-'));
}

function iconKategoriDashboard($slugKategori)
{
    $icons = [
        'semua' => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/>',
        'elektronik' => '<rect x="2" y="5" width="20" height="14" rx="2"/><line x1="8" y1="19" x2="8" y2="21"/><line x1="16" y1="19" x2="16" y2="21"/><line x1="5" y1="21" x2="19" y2="21"/>',
        'pakaian' => '<path d="M20.38 3.46L16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.57a1 1 0 0 0 .99.84H6v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.57a2 2 0 0 0-1.34-2.23z"/>',
        'buku' => '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>',
        'perabot' => '<path d="M20 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v3"/><path d="M2 11a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3H2v-3z"/><path d="M4 14v5M20 14v5"/><line x1="6" y1="19" x2="18" y2="19"/>',
        'olahraga' => '<circle cx="12" cy="12" r="10"/><path d="M4.93 4.93l4.24 4.24"/><path d="M14.83 9.17l4.24-4.24"/><path d="M14.83 14.83l4.24 4.24"/><path d="M9.17 14.83l-4.24 4.24"/><circle cx="12" cy="12" r="4"/>',
        'mainan' => '<rect x="2" y="5" width="20" height="14" rx="3"/><line x1="6" y1="5" x2="6" y2="19"/><line x1="18" y1="5" x2="18" y2="19"/><line x1="2" y1="12" x2="22" y2="12"/>',
        'anak' => '<circle cx="12" cy="7" r="4"/><path d="M5.5 21c0-3.5 3-6 6.5-6s6.5 2.5 6.5 6"/>',
        'handphone' => '<rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/>',
        'kendaraan' => '<rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4l3 5v3h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
        'dapur' => '<path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/>',
        'tas' => '<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>',
        'sepatu' => '<path d="M3 10h11a4 4 0 0 1 4 4v2H3v-6z"/><path d="M3 16v2a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-2"/><path d="M9 10V6a3 3 0 0 1 6 0v4"/>',
        'kamera' => '<path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/>',
        'alat-tulis' => '<line x1="12" y1="20" x2="12" y2="4"/><path d="M8 8l4-4 4 4"/><rect x="4" y="20" width="16" height="2" rx="1"/>',
        'koleksi' => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
        'kesehatan' => '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>',
        'lainnya' => '<circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/>',
    ];

    return $icons[$slugKategori] ?? $icons['lainnya'];
}

?>
