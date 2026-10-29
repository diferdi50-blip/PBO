<?php
declare(strict_types=1);

class DetailPesanan
{
    private Menu $menu;
    private int $jumlah;
    private float $hargaSaatDipesan;

    public function __construct(Menu $menu, int $jumlah)
    {
        if ($jumlah <= 0) {
            throw new InvalidArgumentException(
                'Jumlah menu harus minimal satu.'
            );
        }

        $this->menu = $menu;
        $this->jumlah = $jumlah;

        // Simpan harga saat transaksi dibuat.
        $this->hargaSaatDipesan = $menu->getHarga();
    }

    public function hitungSubtotal(): float
    {
        return $this->jumlah * $this->hargaSaatDipesan;
    }

    public function getMenu(): Menu
    {
        return $this->menu;
    }

    public function getJumlah(): int
    {
        return $this->jumlah;
    }

    public function getHargaSaatDipesan(): float
    {
        return $this->hargaSaatDipesan;
    }
}