<?php
namespace controller;

use model\Contenus;
use model\ContenusManager;
use model\PageManager;
use model\TypeContenusManager;
use model\UtilisateurManager;

class ContenuController extends Controller
{
    protected $ContenuManager,
              $typeContenuManager,
              $userManager,
              $pageManager;
    public function __construct()
    {
        $this->ContenuManager = new ContenusManager();
        $this->typeContenuManager = new TypeContenusManager();
        $this->userManager = new UtilisateurManager();
        $this->pageManager = new PageManager;
        parent::__construct();
    }

    public function defaultAction()
    {
        
    } 

    public function createContenuAction()
    {
        if (isset($_REQUEST['contenu']) && isset($_REQUEST['type']) && isset($_REQUEST['page']) 
        && !empty($_REQUEST['contenu']) && !empty($_REQUEST['type']) && !empty($_REQUEST['page'])||
        isset($_FILES['contenu'])) {
            $text = "";
            $textData = "";
            $date = date('d-m-Y_H-i-s', time());
            $id = htmlentities($_REQUEST['page']);
            $user =  $this->pageManager->UserOfPage($id);
            $infoPage = $this->pageManager->getPage($id);
            $userName = $user['nom']. "_" . $user['prenom']."_".$infoPage["nom"];
            $type = $this->typeContenuManager->getTypeContenus(htmlentities($_REQUEST['type']));
            $nom = $type['titre'];
            if(isset($_FILES['contenu'])){
                if($_FILES['contenu']['size'] <= 80000000){
                    $infosfichier = pathinfo($_FILES['contenu']['name']);
                    $extension_upload = $infosfichier['extension'];
                    $extension_autorisees = ['jpg', 'jpeg', 'png']; 
                    if (in_array($extension_upload, $extension_autorisees)) 
                    {
                        $text ="CMS_".$userName."_".$date.".".$extension_upload;
                        $textData = 'public/images/contenu/' . $text;
                    }
                }
                $nom = $_POST['nom'];
            }else{
                $text = $_REQUEST['contenu'];
            }
            $idType = $type['id'];
            $data = [
                'nomContenu'            =>$nom,
                'contenu'               =>$textData,
                'idPage'                =>$_REQUEST['page'],
                'idType'                =>$idType,
                'dateCreation'          =>date("Y-m-d H:i:s", time()),
                'dateModification'      =>date("Y-m-d H:i:s", time()),
            ];
            $newContent = new Contenus($data);
            $loadContent = $this->ContenuManager->add($newContent);
            if($loadContent){
                if(isset($_FILES)){
                    move_uploaded_file($_FILES['contenu']['tmp_name'], 'public/images/contenu/' . $text);
                }
                echo true;
            }
        }else {
            # code...
            
        }
        
    } 
}
