<?php
namespace controller;

use model\utlisateurs;
use model\UtilisateurManager;


class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function defaultAction()
    {
       $data=[];
       $this->render("Connection", $data); 
    }
}