<?php

require_once 'models/mapelModel.php';

class MapelController
{
    protected $mapelModel;

    public function __construct()
    {
        $this->mapelModel = new MapelModel();
    }

    public function listMapel()
    {
        $Mapels = $this->mapelModel->getAllmapels();
        include 'views/items/mapelList.php';
        
    }

    public function addMapel($mapelNama, $mapelDeskripsi)
    {
        $this->mapelModel->addMapel($mapelNama, $mapelDeskripsi);
        header('location: index.php?modul=mapel&fitur=list');
    }
    public function editById($mapelId)
    {
        $objMapels = $this->mapelModel->getMapelById($mapelId);
        include 'views/items/mapelUpdate.php';
    }

    public function updateMapel($mapelId, $mapelNama, $mapelDeskripsi)
    {

        $updateResult = $this->mapelModel->updateMapel($mapelId, $mapelNama, $mapelDeskripsi);
        if ($updateResult) {
            echo "<script>
                        alert('Data role berhasil diperbarui!');
                        window.location.href = 'index.php?modul=mapel&fitur=list'; 
                      </script>";
        } else {
            echo "<script>
                        alert('Gagal memperbarui data role. Silakan coba lagi.');
                        window.location.href = 'index.php?modul=mapel&fitur=edit&mapelId={$mapelId}'; 
                      </script>";
        }
        exit;
    }

    public function deleteMapel($mapelId)
    {
        $result = $this->mapelModel->deleteMapel($mapelId);
        if (!$result) {
            throw new Exception('Failed to delete role.');
        } else {
            header('location: index.php?modul=mapel&fitur=list');
        }
    }

    public function getListMapelNama()
    {
        $listRoleName = [];
        foreach ($this->mapelModel->getAllmapels() as $role) {
            $listRoleName[] = $role->mapelNama;
        }
        return $listRoleName;
    }

    public function getMapelByNama($mapelNama)
    {
        return $this->mapelModel->getMapelByNama($mapelNama);
    }
}
