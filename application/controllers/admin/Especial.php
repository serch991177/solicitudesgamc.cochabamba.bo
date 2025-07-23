<?php
   
   defined('BASEPATH') OR exit('No direct script access allowed');
   
   class Especial extends CI_Controller {
   
      
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
         
         $select = 'dni, nombre_rol, descripcion, id_especial, especial.id_estado';
         $dnis = $this->main->getListSelect('especial', $select, ['nombre_rol'=>'ASC'], null, null, null, ['rol'=>'id_rol', 'estado'=>'id_estado']);

         $data['dnis'] = json_encode($dnis);
         
         $this->load->view('administrador/especial/index', $data, FALSE);
      }


      public function registrar()
      {
         $roles = $this->main->getListSelect('rol', 'id_rol, nombre_rol', ['nombre_rol'=>'ASC']);
         $data['roles'] = $this->main->dropdown($roles, '');
         
         $this->load->view('administrador/especial/registrar', $data, FALSE);
      }

      public function guardar()
      {
         $this->form_validation->set_rules('dni', lang('dni'), 'trim|required|mb_strtoupper|callback_check_dni');
         $this->form_validation->set_rules('id_rol', lang('rol'), 'trim|required');

         if($this->form_validation->run())
         {
            $especial['id_rol'] = set_value('id_rol');
            $especial['dni']    = set_value('dni');

            $this->main->insert('especial', $especial );

            $this->session->set_flashdata('success', lang('registro.correcto'));

            redirect('dnis');
         }

         else
         {
            $this->session->set_flashdata('alert', validation_errors());

            redirect('registrar-dni');
         }

         
      }

      public function cambiar()
      {
         $id_especial = set_value('id_especial');
         $id_estado = set_value('id_estado');
         
         if($id_estado == 1)
         {
            $estado['id_estado'] = 2;

            $this->main->update('especial', $estado, ['id_especial'=>$id_especial]);
         }

         else
         {
            $estado['id_estado'] = 1;
            $this->main->update('especial', $estado, ['id_especial'=>$id_especial]);

         }

         redirect('dnis');
      }

      public function check_dni($dni)
      {
         

         $existe_registro = $this->main->get('especial', ['dni'=>$dni]);

         if($existe_registro)
         {
            $this->form_validation->set_message('check_dni', lang('existe.registro.igual'));
            return FALSE;
         }

         else
         {
            return TRUE;
         }
      }
   
   }
   
   /* End of file Controllername.php */
   