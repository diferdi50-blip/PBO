<?php

declare(strict_types=1);

class Pesanan
{
    private string $noPesanan;
    private DateTimeImmutable $tanggalPemesanan;
    private string $statusPesanan;
    private Pelanggan $pelanggan;

    /** @var DetailPesanan[] */
    private array $detailPesanan = [];

    public function __construct(
        string $noPesanan,
        Pelanggan $pelanggan
    ) {
        $this->noPesanan = $noPesanan;
        $this->tanggalPemesanan = new DateTimeImmutable();
        $this->statusPesanan = 'Dibuat';
        $this->pelanggan = $pelanggan;
    }

    public function tambahDetail(Menu $menu, int $jumlah): void
    {
        if (!$menu->cekKetersediaan($jumlah)) {
            throw new RuntimeException(
                'Jumlah pesanan tidak valid atau stok tidak mencukupi: '
                    . $menu->getNamaMenu()
            );
        }

        $detail = new DetailPesanan($menu, $jumlah);

        $menu->kurangiStok($jumlah);
        $this->detailPesanan[] = $detail;
    }

    public function updateStatus(string $statusBaru): void
    {
        $statusValid = [
            'Dibuat',
            'Diproses',
            'Selesai',
            'Dibatalkan'
        ];

        if (!in_array($statusBaru, $statusValid, true)) {
            throw new InvalidArgumentException(
                'Status tidak valid. Pilihan: '
                    . implode(', ', $statusValid)
            );
        }

        $this->statusPesanan = $statusBaru;
    }

    public function hitungTotal(): float
    {
        $total = 0.0;

        foreach ($this->detailPesanan as $detail) {
            $total += $detail->hitungSubtotal();
        }

        return $total;
    }

    public function getNoPesanan(): string
    {
        return $this->noPesanan;
    }

    public function getTanggalPemesanan(): DateTimeImmutable
    {
        return $this->tanggalPemesanan;
    }

    public function getStatusPesanan(): string
    {
        return $this->statusPesanan;
    }

    public function getPelanggan(): Pelanggan
    {
        return $this->pelanggan;
    }

    /** @return DetailPesanan[] */
    public function getDetailPesanan(): array
    {
        return $this->detailPesanan;
    }
}
