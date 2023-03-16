<?php
namespace model;

class TypeContenus
{
    private $_id,
            $_titre;
    
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
            $this->_id = htmlentities($id);
        }
        
    }

            
    public function setTitre($titre)
    {
        $this->_titre = htmlentities($titre);
    }

    
    public function getId()
    {
        return $this->_id;
    }

            
    public function getTitre()
    {
        return $this->_titre;
    }
}