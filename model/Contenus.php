<?php
namespace model;


class Contenus
{
    private $_id,
            $_nom,
            $_contenu,
            $_idTypeContenus,
            $_idAuteur,
            $_publier,
            $_dateCreation,
            $_dateModification,
            $_position;

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

            
    public function setNom($nom)
    {
        $this->_nom = $nom;
    }


    public function setContenu($contenu)
    {
        $this->_contenu = $contenu;
    }

    public function setIdTypeContenus($idTypeContenus)
    {
        $this->_idTypeContenus = $idTypeContenus;
    }

           
    public function setIdAuteur($idAuteur)
    {
        $this->_idAuteur = $idAuteur;
    }

            
    public function setPublier($publier)
    {
        if($publier != null)
        {
            $this->_publier = $publier;
        } else {
            $this->_publier = 0;
        }
    }

            
    public function setDateCreation($dateCreation)
    {
        $this->_dateCreation = $dateCreation;
    }

            
    public function setDateModification($dateModification)
    {
        $this->_dateModification = $dateModification;
    }

            
    public function setPosition($position)
    {
        $this->_position = $position;
    }

    
    public function get_id()
    {
        return $this->_id;
    }

            
    public function get_nom()
    {
        return $this->_nom;
    }

     
    public function get_contenu()
    {
        return $this->_contenu;
    }

   
     public function get_idTypeContenus()
    {
        return $this->_idTypeContenus;
    }

    
    public function get_idAuteur()
    {
        return $this->_idAuteur;
    }

    
    public function get_publier()
    {
        return $this->_publier;
    }

    
    public function get_dateCreation()
    {
        return $this->_dateCreation;
    }

    
    public function get_dateModification()
    {
        return $this->_dateModification;
    }

    
    public function get_position()
    {
        return $this->_position;
    }
}