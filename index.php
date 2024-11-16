<?php
require_once 'controllers/roleController.php';
require_once 'controllers/adminController.php';
require_once 'controllers/santriController.php';
require_once 'controllers/guruController.php';
require_once 'controllers/mapelController.php';
require_once 'controllers/nilaiController.php';
require_once 'controllers/keuanganController.php';

require_once 'controllers/loginController.php';





session_start();


$modul = isset($_GET['modul']) ? $_GET['modul'] : null;

$objRoles = new RoleController();
$objSantri = new SantriController();
$objAdmin = new AdminController();
$objGuru = new GuruController();
$objMapel = new MapelController();
$objNilai = new NilaiController();
$objKeuangan = new KeuanganController();

$objLogin = new loginController();





switch ($modul) {
    case 'login':
        $objLogin->login();
        break;
    case 'logout':
        $objLogin->logout();
        break;
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
                $objRoles->addRoles();
            case 'edit':
                $objRoles->editById();
                break;
            case 'update':
                $objRoles->updateRoles();
                break;
            case 'delete':
                $objRoles->deleteRoles();
                break;
            default:
                $objRoles->listRoles();
                break;
        }
        break;
    case 'admin':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objAdmin->listAdmins();
                break;
            case 'input':
                include 'views/admin/adminInput.php';
                break;
            case 'add':
                $objAdmin->addAdmins();
                break;
            case 'edit':
                $objAdmin->editById();
                break;
            case 'update':
                $objAdmin->updateAdmins();
                break;
            case 'delete':
                $objAdmin->deleteAdmins();
                break;
            default:
                $objAdmin->listAdmins();
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
                $objSantri->addSantri();
                break;
            case 'edit':
                $objSantri->editById();
                break;
            case 'update':
                $objSantri->updateSantri();
                break;
            case 'delete':
                $objSantri->deleteSantri();
                break;
            default:
                $objSantri->listSantri();
                break;
        }
        break;
    case 'guru':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objGuru->listGurus();
                break;
            case 'input':
                include 'views/guru/guruInput.php';
                break;
            case 'add':
                $objGuru->addGurus();
                break;
            case 'edit':
                $objGuru->editById();
                break;
            case 'update':
                $objGuru->updateGurus();
                break;
            case 'delete':
                $objGuru->deleteGurus();
                break;
            default:
                $objGuru->listGurus();
                break;
        }
        break;

    case 'mapel':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objMapel->listMapels();
                break;
            case 'input':
                include 'views/items/mapelInput.php';
                break;
            case 'add':
                $objMapel->addMapels();
                break;
            case 'edit':
                $objMapel->editById();
                break;
            case 'update':
                $objMapel->updateMapels();
                break;
            case 'delete':
                $objMapel->deleteMapels();
                break;
        }
        break;
    case 'nilai':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objNilai->listNilais();
                break;
            case 'input':
                $objNilai->inputNilais();
                break;
            case 'add':
                $objNilai->addNilais();
                break;
            default:
                $objNilai->listNilais();
                break;
        }
        break;
    case 'keuangan':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objKeuangan->listKeuangans();
                break;
            case 'input':
                $objKeuangan->inputKeuangans();
                break;
            case 'add':
                $objKeuangan->addKeuangans();
                break;
            default:
                $objKeuangan->listKeuangans();
                break;
        }
        break;


    default:
        $objLogin->checkLogin();
        
        break;
}
