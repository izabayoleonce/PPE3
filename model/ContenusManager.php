<?php
namespace model;

use model\Contenus;
use PDO;
class ContenusManager extends Manager
{
    
    public function add(Contenus $contenus)
    {
        $q=$this->manager
                ->db
                ->prepare('INSERT INTO cms_contenus(nomContenu, contenu, idPage, idType, dateCreation, dateModif) VALUE(:nomContenu, :contenu, :idPage, :idType, :dateCreation, :dateModif)');
        return $q->execute([
            ':nomContenu'               =>$contenus->getNomContenu(), 
            ':contenu'                  =>$contenus->getContenu(),
            ':idPage'                   =>$contenus->getIdPage(),
            ':idType'                   =>$contenus->getIdType(),
            ':dateCreation'             =>$contenus->getDateCreation(), 
            ':dateModif'                =>$contenus->getDateModification()
        ]);
    }

    public function getContenuByTypr($auteur, $type)
    {
        $q=$this->manager
                ->db
                ->prepare('SELECT cms_contenus.*, cms_pages.nom AS nomPage, cms_type_contenus.titre AS type, utilisateurs.id AS idUser FROM `cms_pages`
                INNER JOIN cms_contenus ON cms_contenus.idPage = cms_pages.id
                INNER JOIN utilisateurs ON cms_pages.idAuteur = utilisateurs.id
                INNER JOIN cms_type_contenus ON cms_contenus.idType = cms_type_contenus.id
                 WHERE idType=:idTypeContnu AND idAuteur=:idAuteur');
        $q->execute([
            'idTypeContnu'         =>$type,
            'idAuteur'             =>$auteur, 
        ]);
        $listContenu = $q->fetchAll(PDO::FETCH_ASSOC);
        return $listContenu;
    }
    public function contenuUser($id)
    {
        $q = $this->manager
                  ->db
                  ->prepare('SELECT cms_contenus.*, cms_pages.nom AS nomPage, cms_type_contenus.titre AS type, utilisateurs.id AS idUser FROM `cms_pages`
                            INNER JOIN  cms_contenus ON cms_contenus.idPage = cms_pages.id
                            INNER JOIN utilisateurs ON cms_pages.idAuteur = utilisateurs.id
                            INNER JOIN cms_type_contenus ON cms_contenus.idType = cms_type_contenus.id
                            WHERE utilisateurs.id = :id');
        $q -> execute([
            ':id'           => $id
        ]);
        $listContenu = $q->fetchAll(PDO::FETCH_ASSOC);
        return $listContenu;
    }
    public function contnueByPage($id)
    {
        $sql = 'SELECT cms_contenus.* FROM cms_pages INNER JOIN cms_contenus ON cms_contenus.idPage = cms_pages.id WHERE cms_pages.id = :id';
        $q=$this->manager
                  ->db
                  ->prepare($sql);
        $q->execute([
            ':id'           => $id,
        ]);
        var_dump($q);
        $listContenu = $q->fetchAll(PDO::FETCH_ASSOC);
        return $listContenu;
    }

}