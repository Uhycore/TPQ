<?php
require_once 'config/userNode.php';
require_once 'roleModel.php';

class UserModel
{
    private $users = [];
    private $nextId = 1;
    private $roleModel;
    private $jsonFilePath = 'data/users.json'; 

    public function __construct()
    {
        $this->roleModel = new RoleModel();

        if (file_exists($this->jsonFilePath)) {
            $this->loadFromJsonFile();
            $this->nextId = $this->getMaxUserId() + 1;
        } elseif (isset($_SESSION['users'])) {
            $this->users = unserialize($_SESSION['users']);
            $this->nextId = $this->getMaxUserId() + 1;
        } else {
            $this->initializeDefaultUser();
            $this->saveToJsonFile(); 
        }
    }

    public function initializeDefaultUser()
    {
        $this->addUser('Staf It', '1', 1);
        $this->addUser('Staf Pengajar', '1', 2);
        $this->addUser('Santri', '1', 3);
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
        $this->saveToJsonFile();
    }

    private function saveToSession()
    {
        $_SESSION['users'] = serialize($this->users);
    }

    private function saveToJsonFile()
    {
        $userData = array_map(function ($user) {
            return [
                'userId' => $user->userId,
                'username' => $user->username,
                'password' => $user->password,
                'role' => $user->role,
            ];
        }, $this->users);

        file_put_contents($this->jsonFilePath, json_encode($userData, JSON_PRETTY_PRINT));
    }

    private function loadFromJsonFile()
    {
        $userData = json_decode(file_get_contents($this->jsonFilePath), true);
        if (is_array($userData)) {
            foreach ($userData as $data) {
                $role = $this->roleModel->getRoleById($data['role']['roleId']);
                $user = new User($data['userId'],  $data['username'], $data['password'], $role);
                $this->users[] = $user;
            }
        }
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

    public function updateUser($userId, $username, $password, $roleId)
    {
        foreach ($this->users as $user) {
            if ($user->userId == $userId) {
                $user->username = $username;
                $user->password = $password;

                $role = $this->roleModel->getRoleById($roleId);
                $user->role = $role;

                $this->saveToSession();
                $this->saveToJsonFile();
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
                $this->users = array_values($this->users); 
                $this->saveToSession();
                $this->saveToJsonFile();
                return true;
            }
        }
        return false;
    }

    public function getMaxUserId()
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
