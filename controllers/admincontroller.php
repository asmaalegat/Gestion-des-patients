<?php
/**
 * Created by PhpStorm.
 * User: Noureddine
 * Date: 24/05/2017
 * Time: 14:06
 */

class AdminController extends Controller
{
    protected $__ModelName ;

    public function main(){
        $this->set('assets','/projet1cs');
    }

    public function login(){
        $this->set('assets','/projet1cs');
    }


}