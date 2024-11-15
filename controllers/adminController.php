<?php

require_once 'models/adminModel.php';

class AdminController
{
    protected $adminController;

    public function __construct()
    {
        $this->adminController = new AdminModel();
    }

    public function listAdmins()
    {
        $admins = $this->adminController->getAllAdmins();
        include 'views/admin/adminList.php';
    }

    public function addAdmins()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $jenisKelamin =  $_POST['jenisKelamin'];
        $alamat = $_POST['alamat'];
        $noTelp = $_POST['noTelp'];


        $this->adminController->addAdmin($username, $password, 1, $jenisKelamin, $alamat, $noTelp);
        header("Location: index.php?modul=admin&fitur=list");
    }
    public function editById()
    {
        $adminId = $_GET['adminId'];
        $objAdmin = $this->adminController->getAdminById($adminId);
        include 'views/admin/adminUpdate.php';
    }

    public function updateAdmins()
    {
        $adminId = $_POST['adminId'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $jenisKelamin =  $_POST['jenisKelamin'];
        $alamat = $_POST['alamat'];
        $noTelp = $_POST['noTelp'];

        $updateResult = $this->adminController->updateAdmin($adminId, $username, $password, $jenisKelamin, $alamat, $noTelp);
        if ($updateResult) {
            echo "<script>
                        alert('Data role berhasil diperbarui!');
                        window.location.href = 'index.php?modul=admin&fitur=list'; 
                      </script>";
        } else {
            echo "<script>
                        alert('Gagal memperbarui data role. Silakan coba lagi.');
                        window.location.href = 'index.php?modul=admin&fitur=edit&adminId={$adminId}'; 
                      </script>";
        }
        exit;
    }

    public function deleteAdmins()
    {
        $adminId = $_POST['adminId'];
        $deleteResult = $this->adminController->deleteAdmin($adminId);


        if (!$deleteResult) {
            throw new Exception('Failed to delete role.');
        } else {
            header('location: index.php?modul=admin&fitur=list');
        }



        header('location: index.php?modul=admin&fitur=list');

        exit;
    }
}
