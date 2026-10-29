<?php

declare(strict_types=1);

class Pelanggan
{
    private string $idPelanggan;
    private string $nama;
    private string $noTelepon;
    private string $alamat;

    public function __construct(
        string $idPelanggan,
        string $nama,
        string $noTelepon,
        string $alamat
    ) {
        $this->idPelanggan = $idPelanggan;
        $this->nama = $nama;
        $this->noTelepon = $noTelepon;
        $this->alamat = $alamat;
    }

    public function buatPesanan(): Pesanan
    {
        $nomor = 'PSN-' . date('YmdHis') . '-' . random_int(100, 999);
        return new Pesanan($nomor, $this);
    }

    public function getInfoPelanggan(): string
    {
        return $this->nama . ' (' . $this->idPelanggan . ')';
    }

    public function getIdPelanggan(): string
    {
        return $this->idPelanggan;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function getNoTelepon(): string
    {
        return $this->noTelepon;
    }

    public function getAlamat(): string
    {
        return $this->alamat;
    }
}
