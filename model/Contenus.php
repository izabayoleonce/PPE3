<?php
namespace model;


class Contenus
{
    private $_id,
            $_nomContenu,
            $_contenu,
            $_idType,
            $_idPage,
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

            
    public function setNomContenu($nomContenu)
    {
        $this->_nomContenu = htmlentities($nomContenu);
    }


    public function setContenu($contenu)
    {
        $this->_contenu = htmlentities($contenu);
    }

    public function setIdType($idType)
    {
        $this->_idType = htmlentities($idType);
    }

    

            
    public function setPublier($publier)
    {
        if($publier != null)
        {
            $this->_publier = htmlentities($publier);
        } else {
            $this->_publier = 0;
        }
    }

            
    public function setDateCreation($dateCreation)
    {  
        $dateCreation = date("Y-m-d H:i:s", time());
        if (isset($dateCreation)) {
            $this->_dateCreation = htmlentities($dateCreation);
        }else{
            $this->_dateCreation = date("Y-m-d H:i:s", time());
        }
        
    }

            
    public function setDateModification($dateModification)
    {
        $dateModification = date("Y-m-d H:i:s", time());
        if (isset($dateModification)) {
            $this->_dateModification = htmlentities($dateModification);
        }else{
            $this->_dateModification = date("Y-m-d H:i:s", time());
        }
        
    }


    
    public function getId()
    {
        return $this->_id;
    }

            
    public function getNomContenu()
    {
        return $this->_nomContenu;
    } 

     
    public function getContenu()
    {
        return $this->_contenu;
    }

   
     public function getIdType()
    {
        return $this->_idType;
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

    /**
     * Get the value of _idPage
     */ 
    public function getIdPage()
    {
        return $this->_idPage;
    }

    /**
     * Set the value of _idPage
     */ 
    public function setIdPage($_idPage)
    {
        $this->_idPage = $_idPage;
    }
}