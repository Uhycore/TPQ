<?php
require_once 'config/userNode.php';
require_once 'roleModel.php';

class UserModel
{
    private $users = [];
    private $nextId = 1;
    private $roleModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();

        if (isset($_SESSION['users'])) {
            $this->users = unserialize($_SESSION['users']);
            $this->nextId = $this->getMaxRoleId() + 1;
        } else {
            $this->initializeDefaultUser();
        }
    }

    public function initializeDefaultUser()
    {
        $this->addUser('Staf It', '1', 1);
        $this->addUser('Staf Pengajar', '1', 2);
        $this->addUser('Aril', '1', 3);
        $this->addUser('Aril Mubin', '1', 3);
        $this->addUser('Mubin', '1', 3);
        $this->addUser('Asyraril', '1', 3);
        $this->addUser('Staf Keuangan', '1', 4);
    }

    public function addUser($username, $password, $roleId)
    {
        $role = $this->roleModel->getRoleById($roleId);
        if (!$role) {
            throw new Exception("Role tidak ditemukan.");
        }

        $user = new User($this->nextId++, $username, $password, $role);
        $this->users[] = $user;
        $this->saveToSession();
    }

    private function saveToSession()
    {
        $_SESSION['users'] = serialize($this->users);
    }

    public function getAllUsers()
    {
        return $this->users;
    }
    public function getUserById($userId)
    {
        foreach ($this->users as $user) {
            if ($user->userId == $userId) {
                return $user;
            }
        }
        return null;
    }

    public function getUserByName($username)
    {
        foreach ($this->users as $user) {
            if ($user->username == $username) {
                return $user;
            }
        }
        return null;
    }



    public function updateUser($userId, $username, $password, $role)
    {
        foreach ($this->users as $user) {
            if ($user->userId == $userId) {
                $user->username = $username;
                $user->password = $password;

                $role = $this->roleModel->getRoleByName($role);

                $user->role = $role;


                $this->saveToSession();
                return true;
            }
        }
        return false;
    }


    public function deleteUser($userId)
    {
        foreach ($this->users as $key => $user) {
            if ($user->userId == $userId) {
                unset($this->users[$key]);
                $this->users = array_values($this->users); // Reindex array
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }
    private function getMaxRoleId()
    {
        $maxId = 0;
        foreach ($this->users as $user) {
            if ($user->userId > $maxId) {
                $maxId = $user->userId;
            }
        }
        return $maxId;
    }
}
