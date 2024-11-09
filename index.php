<?php
require_once 'controllers/roleController.php';
require_once 'controllers/userController.php';

session_start();


$modul = isset($_GET['modul']) ? $_GET['modul'] : null;

$objRoles = new RoleController();
$objUsers = new UserController();



switch ($modul) {
    case 'role':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objRoles->listRoles();
                
                break;
            case 'input':
                include 'views/role/roleInput.php';
                break;
            case 'add':
                $roleName = $_POST['roleNama'];
                $roelDeskripsi = $_POST['roleDeskripsi'];
                $roleStatus = $_POST['roleStatus'];

                $objRoles->addRole($roleName, $roelDeskripsi, $roleStatus);
                break;
            case 'delete':
                $roleId = $_POST['roleId'];

                $objRoles->deleteRole($roleId);
                break;

            case 'edit':
                $roleId = $_GET['roleId'];

                $objRoles->editById($roleId);
                break;
            case 'update':
                $roleId = $_POST['roleId'];
                $roleName = $_POST['roleNama'];
                $roelDeskripsi = $_POST['roleDeskripsi'];
                $roleStatus = $_POST['roleStatus'];

                $objRoles->updateRole($roleId, $roleName, $roelDeskripsi, $roleStatus);
                break;
        }
        break;
    case 'user':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objUsers->listUsers();
                break;
            case 'input':
                $objUsers->inputUsers();
              
                break;
            case 'add':
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];

                $objUsers->addUser($username, $password, $role);
                break;

            case 'delete':
                $userId = $_POST['userId'];

                $objUsers->deleteUser($userId);
                break;
        }
        break;
    default:

        include 'views/role/roleDashboard.php';
        break;
}
