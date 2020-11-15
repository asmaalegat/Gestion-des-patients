<?php

/**
 * Created by PhpStorm.
 * User: Noureddine
 * Date: 08/06/2017
 * Time: 14:48
 */
class DoctorController extends Controller
{

    function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->_model = new DoctorModel();
    }


    public function index()
    {

        session_start();

        if(isset($_SESSION['auth'])){
            if ($_SESSION['auth'] === 'auth') {
                $this->view($this->_controller,$this->_action);
                $this->set('assets', ASSETS);
                $this->runView();
            } else {
                session_destroy();
                $this->view($this->_controller,'login');
                $this->set('assets', ASSETS);
                $this->runView();
            }
        }else{
            $this->view($this->_controller,'login');
            $this->set('assets', ASSETS);
            $this->runView();
        }
    }

    public function profile(){
        $this->view($this->_controller, 'page-user');
        $this->set('assets', ASSETS);
        $this->runView();

    }

    public function listpat(){
        //$this->_model->
        $res=$this->_model->gatAllPat(1);
        //print_r('hola');
        $this->view($this->_controller, 'list-pat');
        $this->set('assets', ASSETS);
        $this->set('list',$res);
        $this->runView();
    }

    public function editord(){
        //$patient
        $this->view($this->_controller, 'page-Modifier-Ordonance');
        $this->set('assets', ASSETS);
        $this->runView();
    }

    public function creatord(){
        //$patient
        $this->view($this->_controller, 'page-Cree-ordonance');
        $this->set('assets', ASSETS);
        $this->runView();
    }
    public function map(){
        //$patient
        $this->view($this->_controller, 'page-Map');
        $this->set('assets', ASSETS);
        $this->runView();
    }
    public function rdv(){
        //$patient
        $this->view($this->_controller, 'page-calendar');
        $this->set('assets', ASSETS);
        $this->runView();
    }


    public function logout()
    {
        session_unset();
        session_destroy();
        $this->view($this->_controller, 'login');
        $this->set('assets', ASSETS);
        $this->runView();
    }

    public function addcmpt()
    {
        $this->set('assets', ASSETS);

        if ($_SESSION['auth'] === 'auth') {
            $this->set('page', 'main');
            if (isset($_POST['add'])) {
                if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['location'])) {
                    $email = $_POST['email'];
                    $pass = $_POST['password'];
                    $location = $_POST['location'];
                    $res = $this->_model->addUser($email, $pass, $location);
                    if ($res) {
                        $this->set('success', ' utilisateur a ete ajoute');
                    } else {

                    }

                } else {
                    $this->set('error', 'vérifier votre formulaire');
                }

            } else {

            }

        } else {
            $url = ASSETS . '/doctor/index';
            $this->redirect($url);
        }

    }

    public function login()
    {
        session_start();
        $this->view($this->_controller, $this->_action);
        $this->set('assets', ASSETS);


        if ($_SESSION['auth'] === 'auth') {
            $url = ASSETS . '/doctor/index';
            $this->redirect($url);
        } else {
            if (isset($_POST['Sign-In'])) {
                if (isset($_POST['password']) && isset($_POST['email'])) {

                    $mail = $_POST['email'];
                    $pass = $_POST['password'];
                    $res = $this->_model->login($mail, $pass);
                    //$res =true;
                    if ($res) {
                        $_SESSION['auth'] = 'auth';
                        $url = ASSETS . '/doctor/index';
                        //$time = time() + 60*60*24*1000;
                        //setcookie('Metou', $res['id'], $time);
                        $this->redirect($url);
                    } else {
                        $this->set('error', 'Compte ' . $mail . ' n\'existe pas.');
                    }
                } else {
                    $this->set('error', 'vérifier votre formulaire');
                }
            } else {
                /* Page login normal*/
            }
            $this->runView();
        }

    }


}