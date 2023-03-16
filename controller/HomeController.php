<?php
namespace controller;

use model\PageManager;
use model\TypeContenusManager;
use model\utlisateurs;
use model\UtilisateurManager;


class HomeController extends Controller
{
    protected $userManager,
              $pageManager,
              $typeContenuManager;
    public function __construct()
    {
        $this->userManager = new UtilisateurManager();
        $this->pageManager = new PageManager();
        $this->typeContenuManager = new TypeContenusManager();
        parent::__construct();
    }

    public function defaultAction()
    {
        $msg = 'Veillez remplire les deux champs: login et mot de passe';
        // var_dump($_COOKIE);
        
        if ( isset($_COOKIE['ID']) && !empty($_COOKIE['ID']) ||
             isset($_SESSION['login']) && !empty($_SESSION['login'])) {
            // $cle_secrete = $_COOKIE['PEPCMSsecret']; $nonce = $_COOKIE['PEPCMSkey'];
    
            // $login = sodium_crypto_secretbox_open($_COOKIE['ID'], $nonce, $cle_secrete);
            $login = (!empty($_COOKIE['ID'])) ? sodium_crypto_secretbox_open($_COOKIE['ID'],  $_COOKIE['PEPCMSkey'], $_COOKIE['PEPCMSsecret']) : $_SESSION['login'] ;
               $user = $this->userManager->getUsers($login);
               if ($user) {
                    $isAdmin = $user['isadmin'];
                    $activate = $user['active'];
                        
                        $_SESSION['login'] = $user['login'];
                        if ($isAdmin == 1 && $activate == 1) {
                            $idAdmin = $user['id'];
                            $data=[
                                'isadmin'   => $idAdmin
                            ];
                            $this->render('Adminhome',$data);
                        }elseif ($isAdmin == 0 && $activate == 1) {
                            $idUser = $user['id'];
                            $lstPages = $this->pageManager->getPagesUser($idUser);
                            $listPosition = $this->pageManager->getAllPosition();
                            $listType = $this->typeContenuManager->getTypeContenusUser($idUser);
                            $data=[
                                'listpage'        => $lstPages,
                                'idusers'         => $idUser, 
                                'user'            => $user,
                                'listType'        =>$listType,
                                'listPosition'    =>$listPosition
                            ];
                            $this->render('Home',$data);
                        }
                        elseif ($isAdmin == 0 && $activate == 0) {
                            $msg="Votre compte est en attente d'activation, il sera bientôt activé le cas échéant veillez de contacter les administrateurs.";
                            $data=[
                                'msg'       => $msg,
                            ];
                            $this->render("Connection", $data);
                        }
                }
                else {
                    $msg = " Cet utilisateur n'exit pas verifier le login et le mot de passe saisi";
                    $data=[
                        'message'       => $msg,
                    ];
                    $this->render("Connection", $data); 
                }
        }else{
            $data=[];
            $this->render("Connection", $data); 
        }
        
    }
}