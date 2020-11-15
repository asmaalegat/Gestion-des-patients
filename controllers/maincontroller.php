<?php

/**
 * Created by PhpStorm.
 * User: Noureddine
 * Date: 14/05/2017
 * Time: 17:18
 */
class MainController extends Controller
{
    //protected $__ModelName ;

    public function main(){

        $this->set('title','Home Page2');
        $this->set('jumbo','Hello mr : ');
    }


}