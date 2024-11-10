<?php
require_once 'models/santriModel.php';
require_once 'models/roleModel.php';


class SantriController
{
    private $santriModel;
    private $roleModel;



    public function __construct()
    {
        $this->santriModel = new SantriModel();
        $this->roleModel = new RoleModel();
    }

    public function listSantri()
    {
        $santris = $this->santriModel->getAllSantris();

        include 'views/santri/santriList.php';
    }

    public function addSantri($username, $password, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu)
    {
        $this->santriModel->addSantri($username, $password, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu);
        header('location: index.php?modul=null');
    }

    public function editById($santriId)
    {
        $objSantri = $this->santriModel->getSantriById($santriId);
        include 'views/santri/santriUpdate.php';
    }

    public function updateSantri($username, $password, $santriId, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu)
    {

        $this->santriModel->updateSantri($username, $password, $santriId, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu);
        header('location: index.php?modul=santri&fitur=list');
    }

    public function deleteSantri($santriId)
    {
        $this->santriModel->deleteSantri($santriId);
        header('location: index.php?modul=santri&fitur=list');
    }
}
