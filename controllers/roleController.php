<?php

require_once 'models/roleModel.php';

class RoleController
{
    protected $roleModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
    }

    public function listRoles()
    {
        $Roles = $this->roleModel->getAllRoles();
        include 'views/role/roleList.php';
        
    }

    public function addRole($roleNama, $roleDeskripsi, $roleStatus)
    {
        $this->roleModel->addRole($roleNama, $roleDeskripsi, $roleStatus);
        header('location: index.php?modul=null');
    }
    public function editById($role_id)
    {
        $objRoles = $this->roleModel->getRoleById($role_id);
        include 'views/role/roleUpdate.php';
    }

    public function updateRole($roleId, $roleNama, $roleDeskripsi, $roleStatus)
    {

        $updateResult = $this->roleModel->updateRole($roleId, $roleNama, $roleDeskripsi, $roleStatus);
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

    public function deleteRole($roleId)
    {
        $result = $this->roleModel->deleteRole($roleId);
        if (!$result) {
            throw new Exception('Failed to delete role.');
        } else {
            header('location: index.php?modul=role&fitur=list');
        }
    }

    public function getListRoleName()
    {
        $listRoleName = [];
        foreach ($this->roleModel->getAllRoles() as $role) {
            $listRoleName[] = $role->roleNama;
        }
        return $listRoleName;
    }

    public function getRoleByName($name)
    {
        return $this->roleModel->getRoleByName($name);
    }
}
