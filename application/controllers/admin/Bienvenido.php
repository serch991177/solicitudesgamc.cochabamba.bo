<?php

   defined('BASEPATH') OR exit('No direct script access allowed');

   class Bienvenido extends CI_Controller 
   {

      
      public function __construct()
      {
         parent::__construct();
         //Do your magic here

         if(!$this->session->funcionario)
            login();
      }
      

      public function index()
      {
         $data = [];
         
         $this->load->view('administrador/bienvenido/index', $data, FALSE);
         
      }

   }

/* End of file Controllername.php */
