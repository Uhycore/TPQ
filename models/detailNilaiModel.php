<?php
require_once 'config/detailNilaiNode.php';
require_once 'mapelModel.php';

class DetailNilaiModel
{
    public $DetailNilai = [];
    private $nextId = 1;
    public $mapelModel;

    public function __construct()
    {
        $this->mapelModel = new MapelModel();

        if (isset($_SESSION['DetailNilai'])) {
            $this->DetailNilai = unserialize($_SESSION['DetailNilai']);
            $this->nextId = $this->getMaxDetailNilaiId() + 1;
        }
    }

    public function addDetailNilai($mapelId, $nilai)
    {
        $mapel = $this->mapelModel->getMapelById($mapelId);
        if ($mapel) {
            $detail = new DetailNilaiNode($this->nextId++, $mapel, $nilai);
            $this->DetailNilai[] = $detail;
            $this->saveToSession();
        }
    }

    private function saveToSession()
    {
        $_SESSION['DetailNilai'] = serialize($this->DetailNilai);
    }


    public function getMaxDetailNilaiId()
    {
        $maxId = 0;
        foreach ($this->DetailNilai as $detailNilai) {
            if ($detailNilai->detailNilaiId > $maxId) {
                $maxId = $detailNilai->detailNilaiId;
            }
        }
        return $maxId;
    }

    public function getAllDetailNilai()
    {
        return $this->DetailNilai;
    }

    public function getDetailNilaiById($detailNilaiId)
    {
        foreach ($this->DetailNilai as $detailNilai) {
            if ($detailNilai->detailNilaiId == $detailNilaiId) {
                return $detailNilai;
            }
        }
        return null;
    }
}
