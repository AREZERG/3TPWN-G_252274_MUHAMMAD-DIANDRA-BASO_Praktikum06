<?php
require __DIR__ . "/fungsi.php";

$judulHalaman = "Katalog Buku";
$pesan = "";
$kelasPesan = "pesan-sukses";

$kategori = [
    1 => "Pemrograman",
    2 => "Novel",
    3 => "Sejarah",
    4 => "Pengembangan Diri"
];

$buku = [
    [
        "judul" => "Clean Code",
        "penulis" => "Robert C. Martin",
        "kategori" => 1,
        "tahun" => 2008,
        "stok" => 5
    ],
    [
        "judul" => "Laskar Pelangi",
        "penulis" => "Andrea Hirata",
        "kategori" => 2,
        "tahun" => 2005,
        "stok" => 4
    ],
    [
        "judul" => "Bumi Manusia",
        "penulis" => "Pramoedya Ananta Toer",
        "kategori" => 2,
        "tahun" => 1980,
        "stok" => 2
    ],
    [
        "judul" => "Sapiens",
        "penulis" => "Yuval Noah Harari",
        "kategori" => 3,
        "tahun" => 2011,
        "stok" => 3
    ],
    [
        "judul" => "Atomic Habits",
        "penulis" => "James Clear",
        "kategori" => 4,
        "tahun" => 2018,
        "stok" => 6
    ]
];

// Menangani data yang dikirim dari form tambah buku.
if (isset($_POST["simpan"])) {
    $judulBaru = trim($_POST["judul"] ?? "");
    $penulisBaru = trim($_POST["penulis"] ?? "");

    if ($judulBaru === "" || $penulisBaru === "") {
        $pesan = "Judul dan penulis wajib diisi.";
        $kelasPesan = "pesan-error";
    } else {
        $buku[] = [
            "judul" => $judulBaru,
            "penulis" => $penulisBaru,
            "kategori" => (int) ($_POST["kategori"] ?? 1),
            "tahun" => (int) ($_POST["tahun"] ?? 2026),
            "stok" => (int) ($_POST["stok"] ?? 0)
        ];

        $pesan = "Buku ditambahkan: " . htmlspecialchars($judulBaru, ENT_QUOTES, "UTF-8") . ".";
    }
}

// Pencarian memeriksa judul dan nama penulis.
$kataCari = $_GET["cari"] ?? "";
$hasil = cariBuku($buku, $kataCari);

// Nilai ini dipakai oleh header partial.
$jumlahHasil = count($hasil);

require __DIR__ . "/partials/header.php";
?>

<main class="konten">
    <section class="kartu-katalog">
        <h1><?= htmlspecialchars($judulHalaman, ENT_QUOTES, "UTF-8") ?></h1>

        <p class="ringkas">
            Menampilkan <?= $jumlahHasil ?> dari <?= count($buku) ?> judul.
            <br>
        </p>

        <?php if ($pesan !== ""): ?>
            <p class="<?= $kelasPesan ?>">
                <?= $pesan ?>
            </p>
        <?php endif; ?>

        <?php if (count($hasil) === 0): ?>
            <p class="pesan-kosong">
                Tidak ada buku yang cocok dengan kata kunci
                "<?= htmlspecialchars($kataCari, ENT_QUOTES, "UTF-8") ?>".
            </p>
        <?php else: ?>
            <div class="tabel-wrapper">
                <table class="tabel-data">
                    <caption>Koleksi <?= htmlspecialchars(NAMA_APLIKASI, ENT_QUOTES, "UTF-8") ?></caption>
                    <thead>
                        <tr>
                            <th scope="col">Judul</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($hasil as $b): ?>
                            <tr>
                                <td><?= htmlspecialchars($b["judul"], ENT_QUOTES, "UTF-8") ?></td>
                                <td><?= htmlspecialchars($b["penulis"], ENT_QUOTES, "UTF-8") ?></td>
                                <td><?= htmlspecialchars($kategori[$b["kategori"]] ?? "Lainnya", ENT_QUOTES, "UTF-8") ?></td>
                                <td>
                                    <?= $b["tahun"] ?>
                                    <span class="dekade">(<?= labelTahun((int) $b["tahun"]) ?>)</span>
                                </td>
                                <td><?= $b["stok"] ?> &middot; <?= labelStok((int) $b["stok"]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>

    <?php require __DIR__ . "/partials/sidebar.php"; ?>
</main>

<?php require __DIR__ . "/partials/footer.php"; ?>
