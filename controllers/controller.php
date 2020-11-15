<?php
/**
 * Created by PhpStorm.
 * User: Noureddine Metourni
 * Date: 14/01/2017
 * Time: 04:23
 */
class Controller {

	protected $_controller;//controller name
    protected $_model;
	protected $_action;//methode
	protected $_template;//View
    protected $_view;

	function __construct( $controller, $action) {

		$this->_controller = $controller;
		$this->_action = $action;
		$this->_view=0;
	}

	function set($name,$value) {
		$this->_template->set($name,$value);
	}

	function __destruct() {
        //if($this->_view==1)
          ///  $this->_template->render();
	}

    public function redirect($url){
        header('Location: ' . $url, false, 303);
        die();
    }

    public function view($controller,$action){
        if ($controller != null && $action != null){
            $this->_template = new Template($controller,$action);
            $this->_view=1;
        }
    }
    public function runView(){
        $this->_template->render();
    }

}
