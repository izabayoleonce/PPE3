<?php
namespace model;

class TypeContenus
{
    private $_id,
            $_titre,
            $_texte,
            $_photo,
            $_lien;
    
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
        if ($id > 0) {
            $this->_id = $id;
        }
        
    }

            
    public function setTitre($titre)
    {
        $this->_titre = $titre;
    }

            
    public function setTexte($texte)
    {
        $this->_texte = $texte;
    }

            
    public function setPhoto($photo)
    {
        $this->_photo = $photo;
    }

            
    public function setLien($lien)
    {
        $this->_lien = $lien;
    }

    
    public function getId()
    {
        return $this->_id;
    }

            
    public function getTitre()
    {
        return $this->_titre;
    }

            
    public function getTexte()
    {
        return $this->_texte;
    }
    public function getPhoto()
    {
        return $this->_photo;
    }

    public function getLien()
    {
        return $this->_lien;
    }
}