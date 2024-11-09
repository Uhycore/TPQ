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


    public function deleteUser($roleId)
    {
        $result = $this->userModel->deleteUser($roleId);
        if (!$result) {
            throw new Exception('Failed to delete role.');
        } else {
            header('location: index.php?modul=user&fitur=list');
        }
    }
}
