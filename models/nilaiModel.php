<?php
require_once 'config/detailNilaiNode.php';
require_once 'config/nilaiNode.php';
require_once 'santriModel.php';

class NilaiModel
{
    private $nilaiNodes = [];
    private $nextId = 1;

    public function __construct()
    {
        if (isset($_SESSION['nilai'])) {
            $this->nilaiNodes = unserialize($_SESSION['nilai']);
            $this->nextId = $this->getMaxNilaiId() + 1;
        } else {
            $this->loadFromJson();
        }
    }

    public function addNilai($santri, $detailNilaiData)
    {
        $dataSantri = new SantriModel();
        $santri = $dataSantri->getSantriById($santri);
        $nilaiNode = new NilaiNode($this->nextId++, $santri);

        foreach ($detailNilaiData as $detail) {
            $detailNilai = new DetailNilaiNode($detail->detailNilaiId, $detail->mapel, $detail->nilai);
            $nilaiNode->detailNilai[] = $detailNilai;
        }

        $this->nilaiNodes[] = $nilaiNode;
        $this->saveToSession();
        $this->saveToJson();
    }

    private function saveToJson()
    {
        $jsonData = json_encode($this->nilaiNodes, JSON_PRETTY_PRINT);
        file_put_contents('data/nilaiData.json', $jsonData);
    }
    private function loadFromJson()
    {
        $filePath = 'data/nilaiData.json';
        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $dataArray = json_decode($jsonData, true);

            if ($dataArray) {
                $dataSantri = new SantriModel(); 

                foreach ($dataArray as $data) {
                    $santri = $dataSantri->getSantriById($data['santri']['santriId']);
                    $nilaiNode = new NilaiNode($data['nilaiId'], $santri);

                    foreach ($data['detailNilai'] as $detail) {
                        $mapelObj = new Mapel(
                            $detail['mapel']['mapelId'],
                            $detail['mapel']['mapelNama'],
                            $detail['mapel']['mapelDeskripsi']
                        );
                        $detailNilai = new DetailNilaiNode($detail['detailNilaiId'], $mapelObj, $detail['nilai']);
                        $nilaiNode->detailNilai[] = $detailNilai;
                    }

                    $this->nilaiNodes[] = $nilaiNode;
                }
                $this->nextId = $this->getMaxNilaiId() + 1;
            }
        }
    }



    private function saveToSession()
    {
        $_SESSION['nilai'] = serialize($this->nilaiNodes);
    }

    public function getAllNilai()
    {
        return $this->nilaiNodes;
    }

    public function getNilaiById($nilaiId)
    {
        foreach ($this->nilaiNodes as $nilaiNode) {
            if ($nilaiNode->nilaiId == $nilaiId) {
                return $nilaiNode;
            }
        }
        return null;
    }

    private function getMaxNilaiId()
    {
        $maxId = 0;
        foreach ($this->nilaiNodes as $nilaiNode) {
            if ($nilaiNode->nilaiId > $maxId) {
                $maxId = $nilaiNode->nilaiId;
            }
        }
        return $maxId;
    }
}
