<?php
require_once 'controllers/roleController.php';
require_once 'controllers/userController.php';
require_once 'controllers/santriController.php';
require_once 'controllers/mapelController.php';

session_start();


$modul = isset($_GET['modul']) ? $_GET['modul'] : null;

$objRoles = new RoleController();
$objUsers = new UserController();
$objSantri = new SantriController();
$objMapel = new MapelController();




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
            case 'edit':
                $userId = $_GET['userId'];

                $objUsers->editById($userId);
                break;
            case 'update':
                $userId = $_POST['userId'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];

                $objUsers->updateUser($userId, $username, $password, $role);
                break;

            case 'delete':
                $userId = $_POST['userId'];

                $objUsers->deleteUser($userId);
                break;
        }
        break;
    case 'santri':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objSantri->listSantri();
                break;
            case 'input':
                include 'views/santri/santriInput.php';
                break;
            case 'add':
                $username = $_POST['username'];
                $password = $_POST['password'];
                $santriJenisKelamin = $_POST['santriJenisKelamin'];
                $santriTempatTglLahir = $_POST['santriTempatTglLahir'];
                $santriAlamat = $_POST['santriAlamat'];
                $santriNamaOrtu = $_POST['santriNamaOrtu'];
                $santriNoTelpOrtu = $_POST['santriNoTelpOrtu'];
                $santriGajiOrtu = $_POST['santriGajiOrtu'];

                $objSantri->addSantri($username, $password, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu);
                break;
            case 'edit':
                $santriId = $_GET['santriId'];

                $objSantri->editById($santriId);
                break;
            case 'update':
                $santriId = $_POST['santriId'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $santriJenisKelamin = $_POST['santriJenisKelamin'];
                $santriTempatTglLahir = $_POST['santriTempatTglLahir'];
                $santriAlamat = $_POST['santriAlamat'];
                $santriNamaOrtu = $_POST['santriNamaOrtu'];
                $santriNoTelpOrtu = $_POST['santriNoTelpOrtu'];
                $santriGajiOrtu = $_POST['santriGajiOrtu'];

                $objSantri->updateSantri($username, $password, $santriId, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu);
                break;
        }
        break;
    case 'mapel':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objMapel->listMapel();
                break;
            case 'input':
                include 'views/items/mapelInput.php';
                break;
            case 'add':
                $mapelNama = $_POST['mapelNama'];
                $mapelDeskripsi = $_POST['mapelDeskripsi'];

                $objMapel->addMapel($mapelNama, $mapelDeskripsi);
                break;
            case 'edit':
                $mapelId = $_GET['mapelId'];

                $objMapel->editById($mapelId);
                break;
            case 'update':
                $mapelId = $_POST['mapelId'];
                $mapelNama = $_POST['mapelNama'];
                $mapelDeskripsi = $_POST['mapelDeskripsi'];

                $objMapel->updateMapel($mapelId, $mapelNama, $mapelDeskripsi);
                break;
            case 'delete':
                $mapelId = $_POST['mapelId'];

                $objMapel->deleteMapel($mapelId);
                break;
        }
        break;
    default:

        include 'views/role/roleDashboard.php';
        break;
}
