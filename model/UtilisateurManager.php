<?php
namespace model;

use model\Utilisateurs;
use PDO;

class UtilisateurManager extends Manager
{
    public $_userData,
           $_statut;

    /**
     * create user
     * @param Utilisateurs $user
     * @return void
     */
    public function add(Utilisateurs $user)
    {
        $q=$this->manager
                ->db
                ->prepare('INSERT INTO utilisateurs (nom,prenom, mail,login,password, observation, newletter) 
                        VALUES(:nom, :prenom, :mail, :login, :password, :observation, :newletter)');
        $user=$q->execute([
          ':nom'           => $user->getNom(),
          ':prenom'        => $user->getPrenom(),
          ':mail'          => $user->getMail(),         
          ':login'         => $user->getLogin(),
          ':password'      => $user->getPassword(),
          ':observation'   => $user->getObservation(),
          ':newletter'     => $user->getNewletter(),
        ]);
             
    }

    /**
     * recover user by login
     * @param mixed $login
     * @return list(informations of user)
     */
    public function getUsers($login)
    {
        $q=$this->manager
                ->db
                ->prepare('SELECT * FROM utilisateurs WHERE login=:login');
        $q->bindValue("login",$login, PDO::PARAM_STR_CHAR);
        $q->execute([
            'login'     =>$login
        ]);
        
        $userData = $q->fetch(PDO::FETCH_ASSOC);
        return $userData;
        
    }

      /**
       * remote number of user whith login
       * @param string $login
       * @return int
       */

    public function getUsersNb($login)
    {
        $re=$this->manager
                  ->db
                  ->prepare('SELECT * FROM utilisateurs WHERE login=:login');
        $re->bindValue("login",$login, PDO::PARAM_STR_CHAR);
        $re->execute([
            'login'     =>$login
        ]);
        $conteur = $re->rowCount();
        return $conteur;
    }

    public function getAllUser()
    {
        
        $q = $this->manager
                  ->db
                  ->prepare( 'SELECT * FROM utilisateurs' );
        $q->execute();
        $listRes = $q->fetchAll(PDO::FETCH_ASSOC);
 
        return $listRes;
    }

    public function update(Utilisateurs $user)
    {
      $q = $this->manager
                  ->db
                  ->prepare('UPDATE utilisateurs SET
                        active = 1
                        WHERE id = :id');
      return $q->execute([
        ':id'           => $user->getId(),
      ]);
    }
    public function updateNA(Utilisateurs $user)
    {
      $q = $this->manager
                  ->db
                  ->prepare('UPDATE utilisateurs SET
                        active = 0
                        WHERE id = :id');
      return $q->execute([
        ':id'           => $user->getId(),
      ]);
    }

    public function updateUser(Utilisateurs $user)
    {
      $q = $this->manager
                  ->db
                  ->prepare('UPDATE utilisateurs SET
                             nom = :nom, prenom = :pernom, mail=:mail, login=:login, password=:password, observation=:observation 
                              WHERE id = :id');
      return $q->execute([
        ':id'            => $user->getId(),
        ':nom'           => $user->getNom(),
        ':prenom'        => $user->getPrenom(),
        ':mail'          => $user->getMail(),         
        ':login'         => $user->getLogin(),
        ':password'      => $user->getPassword(),
        ':observation'   => $user->getObservation(),

      ]);
    }

    public function delete(Utilisateurs $user)
    {
      $q = $this->manager
                  ->db
                  ->prepare('DELETE FROM utilisateurs WHERE id = :id');
      return $q->execute([
        ':id'           => $user->getId(),
      ]);
    }


    public function get($info)
    {
      if (is_int($info))
      {
      /* $q = $this->_db->query('SELECT id, nom, degats FROM personnages WHERE id = '.$info);*/
        $q = $this->manager
                  ->db
                  ->prepare('SELECT * FROM utilisateurs WHERE id = :id' );
        $q->execute(['id' => $info]);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Utilisateurs($donnees);
      }
      else
      {}
    }
    public function getAllUsersWithout($info)
    {
      if (is_int($info))
      {
      /* $q = $this->_db->query('SELECT id, nom, degats FROM personnages WHERE id = '.$info);*/
        $q = $this->manager
                  ->db
                  ->prepare('SELECT * FROM utilisateurs WHERE id <> :id' );
        $q->execute([':id' => $info]);
        $donnees = $q->fetchAll(PDO::FETCH_ASSOC);
        return $donnees;
      }
      else
      {}
    }

    public function verifyMailLogin($email,$login)
    {
      $q=$this->manager
                ->db
                ->prepare('SELECT * FROM utilisateurs WHERE login=:login AND mail=:mail');
      $q->bindValue("login",$login, PDO::PARAM_STR_CHAR);
      $q->execute([
          'login'     =>$login,
          'mail'      =>$email,
      ]);
        
      $userData = $q->fetch(PDO::FETCH_ASSOC);
      return $userData;
    }
}