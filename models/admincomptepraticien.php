<?php

/**
 * Created by PhpStorm.
 * User: Noureddine
 * Date: 14/05/2017
 * Time: 12:04
 */
class AdminComptePraticien extends UserModel
{


    public function createCompteMedecin($user, $pass, $nom, $prenom, $dateNaissance, $idEtablissement, $numTel)
    {
        $db = $this->connection();
        if ($db != NULL) {
            $password = hash('sha256', $pass);
            $username = $this->check($user);
            $nom = $this->check($nom);
            $prenom = $this->check($prenom);
            $dateNaissance = $this->check($dateNaissance);
            //$idEtablissement=$this->check($idEtablissement);
            $numTel = $this->check($numTel);

            $starment = "SELECT id FROM medecin WHERE user='$user'";
            $res = $db->query($starment);
            if ($res->rowCount() <= 0) {
                $statment = "";

                $res = $db->query($starment);
                $db = NULL;
                if ($res->rowCount() > 0) {
                    return $res;
                } else {
                    return NULL;//Insertion Error
                }

            } else {
                return NULL; //Med existe
            }

        } else {
            return NULL;//CNX probleme
        }
    }
}