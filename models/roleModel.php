<?php
require_once 'config/roleNode.php';

class RoleModel
{
    private $roles = [];
    private $nextId = 1;
    private $jsonFilePath = 'data/roles.json';

    public function __construct()
    {
        if (file_exists($this->jsonFilePath)) {
            $this->loadFromJsonFile();
            $this->nextId = $this->getMaxRoleId() + 1;
        } else {
            $this->initializeDefaultRole();
            $this->saveToJsonFile();
        }
    }

    public function initializeDefaultRole()
    {
        $this->addRole("Admin", "Sebagai pengatur semuanya", 1);
        $this->addRole("Uztad/Uztadzah", "Bagian menginputkan data", 1);
        $this->addRole("Santri", "Santri/Orang tua santri yang memiliki akun", 1);
        $this->addRole("Bendahara", "Menginputkan data keuangan", 1);
    }

    public function addRole($roleNama, $roleDeskripsi, $roleStatus)
    {
        $role = new Role($this->nextId++, $roleNama, $roleDeskripsi, $roleStatus);
        $this->roles[] = $role;
        $this->saveToJsonFile();
    }

    private function saveToJsonFile()
    {
        $rolesArray = array_map(function ($role) {
            return [
                'roleId' => $role->roleId,
                'roleNama' => $role->roleNama,
                'roleDeskripsi' => $role->roleDeskripsi,
                'roleStatus' => $role->roleStatus
            ];
        }, $this->roles);

        file_put_contents($this->jsonFilePath, json_encode($rolesArray, JSON_PRETTY_PRINT));
    }

    private function loadFromJsonFile()
    {
        $data = json_decode(file_get_contents($this->jsonFilePath), true);
        if ($data) {
            $this->roles = array_map(function ($item) {
                return new Role($item['roleId'], $item['roleNama'], $item['roleDeskripsi'], $item['roleStatus']);
            }, $data);
        }
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
                $this->saveToJsonFile();
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
                $this->roles = array_values($this->roles);
                $this->saveToJsonFile();
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
