<?php
require_once 'Product.php';

$error = '';

// Memproses form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // Tambah dan edit produk
    if ($action === 'create' || $action === 'update') {
        $nama = trim($_POST['nama'] ?? '');
        $harga = $_POST['harga'] ?? '';
        $stok = $_POST['stok'] ?? '';

        if (
            $nama === '' ||
            !is_numeric($harga) ||
            (float) $harga < 0 ||
            filter_var($stok, FILTER_VALIDATE_INT) === false ||
            (int) $stok < 0
        ) {
            $error = 'Periksa kembali nama, harga, dan stok produk.';
        } else {
            $product = new Product();

            $product->setNama($nama)
                ->setHarga((float) $harga)
                ->setStok((int) $stok);

            if ($action === 'create') {
                $product->save();

                header('Location: index.php?status=created');
                exit;
            }

            if ($action === 'update') {
                $id = (int) ($_POST['id'] ?? 0);

                if ($id > 0 && Product::findById($id)) {
                    $product->update($id);

                    header('Location: index.php?status=updated');
                    exit;
                }

                $error = 'Produk tidak ditemukan.';
            }
        }
    }

    // Hapus produk
    if ($action === 'delete') {
        $id = (int) ($_POST['id'] ?? 0);

        if ($id > 0 && Product::findById($id)) {
            Product::delete($id);

            header('Location: index.php?status=deleted');
            exit;
        }

        $error = 'Produk tidak ditemukan.';
    }
}

// Pesan hasil operasi
$messages = [
    'created' => 'Produk berhasil ditambahkan.',
    'updated' => 'Produk berhasil diperbarui.',
    'deleted' => 'Produk berhasil dihapus.'
];

$status = $_GET['status'] ?? '';
$success = $messages[$status] ?? '';

// Mengambil data produk
$products = Product::findAll();

// Data produk untuk diedit
$editProduct = null;

if (isset($_GET['edit'])) {
    $editProduct = Product::findById((int) $_GET['edit']);

    if (!$editProduct) {
        $error = 'Produk tidak ditemukan.';
    }
}

// Mengamankan teks sebelum ditampilkan
function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Produk</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #1f2937;
            margin: 0;
            padding: 30px 16px;
        }

        .container {
            max-width: 1050px;
            margin: auto;
        }

        h1 {
            margin-bottom: 8px;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 25px;
        }

        .panel {
            background: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        label {
            display: block;
            margin: 15px 0 7px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
        }

        button,
        .btn {
            display: inline-block;
            border: none;
            border-radius: 6px;
            padding: 10px 14px;
            color: white;
            background: #2563eb;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        button:hover,
        .btn:hover {
            opacity: 0.85;
        }

        .submit {
            margin-top: 18px;
        }

        .secondary {
            background: #6b7280;
        }

        .danger {
            background: #dc2626;
        }

        .success-message {
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            border-radius: 6px;
            margin-bottom: 18px;
        }

        .error-message {
            padding: 12px;
            background: #fee2e2;
            color: #991b1b;
            border-radius: 6px;
            margin-bottom: 18px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            padding: 13px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #f9fafb;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .actions form {
            margin: 0;
        }

        @media (max-width: 600px) {
            body {
                padding: 16px 8px;
            }

            .panel {
                padding: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <h1>Sistem Manajemen Produk</h1>
        <p class="subtitle">
            Aplikasi pengelolaan data produk menggunakan PHP, PDO, dan MySQL.
        </p>

        <div class="panel">
            <h2>
                <?= $editProduct ? 'Edit Produk' : 'Tambah Produk' ?>
            </h2>

            <?php if ($success): ?>
                <div class="success-message">
                    <?= e($success) ?>
                </div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="error-message">
                    <?= e($error) ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <input
                    type="hidden"
                    name="action"
                    value="<?= $editProduct ? 'update' : 'create' ?>">

                <?php if ($editProduct): ?>
                    <input
                        type="hidden"
                        name="id"
                        value="<?= (int) $editProduct['id'] ?>">
                <?php endif; ?>

                <label for="nama">Nama Produk</label>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    maxlength="100"
                    placeholder="Masukkan nama produk"
                    value="<?= e($editProduct['nama'] ?? '') ?>"
                    required>

                <label for="harga">Harga Produk (Rp) (Satuan/Kg)</label>
                <input
                    type="number"
                    id="harga"
                    name="harga"
                    min="0"
                    step="0.01"
                    placeholder="Contoh: 25000"
                    value="<?= e($editProduct['harga'] ?? '') ?>"
                    required>

                <label for="stok">Stok Produk(Satuan/Kg)</label>
                <input
                    type="number"
                    id="stok"
                    name="stok"
                    min="0"
                    step="1"
                    placeholder="Masukkan jumlah stok"
                    value="<?= e($editProduct['stok'] ?? '0') ?>"
                    required>

                <button type="submit" class="submit">
                    <?= $editProduct ? 'Simpan Perubahan' : 'Tambah Produk' ?>
                </button>

                <?php if ($editProduct): ?>
                    <a href="index.php" class="btn secondary">
                        Batal
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <div class="panel">
            <h2>Daftar Produk</h2>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (count($products) > 0): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= (int) $product['id'] ?></td>
                                    <td><?= e($product['nama']) ?></td>
                                    <td>
                                        Rp <?= number_format(
                                                (float) $product['harga'],
                                                2,
                                                ',',
                                                '.'
                                            ) ?>
                                    </td>
                                    <td><?= (int) $product['stok'] ?></td>

                                    <td>
                                        <div class="actions">
                                            <a
                                                href="index.php?edit=<?= (int) $product['id'] ?>"
                                                class="btn">
                                                Edit
                                            </a>

                                            <form
                                                method="post"
                                                onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                <input
                                                    type="hidden"
                                                    name="action"
                                                    value="delete">

                                                <input
                                                    type="hidden"
                                                    name="id"
                                                    value="<?= (int) $product['id'] ?>">

                                                <button type="submit" class="danger">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">
                                    Belum ada produk. Silakan tambahkan produk.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>

</html>