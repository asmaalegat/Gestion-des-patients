<?php

/**
 * Created by PhpStorm.
 * User: Noureddine
 * Date: 14/05/2017
 * Time: 11:28
 */
class AdminCmptMinistreModel extends Model
{


    public function login($user, $pass)
    {

        $db = $this::connection();
        if ($db!=NULL) {
            $username = $this->check($user);
            $password = hash('sha256', $pass);
            $statment = "SELECT * FROM AdminCmptMinistre WHERE username ='$username' AND password = '$password'";
            $res = $db->query($statment);
            $db = NULL;
            if ($res->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function addUser($user,$pass,$locaion){
        $db = $this::connection();
        if ($db!=NULL) {
            $username = $this->check($user);
            $etablissement = $locaion;
            $password = hash('sha256', $pass);
            $statment = "INSERT INTO AdminCmptHopital(id,user,pass,idEtablissement) VALUES (NULL,'$username','$password','$etablissement')";
            $res = $db->query($statment);
            $db = NULL;
            if ($res->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }

    }

}