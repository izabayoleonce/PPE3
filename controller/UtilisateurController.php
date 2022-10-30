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
        var_dump($_POST);
        
        if (isset($_POST['password'])  && isset($_POST['login']) &&
            !empty($_POST['password']) && !empty($_POST['login'])) {
               $user = $this->userManager->getUsers($_POST['login']);
               $checkPassword = sodium_crypto_pwhash_str_verify($user['password'], $_POST['password'] );
               $isAdmin = $user['isadmin'];
               $activate = $user['active'];
                   
                   
               if ($checkPassword) {
                $_SESSION['login'] = $user['login'];
                $_SESSION['password'] = $_POST['password'];
                if ($isAdmin == 1 && $activate == 1) {
                    $idAdmin = $user['id'];
                    $data=[
                        'idadmin'   => $idAdmin
                    ];
                    $this->render('Adminhome',$data);
                }elseif ($isAdmin == 0 && $activate == 1) {
                    $idUser = $user['id'];
                    $data=[
                        'idadmin'   => $idUser
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
               }else {
                    $msg = " Cet utilisateur n'exit pas verifier le login et le mot de passe saisi";
                    $data=[
                        'message'       => $msg,
                    ];
                    $this->render("Connection", $data); 
               }
            if (isset($_POST['cookies'])) {
                setcookie('login', $user['login'], time()+(60*60*48));
            }else {}
        }else{
            $data=[
                'message'       => $msg,
            ];
            $this->render("Connection", $data); 
        }

        
    }

    public function verifyMailEndLoginAction()
    {
        if (isset($_POST['login']) && isset($_POST['email']) &&
            !empty($_POST['login']) && !empty($_POST['email'])) {
            if($user = $this->userManager->verifyMailLogin($_POST['email'], $_POST['login'])){
                echo true;
                $data = [
                    'login'     => $user['login'],
                    'email'     => $user['mail']
                ];
            }else{
                echo false;
            }
        }
    }

    public function createAction()
    {
        $data=[];
        $this->render("CreateUser", $data); 

    }

    public function createValidateAction()
    {
        $nom = htmlentities($_POST['name']);
        $prenom = htmlentities($_POST['lastname']);
        $mail = htmlentities($_POST['email']);
        $setnewletter ='';
        $login = htmlentities($_POST['login']);
        // assigned valued of newsletter
        if (isset($_POST['newsletter'])) {
            $setnewletter = htmlentities($_POST['newsletter']);
        }else{
            $setnewletter;
        }

        // verify input of password and  reapect password
        if($_POST['password'] == $_POST['Repassword'] && !empty($_POST['password']) && !empty($_POST['Repassword']) )
            {
                $password = $_POST['password'] = $_POST['Repassword'];
                
                // hash password
                $passwordhash = sodium_crypto_pwhash_str($password,SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE, SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE);

                // verify  set name, lastname, email 
                if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['email'])  
                && !empty($_POST['name']) && !empty($_POST['lastname']) && !empty($_POST['email'])) {
                    
                    // implementation of the information under form array for set in data base 
                    $Data = [
                        'nom'           => $nom,
                        'prenom'        => $prenom,
                        'mail'          => $mail,
                        'newletter'     => $setnewletter,
                        'login'         => $login,
                        'password'      => $passwordhash,
                        'active'        => '',
                        'observation'   => '',
                        'isadmin'       => '',
                    ];

                    
                    $userData = new Utilisateurs($Data);
                    
                    // verify user exist
                    $userSelect = $this->userManager->getUsers($login);
                    
                    // if user exist
                    if ($userSelect == FALSE) {
                        $user = $this->userManager->add($userData);
                        $userSelect = $this->userManager->getUsers($login);
                        if ($userSelect == true) {
                                $msg="Votre compte a été créé et est en attente d'activation, il sera bientôt activé le cas échéant veillez de contacter les administrateurs.";
                                $data=[
                                    'msg'       => $msg
                                ];
                                $this->render("Connection", $data);
                        }else{
                                $msg = 'il y aa un problème est survenue lors de l'."'".'inscription des vos données ';
                    
                                $date = [
                                    'donnee' => $msg
                                ];
                
                                $this->render("Connection", $date);
                        }
                    }
                    else{
                        $msg = 'Cette utilisateur existe déjà';
                        $donnee = [
                            'message'       => $msg,
                        ];

                        $date = [
                            'donnee' => $donnee
                        ];
                        $this->render('CreateUser', $date);
                    }    
                }
            }
            else{
                // assigned valued of newsletter
                if (isset($_POST['newsletter'])) {
                    $setnewletter = htmlentities($_POST['newsletter']);
                }else{
                    $setnewletter='';
                }
                $msg = 'Veilllez remplir le même mot de passe dans les deux champs';
                $donnee = [
                    'name'          => $_POST['name'],
                    'lastname'      => $_POST['lastname'],
                    'email'         => $_POST['email'],
                    'newsletter'    => $setnewletter,
                    'password'      => $_POST['password'],
                    'repassword'    => $_POST['Repassword'],
                    'message'       => $msg,
                ];

                $date = [
                    'donnee' => $donnee
                ];

                $this->render('CreateUser', $date);
            }

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