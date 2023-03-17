<?php
namespace controller;
use model\PageManager;
use model\TypeContenusManager;
use model\TypeContenus;
use model\UtilisateurManager;

class TypeContenuController extends Controller
{
    private $typeManager,
            $userManager,
            $pageManager;
    public function __construct()
    {
        $this->typeManager = new TypeContenusManager;
        $this->userManager = new UtilisateurManager;
        $this->pageManager = new PageManager;
        parent::__construct();  
    }
    public function defaultAction()
    {
        
    }

    public function createAction()
    {
        var_dump($_POST);
        var_dump($_SESSION);
        if (isset($_REQUEST['type']) && !empty($_REQUEST['type'])) {
            $nbType = $this->typeManager->countAllTypeContenus($_POST['type']);
            $msg = '';
            if ($nbType == 0) {
                $Data = [
                    'titre'     => $_POST['type'],
                ];
                $type = new TypeContenus($Data);
                $insert = $this->typeManager->add($type);

            } else {
                $msg = 'Ce type existe dejà'; 
            }
        } else {
            $msg = 'veiller saisir le nom du type de conteu';   
        }
        $user = $this->userManager->getUsers(htmlspecialchars($_SESSION['login']));
        if ($user) {
            $checkPassword = sodium_crypto_pwhash_str_verify($user['password'], htmlspecialchars($_SESSION['password']));
            $isAdmin = $user['isadmin'];
            $activate = $user['active'];

            if ($checkPassword) {
                $_SESSION['login'] = $user['login'];
                if ($isAdmin == 1 && $activate == 1) {
                    $idAdmin = $user['id'];
                    $data = [
                        'isadmin' => $idAdmin,
                        'msg' => $msg,
                    ];
                    $this->render('Adminhome', $data);
                } elseif ($isAdmin == 0 && $activate == 1) {
                    $idUser = $user['id'];
                    $lstPages = $this->pageManager->getPagesUser($idUser);
                    $listType = $this->typeManager->getTypeContenusUser($idUser);
                    $data = [
                        'listpage' => $lstPages,
                        'idusers' => $idUser,
                        'user' => $user,
                        'msg' => $msg,
                        'listType' => $listType
                    ];
                    $this->render('Home', $data);
                }
            }
        }
    }
}