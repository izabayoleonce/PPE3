<?php
namespace model;

class Page
{
    private $id,
            $_idContenu,
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

    
    public function setId($id)
    {
        $id = (int)$id;
        if($id > 0)
        {
            $this->id = $id;
        }
    }
}