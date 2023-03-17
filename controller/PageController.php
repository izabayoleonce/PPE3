<?php
namespace controller;
use model\ContenusManager;
use model\Page;
use model\PageManager;
use model\TypeContenusManager;
use model\UtilisateurManager;

class PageController extends Controller
{
    protected $pageManager,
              $typeManager,
              $contenuManager,
              $userManager;
    public function __construct()
    {
        $this->pageManager = new PageManager;
        $this->typeManager = new TypeContenusManager;
        $this->contenuManager = new ContenusManager;
        $this->userManager = new UtilisateurManager;
        parent::__construct();
    }
    public function defaultAction()
    {
        
    }
    
    public function createPageAction()
    {
        if (!empty($_REQUEST['position']) && !empty($_REQUEST['num'])) {
            $Data = [
                'position'             => $_REQUEST['position'],
                'name'                 => $_REQUEST['name'],
                'num'                  => $_REQUEST['num'],
                'AsGreetPage'          => $_REQUEST['AsGreetPage'],
            ];
            $page = new Page($Data);
            if ($this->pageManager->add($page)) {
                echo true;
            }else{
                echo false;
            }

        }
    }

    public function contenuAccessAction()
    {
       if (isset($_REQUEST['id'])) {
        $idUser = intval(htmlspecialchars($_REQUEST['id']));
        $idPage = intval(htmlspecialchars($_REQUEST['page']));
        $contenus = $this->contenuManager->contenuUser($idUser);
        $listTypeContenus = $this->typeManager->getAllTypeContenus();
        $user = $this->userManager->get($idUser);
        $page = $this->pageManager->getPage($idPage);
        $nomPage = $page['nom']; 
        $data = [
            'listType'      =>$listTypeContenus,
            'listContenu'   =>$contenus, 
            'user'          => $user,
            'idPage'        =>$idPage,
            'nom'           =>$nomPage,
        ];
        $this->render('CreateContenue', $data);
       } 
    }
    
    public function createAction()
    {
        if (!empty($_REQUEST['position']) && !empty($_REQUEST['num'])) {
            echo "ok <br>";
            // var_dump($_REQUEST);
            $Data = [
                'idPosition'             => $_REQUEST['position'],
                'nom'                    => $_REQUEST['name'],
                'num'                    => $_REQUEST['num'],
                'pageAcceuil'            => $_REQUEST['pageAcceuil'],
                'idAuteur'               => $_REQUEST['auteur'],
                'publier'                => 0,
                'dateModificaton'        =>date("Y-m-d H:i:s"),
                'dateCreation'           =>date("Y-m-d H:i:s") 
            ];
            $page = new Page($Data);
            // var_dump($page);
            if ($this->pageManager->add($page)) {
                echo true;
            }else{
                echo false;
            }

        }else{
            echo "error";
        }
    }
}