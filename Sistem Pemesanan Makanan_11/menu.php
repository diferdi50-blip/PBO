<?php
declare(strict_types=1);

class Menu
{
    private string $kodeMenu;
    private string $namaMenu;
    private float $harga;
    private int $stok;

    public function __construct(
        string $kodeMenu,
        string $namaMenu,
        float $harga,
        int $stok
    ) {
        if ($harga < 0 || $stok < 0) {
            throw new InvalidArgumentException(
                'Harga dan stok tidak boleh negatif.'
            );
        }

        $this->kodeMenu = $kodeMenu;
        $this->namaMenu = $namaMenu;
        $this->harga = $harga;
        $this->stok = $stok;
    }

    public function getInfoMenu(): string
    {
        return $this->namaMenu
            . ' - Rp' . number_format($this->harga, 0, ',', '.')
            . ' (Stok: ' . $this->stok . ')';
    }

    public function cekKetersediaan(int $jumlah): bool
    {
        return $jumlah > 0 && $jumlah <= $this->stok;
    }

    public function kurangiStok(int $jumlah): void
    {
        if ($jumlah <= 0) {
            throw new InvalidArgumentException(
                'Jumlah pesanan harus lebih dari nol.'
            );
        }

        if ($jumlah > $this->stok) {
            throw new RuntimeException(
                'Stok menu ' . $this->namaMenu . ' tidak mencukupi.'
            );
        }

        $this->stok -= $jumlah;
    }

    public function getKodeMenu(): string
    {
        return $this->kodeMenu;
    }

    public function getNamaMenu(): string
    {
        return $this->namaMenu;
    }

    public function getHarga(): float
    {
        return $this->harga;
    }

    public function getStok(): int
    {
        return $this->stok;
    }
}