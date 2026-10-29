<?php
class PerpustakaanService
{
    private PDO $koneksi;
    public function __construct()
    {
        $this->koneksi = new PDO('mysql:host=localhost;dbname=perpus', 'root', '');
    }
    public function prosesPeminjaman(int $idBuku, int $idAnggota, string $tipe): void
    {
        // 1. Ambil data buku langsung di sini 
        $stmt = $this->koneksi->query("SELECT * FROM buku WHERE id = $idBuku");
        $buku = $stmt->fetch();
        // 2. Hitung lama pinjam & denda berdasarkan tipe anggota 
        if ($tipe === 'mahasiswa') {
            $lamaPinjam = 7;
            $tarifDenda = 1000;
        } elseif ($tipe === 'dosen') {
            $lamaPinjam = 14;
            $tarifDenda = 500;
        } elseif ($tipe === 'umum') {
            $lamaPinjam = 3;
            $tarifDenda = 2000;
        } else {
            throw new Exception("Tipe anggota tidak dikenal");
        }
        // 3. Simpan peminjaman 
        $this->koneksi->exec(
            "INSERT INTO peminjaman (id_buku, id_anggota, tgl_pinjam, 
tgl_kembali) 
VALUES ($idBuku, $idAnggota, NOW(), DATE_ADD(NOW(), INTERVAL $lamaPinjam DAY))"
        );
        // 4. Kirim email konfirmasi 
        $email = $this->koneksi->query("SELECT email FROM anggota WHERE id = $idAnggota")->fetchColumn();
        mail($email, 'Konfirmasi Peminjaman', 'Buku berhasil dipinjam');
        // 5. Cetak struk ke layar 
        echo "=== STRUK PEMINJAMAN ===\n";
        echo "Judul: {$buku['judul']}\n";
        echo "Lama pinjam: $lamaPinjam hari\n";
        echo "Tarif denda: Rp $tarifDenda / hari\n";
    }
}
interface BukuOperations
{
    public function tambahBuku(array $data): void;
    public function hapusBuku(int $id): void;
    public function pinjamBuku(int $id): void;
    public function kembalikanBuku(int $id): void;
    public function cetakLaporan(): void;
    public function kirimNotifikasi(string $pesan): void;
    public function backupDatabase(): void;
}
class Buku
{
    public function hitungDenda(int $hariTerlambat): int
    {
        return $hariTerlambat * 1000;
    }
}
class BukuReferensi extends Buku
{
    public function hitungDenda(int $hariTerlambat): int
    {
        // Buku referensi tidak boleh dipinjam - melanggar LSP 
        throw new Exception("Buku referensi tidak bisa dipinjam");
    }
}
