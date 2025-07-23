<?php
   
   defined('BASEPATH') OR exit('No direct script access allowed');
   
   class Gestion extends CI_Controller {


      
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
         $gestiones = $this->main->getListSelect('gestion', 'gestion.*', ['descripcion_gestion'=>'DESC']);

         $data['gestiones'] = json_encode($gestiones);
         
         $this->load->view('administrador/gestion/index', $data, FALSE);
      }

      public function registrar()
      {
         
         $data = [];
         
         $this->load->view('administrador/gestion/registrar', $data, FALSE);
      }

      public function guardar()
      {
            $this->form_validation->set_rules('gestion', lang('gestion'), 'trim|required|is_natural|exact_length[4]|is_unique[gestion.descripcion_gestion]');
            $this->form_validation->set_rules('nombre_alcalde', lang('nombre.alcalde'), 'trim|required|mb_strtoupper');
            $this->form_validation->set_rules('cargo_alcalde', lang('cargo.alcalde'), 'trim|required|mb_strtoupper');

            if($this->form_validation->run())
            {
               $guardar['descripcion_gestion'] = set_value('gestion');
               $guardar['nombre_alcalde'] = set_value('nombre_alcalde');
               $guardar['cargo_alcalde'] = set_value('cargo_alcalde');
               $guardar['editable'] = 'SI';

               $this->main->insert('gestion', $guardar);

               $this->session->set_flashdata('success', lang('registro.correcto'));

               redirect('admin-detalle-gestion');
            }
   
            else
            {
               $this->session->set_flashdata('alert', validation_errors());
   
               redirect('admin-registrar-gestion');
            }
      }

      public function cambiar()
      {
         $id_gestion = set_value('id_gestion');
         $editable = set_value('editable');
         
         if($editable == 'SI')
         {
            $estado['editable'] = 'NO';

            $this->main->update('gestion', $estado, ['id_gestion'=>$id_gestion]);
         }

         else
         {
            $estado['editable'] = 'SI';
            $this->main->update('gestion', $estado, ['id_gestion'=>$id_gestion]);

         }

         redirect('admin-detalle-gestion');
      }
   
   }
   
   /* End of file Controllername.php */
   