<?php
namespace model;

class Navigation
{
    private $_id,
            $_idAuteur,
            $_idPage,
            $_lienPage,
            $_libelleLien,
            $_nomDuMenu,
            $_positionMenu,
            $_publier,
            $_dateCreation,
            $_dateModification;
    
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) 
        {
            $method ='set'.ucfirst($key);
            if (method_exists($this, $method)) 
            {
                $this->$method($value);
            }

        }
    }

    public function setId($id)
    {
        $id = (int)$id;
        if($id > 0)
        {
            $this->_id = htmlentities($id);
        }
    }

           
    public function setIdAuteur($idAuteur)
    {
        $idAuteur = (int)$idAuteur;
        if($idAuteur > 0)
        {
            $this->_idAuteur = htmlentities($idAuteur);
        }
    }
    
    public function setIdPage($idPage)
    {
        $idPage = (int)$idPage;
        if($idPage > 0)
        {
            $this->_idPage = htmlentities($idPage);
        }
    }

            
    public function setLienPage($lienPage)
    {
        $this->_lienPage = htmlentities($lienPage);
    }

             
    public function setLibelleLien($libelleLien)
    {
        $this->_libelleLien = htmlentities($libelleLien);
    }

             
    public function setNomDuMenu($nomDuMenu)
    {
        $this->_nomDuMenu = htmlentities($nomDuMenu);
    }

            
    public function setIdPosition($positionMenu)
    {
        $this->_positionMenu = htmlentities($positionMenu);
    }

            
    public function setPublier($publier)
    {
        $this->_publier = htmlentities($publier);
    }

             
    public function setDateCreation($dateCreation)
    {
        $this->_dateCreation = htmlentities($dateCreation);
    }

            
    public function setDateModification($dateModification)
    {
        $this->_dateModification = htmlentities($dateModification);
    }

     
    public function getId()
    {
        return $this->_id;
    }


    public function getIdAuteur()
    {
        return $this->_idAuteur;
    }
    public function getIdPage()
    {
        return $this->_idPage;
    }

            

            
    public function getLibelleLien()
    {
        return $this->_libelleLien;
    }

            
    public function getNomDuMenu()
    {
        return $this->_nomDuMenu;
    }


    public function getPositionMenu()
    {
        return $this->_positionMenu;
    }


    public function getPublier()
    {
        return $this->_publier;
    }

 
    public function getDateCreation()
    {
        return $this->_dateCreation;
    }

    public function getDateModification()
    {
        return $this->_dateModification;
    }

    public function getLienPage()
    {
        return $this->_lienPage;
    }
}