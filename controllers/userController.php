<?php
require_once 'models/userModel.php';
require_once 'models/roleModel.php';

class UserController
{
    private $userModel;
    private $roleModel;


    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
    }

    public function listUsers()
    {
        $users = $this->userModel->getAllUsers();
        $listRoleName = $this->roleModel->getAllRoles();

        include 'views/user/userList.php';
    }
    public function inputUsers()
    {
        $Roles = $this->roleModel->getAllRoles();
        include 'views/user/userInput.php';
    }

    public function addUser($username, $password, $role)
    {
        $this->userModel->addUser($username, $password, $role);
        header('location: index.php?modul=null');
    }
    public function editById($userId)
    {
        $objUsers = $this->userModel->getUserById($userId);
        $listRoleName = $this->roleModel->getAllRoles();
        include 'views/user/userUpdate.php';
    }

    public function updateUser($userId, $username, $password, $roleId)
    {

        $updateResult = $this->userModel->updateUser($userId, $username, $password, $roleId);
        if ($updateResult) {
            echo "<script>
                        alert('Data role berhasil diperbarui!');
                        window.location.href = 'index.php?modul=user&fitur=list'; 
                      </script>";
        } else {
            echo "<script>
                        alert('Gagal memperbarui data role. Silakan coba lagi.');
                        window.location.href = 'index.php?modul=user&fitur=edit&userId={$userId}'; 
                      </script>";
        }
        exit;
    }


    public function deleteUser($userId)
    {
        $result = $this->userModel->deleteUser($userId);
        if (!$result) {
            throw new Exception('Failed to delete role.');
        } else {
            header('location: index.php?modul=user&fitur=list');
        }
    }
}
