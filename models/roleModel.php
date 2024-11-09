<?php
require_once 'config/roleNode.php';

class RoleModel
{
    private $roles = [];
    private $nextId = 1;


    public function __construct()
    {
        if (isset($_SESSION['roles'])) {
            $this->roles = unserialize($_SESSION['roles']);


            $this->nextId = $this->getMaxRoleId() + 1;
        } else {

            $this->initializeDefaultRole();
        }
    }

    public function initializeDefaultRole()
    {
        $this->addRole("Admin", "Sebagai pengatur semuanya", 1);
        $this->addRole("Uztad/Uztadzah", "bagian menginputkan data", 1);
        $this->addRole("User", "Santri/Orang tua santri yang memiliki akun", 1);
        $this->addRole("Bendahara", "menginputkan data keuangan", 1);
    }

    public function addRole($roleNama, $roleDeskripsi, $roleStatus)
    {
        $role = new role($this->nextId++, $roleNama, $roleDeskripsi, $roleStatus);
        $this->roles[] = $role;
        $this->saveToSession();
    }

    private function saveToSession()
    {
        $_SESSION['roles'] = serialize($this->roles);
    }

    public function getAllRoles()
    {
        return $this->roles;
    }

    public function getRoleById($roleId)
    {
        foreach ($this->roles as $role) {
            if ($role->roleId == $roleId) {
                return $role;
            }
        }
        return null;
    }

    public function updateRole($roleId, $roleNama, $roleDeskripsi, $roleStatus)
    {
        foreach ($this->roles as $role) {
            if ($role->roleId == $roleId) {

                $role->roleNama = $roleNama;
                $role->roleDeskripsi = $roleDeskripsi;
                $role->roleStatus = $roleStatus;
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }

    public function deleteRole($roleId)
    {
        foreach ($this->roles as $key => $role) {
            if ($role->roleId == $roleId) {
                unset($this->roles[$key]);
                $this->roles = array_values($this->roles); // Reindex array
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }

    public function getRoleByName($roleNama)
    {
        foreach ($this->roles as $role) {
            if ($role->roleNama == $roleNama) {
                return $role;
            }
        }
        return null;
    }

    private function getMaxRoleId()
    {
        $maxId = 0;
        foreach ($this->roles as $role) {
            if ($role->roleId > $maxId) {
                $maxId = $role->roleId;
            }
        }
        return $maxId;
    }
}
