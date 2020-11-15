<?php

/**
 * Created by PhpStorm.
 * User: Noureddine
 * Date: 08/06/2017
 * Time: 14:48
 */
class AdminCmptMinistreController extends Controller
{

    function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->_model = new AdminCmptMinistreModel();
    }


    public function index()
    {
        /*Afficher le login */
        session_start();

        if(isset($_SESSION['auth'])){
            if ($_SESSION['auth'] === 'auth') {
                $this->view($this->_controller,$this->_action);
                $this->set('page', 'main');
                $this->set('assets', ASSETS);
                $this->runView();
            } else {
                session_destroy();
                $this->view($this->_controller,$this->_action);
                $this->set('page', 'login');
                $this->set('assets', ASSETS);
                $this->runView();
            }
        }else{
            $this->view($this->_controller,$this->_action);
            $this->set('page', 'login');
            $this->set('assets', ASSETS);
            $this->runView();
        }


    }

    public function logout()
    {
        session_unset();
        session_destroy();
        $this->view($this->_controller,$this->_action);
        $this->set('page', 'login');
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
            $url = ASSETS.'/admincmptministre/index';
            $this->redirect($url);
        }

    }

    public function login()
    {
        session_start();
        $this->view($this->_controller,$this->_action);
        $this->set('page', 'login');
        $this->set('assets', ASSETS);


        if ($_SESSION['auth'] === 'auth') {
            $url = ASSETS.'/admincmptministre/index';
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
                        $url = ASSETS.'/admincmptministre/index';
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