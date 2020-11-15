<?php
/**
 * Created by PhpStorm.
 * User: Noureddine
 * Date: 14/05/2017
 * Time: 10:39
 */
class Model {

    protected $_modelName;
    protected $_cnx;

    protected $host = "localhost";
    protected $user = "root";
    protected $pass = "root";
    protected $dbname = "projet";
    protected $port = "8889";

    //protected $db;

    public function __construct()
    {

    }

    protected function connection(){
        //$db = new PDO($host,$db,$user,$pass);
        /*
        try{
            $db = new PDO('host='.$this->host.';dbname='.$this->dbname.';charset=UTF-8', $this->user, $this->pass);
        }catch (Exception $exception){
            $db = NULL;
        }

        return $db;
        */

        try{
            $cnx = @mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
        }catch (Exception $exception ){

        }

        if($cnx==false){
            return false;
        }else{
            $this->_cnx=$cnx;
            return true;
        }
    }

    /**
     * @return string
     */
    protected function close(){
        $this->_cnx->close();
    }

    protected function check($string){
        $string = strip_tags($string);
        $string = trim($string);
        $string = stripslashes($string);
        //$string = htmlspecialchars($string, ENT_QUOTES);
        $string = $this->_cnx->real_escape_string($string);
        return $string;
    }





}





?>
