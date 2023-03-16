<?php
namespace model;

class messagerie{

    private $_id,
            $_id_utilisateur,
            $_message,
            $_reponse,
            $_lu,
            $_repondu;
    


    /**
     * Set the value of id
     */ 
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * Set the value of id_utilisateur
     */ 
    public function setId_utilisateur($id_utilisateur)
    {
        $this->_id_utilisateur = $id_utilisateur;
    }

    /**
     * Set the value of message
     */ 
    public function setMessage($message)
    {
        $this->_message = $message;
    }

    /**
     * Set the value of reponse
     */ 
    public function setReponse($reponse)
    {
        $this->_reponse = $reponse;
    }

    /**
     * Set the value of lu
     */ 
    public function setLu($lu)
    {
        $this->_lu = $lu;
    }

    /**
     * Set the value of repondu
     */ 
    public function setRepondu($repondu)
    {
        $this->_repondu = $repondu;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Get the value of id_utilisateur
     */ 
    public function getId_utilisateur()
    {
        return $this->_id_utilisateur;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * Get the value of reponse
     */ 
    public function getReponse()
    {
        return $this->_reponse;
    }

    /**
     * Get the value of lu
     */ 
    public function getLu()
    {
        return $this->_lu;
    }

    /**
     * Get the value of repondu
     */ 
    public function getRepondu()
    {
        return $this->_repondu;
    }
}