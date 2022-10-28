<?php
namespace controller;
use model\utilisateurs;
use model\UtilisateurManager;

class UtilisateurController extends Controller
{
    protected $userManager;
    public function __construct()
    {
        $this->userManager = new UtilisateurManager();
        parent::__construct();
    }

    public function defaultAction()
    {
        
    }

    public function loginAction()
    {
        $msg = 'Veillez remplire les duex champs login et mot de passe';

        if (isset($_POST['cookies'])) {
            if (isset($_POST['password'])  && isset($_POST['login']) &&
                !empty($_POST['password']) && !empty($_POST['login'])) {
                   $user = $this->userManager->getUsers($_POST['login']);
                   var_dump($user);   
                
            }else{
                $data=[
                    'message'       => $msg,
                ];
                $this->render("Connection", $data); 
            }

        }else{

        }
    }

    public function createAction()
    {

    }

    public function createValidateAction()
    {

    }

    public function activeAction()
    {

    }

    public function desactiveAction()
    {
    
    }

    public function updateAction()
    {

    }

    public function updateValidateAction()
    {
        
    }

}