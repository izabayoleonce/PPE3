<?php
namespace model;

class Page
{
    private $_id,
            $_idTypeContenus,
            $_idPosition,
            $_idAuteur,
            $_nom,
            $_num,
            $_publier,
            $_pageAcceuil,
            $_dateCreation,
            $_dateModificaton;
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

    //SETTER

    /**
     * Set the value of id
     */ 
    public function setId($id)
    {
        $id = (int)$id;
        if($id > 0)
        {
            $this->_id = htmlentities($id);
        }
    }

    /**
     * Set the value of idPosition
     */ 
    public function setIdPosition($idPosition)
    {
        $idPosition = (int)$idPosition;
        if($idPosition > 0)
        {
            $this->_idPosition = htmlentities($idPosition);
        }
        
    }

    /**
     * Set the value of idAuteur
     */ 
    public function setIdAuteur($idAuteur)
    {
        $idAuteur = (int)$idAuteur;
        if ($idAuteur > 0) 
        {
            $this->_idAuteur = htmlentities($idAuteur);
        }
       
    }

    /**
     * Set the value of nom
     */ 
    public function setNom($nom)
    {
        $this->_nom = htmlentities($nom);
    }

    /**
     * Set the value of num
     */ 
    public function setNum($num)
    {
        $this->_num = htmlentities($num);
    }

    /**
     * Set the value of publier
     */ 
    public function setPublier($publier)
    {
        if (!empty($publier)) {
            $this->_publier = htmlentities($publier);
        } elseif($publier == null) {
            $this->_publier = 0;
        }
        
    }

    /**
     * Set the value of pageAcceuil
    */ 
    public function setPageAcceuil($pageAcceuil)
    {
        $this->_pageAcceuil = htmlentities($pageAcceuil);
    }

    /**
     * Set the value of dateCreation
     */ 
    public function setDateCreation($dateCreation)
    {
        if (!empty($dateCreation)) 
        {
            $this->_dateCreation = htmlentities($dateCreation);
        }
        elseif($dateCreation == null){
            $this->_dateCreation = date("Y-m-d H:i:s");
        }
        
    }

    /**
     * Set the value of dateModificaton
     */ 
    public function setDateModificaton($dateModificaton)
    {
        if (!empty($dateModificaton)) 
        {
            $this->_dateModificaton = htmlentities($dateModificaton);
        }elseif($dateModificaton == null){
            $this->_dateModificaton = date("Y-m-d H:i:s");
        }
            
    }

    //GETTER

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Get the value of idPosition
     */ 
    public function getIdPosition()
    {
        return $this->_idPosition;
    }

    /**
     * Get the value of idAuteur
     */ 
    public function getIdAuteur()
    {
        return $this->_idAuteur;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->_nom;
    }

    /**
     * Get the value of num
     */ 
    public function getNum()
    {
        return $this->_num;
    }

    /**
     * Get the value of publier
     */ 
    public function getPublier()
    {
        return $this->_publier;
    }

    /**
     * Get the value of pageAcceuil
     */ 
    public function getPageAcceuil()
    {
        return $this->_pageAcceuil;
    }

    /**
     * Get the value of dateCreation
     */ 
    public function getDateCreation()
    {
        return $this->_dateCreation;
    }

    /**
     * Get the value of dateModificaton
     */ 
    public function getDateModificaton()
    {
        return $this->_dateModificaton;
    }

}