<?php

class user
{

    //Propiétés
    private $_idprog;
    private $_IdUser;
    private $_Pseudo;
    private $_Mdp;
    
    //Construc

    public function __construct($Pseudo,$Mdp)
    {
    
        $this->_Pseudo = $Pseudo;
        $this->_Mdp = $Mdp; 
    }

    //Methodes

    public function getIdUser(){
        return $this->_IdUser;
    }
    
    public function getPseudo(){
        return $this->_Pseudo;
    }

    public function getMdp(){
        return $this->_Mdp;

    }

    public function ajouteidprog($idprog)
    {
        $this->_idprog=$idprog;
    }


    public function metenbase($bdd)
    {
        $id= $this->_idprog;
        $pseudo= $this->_Pseudo;
        $mdp= $this->_Mdp;

        $bdd->query('INSERT INTO user (id_programme,pseudo,motdepasse) VALUES ("'.$id.'","'.$pseudo.'","'.$mdp.'")');//insertion d'une nouvelle ligne dans la bdd
    }




}

?>