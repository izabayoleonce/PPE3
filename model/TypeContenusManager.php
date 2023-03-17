<?php
namespace model;

use model\TypeContenus;
use PDO;
class TypeContenusManager extends Manager
{

    public function add(TypeContenus $type)
    {
        $q=$this->manager
                 ->db
                 ->prepare('INSERT INTO type_contenus(titre) VALUE(:titre)');
        return $q->execute([
            ':titre'        =>$type->getTitre()
        ]);

    }

    
    public function update(TypeContenus $type) 
    {
        $q=$this->manager
                ->db
                ->prepare('UPDATE type_contenus SET titr:titre WHERE id = :id');
        return $q->execute([
            ':id'               => $type->getId(),
            ':titre'            => $type->getTitre()
         ]);
    }

    public function getAllTypeContenus()
    {
        $q=$this->manager
                ->db
                ->prepare('SELECT * FROM cms_type_contenus');
        $q->execute();
        $listtype = $q->fetchAll(PDO::FETCH_ASSOC);

        return $listtype;
    }
    public function countAllTypeContenus($nom)
    {
        $q=$this->manager
                ->db
                ->prepare('SELECT * FROM cms_type_contenus WHERE titre = :titre');
        $q->bindValue("titre",$nom, PDO::PARAM_STR_CHAR);
        $q->execute([
            'titre'        => $nom 
        ]);
        $nbType= $q->rowCount();

        return $nbType;
    }
    public function getTypeContenus($id)
    {
        $q=$this->manager
                ->db
                ->prepare('SELECT * FROM cms_type_contenus WHERE id = :id');
        $q->bindValue("id",$id, PDO::PARAM_INT);
        $q->execute([
            'id'        => $id 
        ]);
        $Type = $q->fetch(PDO::FETCH_ASSOC);

        return $Type;
    }
    public function getTypeContenusUser($id)
    {
        $q=$this->manager
                ->db
                ->prepare('SELECT cms_contenus.nomContenu AS nomContenu, cms_type_contenus.titre AS nomType, cms_type_contenus.id AS idType
                           FROM cms_contenus
                           INNER JOIN cms_type_contenus ON cms_contenus.idType=cms_type_contenus.id 
                           INNER JOIN cms_pages ON cms_contenus.idPage=cms_pages.id
                           WHERE cms_pages.idAuteur=:idAuteur
                           GROUP BY cms_contenus.id ');
        $q->execute([
            'idAuteur'     =>$id
        ]);
        $listtype = $q->fetchAll(PDO::FETCH_ASSOC);

        return $listtype;
    }
}