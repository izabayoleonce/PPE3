<?php
namespace model;

class Navigation
{
    private $_id,
            $_idAuteur,
            $_lienPage,
            $_libelleLien,
            $_nomDuMenu,
            $_idPosition,
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
            $this->_id = $id;
        }
    }

           
    public function setIdAuteur($idAuteur)
    {
        $idAuteur = (int)$idAuteur;
        if($idAuteur > 0)
        {
            $this->_idAuteur = $idAuteur;
        }
    }

            
    public function setLienPage($lienPage)
    {
        $this->_lienPage = $lienPage;
    }

             
    public function setLibelleLien($libelleLien)
    {
        $this->_libelleLien = $libelleLien;
    }

             
    public function setNomDuMenu($nomDuMenu)
    {
        $this->_nomDuMenu = $nomDuMenu;
    }

            
    public function setIdPosition($idPosition)
    {
        $this->_idPosition = $idPosition;
    }

            
    public function setPublier($publier)
    {
        $this->_publier = $publier;
    }

             
    public function setDateCreation($dateCreation)
    {
        $this->_dateCreation = $dateCreation;
    }

            
    public function setDateModification($dateModification)
    {
        $this->_dateModification = $dateModification;
    }

     
    public function getId()
    {
        return $this->_id;
    }


    public function getIdAuteur()
    {
        return $this->_idAuteur;
    }

            

            
    public function getLibelleLien()
    {
        return $this->_libelleLien;
    }

            
    public function getNomDuMenu()
    {
        return $this->_nomDuMenu;
    }


    public function getIdPosition()
    {
        return $this->_idPosition;
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