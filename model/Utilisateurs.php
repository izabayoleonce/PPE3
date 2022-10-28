<?php
namespace model;

class Utilisateurs
{
    private $_id,
            $_nom,
            $_prenom,
            $_mail,
            $_login,
            $_password,
            $_isadmin,
            $_observation,
            $_active,
            $_newletter;   

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

           
    public function setNom($nom)
    {
        $this->_nom = $nom;

    }

    

    public function setPrenom($prenom)
    {
        $this->_prenom = $prenom;

    }

    public function setMail($mail)
    {
        $this->_mail = $mail;
    }


    public function setLogin($login)
    {
        $this->_login = $login;
    }

 
    public function setPassword($password)
    {
        $this->_password = $password;
    }

             
    public function setIsadmin($isadmin)
    {
        if($isadmin != null)
        {
            $this->_isadmin = $isadmin;
        } else {
            $this->_isadmin = 0;
        }
    }

            
    public function setActive($active)
    {
        if($active != null)
        {
            $this->_active = $active;
        } else {
            $this->_active = 0;
        }
    }

             
    public function setNewletter($newletter)
    {
        if($newletter == null)
        {
            $this->_newletter = 0;
        } else {
            $this->_newletter = $newletter;
        }
    }
    public function setObservation($observation)
    {
        if (is_string($observation)) {
            $this->_observation =$observation;
        }else{
            $this->_observation = "OK";
        }
    }

     
    public function getId()
    {
        return $this->_id;
    }

    
    public function getNom()
    {
        return $this->_nom;
    }

            
    public function getPrenom()
    {
        return $this->_prenom;
    }

         
    public function getMail()
    {
        return $this->_mail;
    }

        
    public function getLogin()
    {
        return $this->_login;
    }

    public function getPassword()
    {
       return $this->_password;
    }


    public function getIsadmin()
    {
        return $this->_isadmin;
    }

    public function getActive()
    {
        return $this->_active;
    }

    public function getNewletter()
    {
        return $this->_newletter;
    }

    public function getObservation()
    {
        return $this->_observation;
    }
}