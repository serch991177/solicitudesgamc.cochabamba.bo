<?php 
   
   defined('BASEPATH') OR exit('No direct script access allowed');
   
   class Rol extends CI_Controller {
   
      
      public function __construct()
      {
         parent::__construct();
         //Do your magic here

         mb_internal_encoding("UTF-8");
         if(!$this->session->funcionario)
            login();
      }
      
      
      public function index()
      {
         $data = [];

         $roles = $this->main->getListSelect('rol', 'rol.*', ['nombre_rol'=>'ASC']);

         $data['roles'] = json_encode($roles);
         
         $this->load->view('administrador/rol/index', $data, FALSE);
      }

      public function registrar()
      {
         $data = [];

         $this->load->view('administrador/rol/registrar', $data, FALSE);
      }

      public function guardar()
      {
         $this->form_validation->set_rules('rol', lang('rol'), 'trim|required|mb_strtoupper|is_unique[rol.nombre_rol]');

         
         if ($this->form_validation->run()) 
         {
            $rol['nombre_rol'] = set_value('rol');

            $id_rol = $this->main->insert('rol', $rol, 'rol_id_rol_seq');


            $funciones = $this->main->getListSelect('accion', 'id_accion');

            $por_defecto = [];
            
            foreach ($funciones as $funcion) 
            {
               $dato['id_accion'] = $funcion->id_accion;
               $dato['id_rol'] = $id_rol;
               $dato['id_estado'] = 2;

               array_push($por_defecto, $dato);
            }

            $this->db->insert_batch('por_defecto', $por_defecto);
            

            $this->session->set_flashdata('success', lang('registro.correcto'));

            redirect('roles');
         } 
         
         else 
         {
            $this->session->set_flashdata('alert', validation_errors());

            redirect('registrar-rol');
         }
      }

      public function cambiar()
      {
         $id_rol = set_value('id_rol');
         $id_estado = set_value('id_estado');

         $estado['id_estado'] = ($id_estado == 1) ? 2 : 1 ;

         $this->main->update('rol', $estado, ['id_rol'=>$id_rol]);

         redirect('roles');
      }
   
   }
   
   /* End of file Rol.php */
   