<?php

require_once 'models/roleModel.php';

class RoleController
{
    protected $adminController;

    public function __construct()
    {
        $this->adminController = new RoleModel();
    }

    public function listRoles()
    {
        $Roles = $this->adminController->getAllRoles();
        include 'views/role/roleList.php';
    }

    public function addRole()
    {
        $roleNama = $_POST['roleNama'];
        $roleDeskripsi = $_POST['roleDeskripsi'];
        $roleStatus = $_POST['roleStatus'];


        $this->adminController->addRole($roleNama, $roleDeskripsi, $roleStatus);
        header('location: index.php?modul=role&&fitur=list');
    }
    public function editById()
    {
        $roleId = $_GET['roleId'];
        $objRoles = $this->adminController->getRoleById($roleId);
        include 'views/role/roleUpdate.php';
    }

    public function updateRole()
    {
        $roleId = $_POST['roleId'];
        $roleNama = $_POST['roleNama'];
        $roleDeskripsi = $_POST['roleDeskripsi'];
        $roleStatus = $_POST['roleStatus'];

        $updateResult = $this->adminController->updateRole($roleId, $roleNama, $roleDeskripsi, $roleStatus);
        if ($updateResult) {
            echo "<script>
                        alert('Data role berhasil diperbarui!');
                        window.location.href = 'index.php?modul=role&fitur=list'; 
                      </script>";
        } else {
            echo "<script>
                        alert('Gagal memperbarui data role. Silakan coba lagi.');
                        window.location.href = 'index.php?modul=role&fitur=edit&roleId={$roleId}'; 
                      </script>";
        }
        exit;
    }

    public function deleteRole()
    {
        $roleId = $_POST['roleId'];
        $result = $this->adminController->deleteRole($roleId);
        if (!$result) {
            throw new Exception('Failed to delete role.');
        } else {
            header('location: index.php?modul=role&fitur=list');
        }
    }

    // public function getListRoleName()
    // {
    //     $listRoleName = [];
    //     foreach ($this->adminController->getAllRoles() as $role) {
    //         $listRoleName[] = $role->roleNama;
    //     }
    //     return $listRoleName;
    // }

    // public function getRoleByName($name)
    // {
    //     return $this->adminController->getRoleByName($name);
    // }
}
