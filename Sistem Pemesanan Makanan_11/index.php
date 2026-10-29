<?php

declare(strict_types=1);

require_once __DIR__ . '/menu.php';
require_once __DIR__ . '/detailpesanan.php';
require_once __DIR__ . '/pesanan.php';
require_once __DIR__ . '/pelanggan.php';

// Data contoh untuk simulasi.
$pelanggan = new Pelanggan(
    'PLG001',
    'Andi',
    '081234567890',
    'Pontianak'
);

$nasiGoreng = new Menu(
    'M001',
    'Nasi Goreng',
    20000,
    10
);

$esTeh = new Menu(
    'M002',
    'Es Teh',
    5000,
    20
);

// Membuat pesanan dan menambahkan menu.
$pesanan = $pelanggan->buatPesanan();
$pesanan->tambahDetail($nasiGoreng, 2);
$pesanan->tambahDetail($esTeh, 1);
$pesanan->updateStatus('Diproses');

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function rupiah(float $angka): string
{
    return 'Rp' . number_format($angka, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Simulasi Sistem Pemesanan Makanan</title>

    <style>
        :root {
            --hijau: #087f6e;
            --latar: #f3f8f7;
            --teks: #203330;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: var(--teks);
            background: var(--latar);
        }

        header {
            background: var(--hijau);
            color: white;
            padding: 26px 20px;
        }

        header h1,
        header p {
            max-width: 900px;
            margin: 0 auto 6px;
        }

        main {
            max-width: 900px;
            margin: 28px auto;
            padding: 0 16px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 18px;
            box-shadow: 0 3px 12px #153d3610;
        }

        h2 {
            margin-top: 0;
            font-size: 19px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit,
                    minmax(220px, 1fr));
            gap: 12px;
        }

        .muted {
            color: #667772;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 11px 8px;
            border-bottom: 1px solid #e3ece9;
            text-align: left;
        }

        th {
            color: #50635e;
            font-size: 13px;
        }

        .right {
            text-align: right;
        }

        .total {
            font-weight: bold;
            font-size: 20px;
            color: var(--hijau);
        }

        .status {
            display: inline-block;
            border-radius: 20px;
            padding: 6px 10px;
            background: #d9f5e8;
            color: #176b4c;
            font-size: 13px;
        }

        @media (max-width: 560px) {
            table {
                font-size: 13px;
            }

            th,
            td {
                padding: 9px 4px;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Sistem Pemesanan Makanan</h1>
        <p>Simulasi implementasi UML Class Diagram Ferdi H1101251029</p>
    </header>

    <main>
        <section class="card">
            <h2>Informasi Pelanggan</h2>

            <div class="grid">
                <div>
                    <div class="muted">ID Pelanggan</div>
                    <strong><?= e($pelanggan->getIdPelanggan()) ?></strong>
                </div>

                <div>
                    <div class="muted">Nama</div>
                    <strong><?= e($pelanggan->getNama()) ?></strong>
                </div>

                <div>
                    <div class="muted">Nomor Telepon</div>
                    <strong><?= e($pelanggan->getNoTelepon()) ?></strong>
                </div>

                <div>
                    <div class="muted">Alamat</div>
                    <strong><?= e($pelanggan->getAlamat()) ?></strong>
                </div>
            </div>
        </section>

        <section class="card">
            <h2>Informasi Pesanan</h2>

            <div class="grid">
                <div>
                    <div class="muted">Nomor Pesanan</div>
                    <strong><?= e($pesanan->getNoPesanan()) ?></strong>
                </div>

                <div>
                    <div class="muted">Tanggal Pemesanan</div>
                    <strong>
                        <?= e(
                            $pesanan->getTanggalPemesanan()
                                ->format('d-m-Y H:i:s')
                        ) ?>
                    </strong>
                </div>

                <div>
                    <div class="muted">Status</div>
                    <span class="status">
                        <?= e($pesanan->getStatusPesanan()) ?>
                    </span>
                </div>
            </div>
        </section>

        <section class="card">
            <h2>Detail Menu yang Dipesan</h2>

            <table>
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th class="right">Harga</th>
                        <th class="right">Jumlah</th>
                        <th class="right">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach (
                        $pesanan->getDetailPesanan() as $detail
                    ): ?>
                        <tr>
                            <td>
                                <?= e($detail->getMenu()->getNamaMenu()) ?>
                            </td>

                            <td class="right">
                                <?= rupiah($detail->getHargaSaatDipesan()) ?>
                            </td>

                            <td class="right">
                                <?= $detail->getJumlah() ?>
                            </td>

                            <td class="right">
                                <?= rupiah($detail->hitungSubtotal()) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="3" class="right">
                            Total Pesanan
                        </td>

                        <td class="right total">
                            <?= rupiah($pesanan->hitungTotal()) ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>

        <section class="card">
            <h2>Sisa Stok Menu</h2>

            <div class="grid">
                <div>
                    <?= e($nasiGoreng->getNamaMenu()) ?><br>
                    <strong><?= $nasiGoreng->getStok() ?> porsi</strong>
                </div>

                <div>
                    <?= e($esTeh->getNamaMenu()) ?><br>
                    <strong><?= $esTeh->getStok() ?> gelas</strong>
                </div>
            </div>

        </section>
    </main>
</body>

</html>