<?php
require_once 'config/detailKeuanganNode.php';

class DetailKeuanganModel
{
    public $DetailKeuangan = [];
    private $nextId = 1;

    public function __construct()
    {
        // Memuat data dari file JSON jika ada
        $this->loadFromJson();
    }

    public function addDetailKeuangan($tanggal, $nominal)
    {
        // Menambahkan detail keuangan
        $detail = new DetailKeuanganNode($this->nextId++, $tanggal, $nominal);
        $this->DetailKeuangan[] = $detail;

        // Simpan data ke file JSON
        $this->saveToJson();
    }

    private function saveToJson()
    {
        // Menyimpan data DetailKeuangan ke file JSON
        $jsonData = json_encode($this->DetailKeuangan, JSON_PRETTY_PRINT);
        file_put_contents('data/detailKeuanganData.json', $jsonData);
    }

    private function loadFromJson()
    {
        $filePath = 'data/detailKeuanganData.json';

        // Memeriksa apakah file ada dan memuat data jika ada
        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $dataArray = json_decode($jsonData, true);

            if ($dataArray) {
                // Mengonversi data JSON menjadi objek DetailKeuanganNode
                foreach ($dataArray as $data) {
                    $detailKeuangan = new DetailKeuanganNode($data['detailKeuanganId'], $data['tanggal'], $data['nominal']);
                    $this->DetailKeuangan[] = $detailKeuangan;
                }
                // Mengatur ID berikutnya berdasarkan ID terbesar yang ada
                $this->nextId = $this->getMaxDetailKeuanganId() + 1;
            }
        }
    }

    public function getMaxDetailKeuanganId()
    {
        $maxId = 0;
        foreach ($this->DetailKeuangan as $detailKeuangan) {
            if ($detailKeuangan->detailKeuanganId > $maxId) {
                $maxId = $detailKeuangan->detailKeuanganId;
            }
        }
        return $maxId;
    }

    public function getAllDetailKeuangan()
    {
        return $this->DetailKeuangan;
    }

    public function getDetailKeuanganById($detailKeuanganId)
    {
        foreach ($this->DetailKeuangan as $detailKeuangan) {
            if ($detailKeuangan->detailKeuanganId == $detailKeuanganId) {
                return $detailKeuangan;
            }
        }
        return null;
    }
}
