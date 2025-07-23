<?php

   defined('BASEPATH') OR exit('No direct script access allowed');
   
   class Usuario extends CI_Controller {
   
      
      public function __construct()
      {
         parent::__construct();
         //Do your magic here

         mb_internal_encoding("UTF-8");
         if(!$this->session->funcionario)
            login();
      }
      
      
      /**
       * Listado de Usuarios Registrados de la presente Gestion
       *
       * @return void
       */
      public function index()
      {

         $select = 'id_usuario, nombre_completo, dni, unidad_organizacional, cargo, nro_item, correo_municipal, nombre_rol';
         $usuarios = $this->main->getListSelect('usuario', $select, ['nombre_completo'=>'DESC'], ['editable'=>'SI'], null, null, ['persona'=>'id_persona', 'gestion'=>'id_gestion', 'rol'=>'id_rol']);
         $data['usuarios'] = json_encode($usuarios);
         
         $this->load->view('administrador/usuario/index', $data, FALSE);
      }


      public function funciones($id)
      {
         $select = 'id_menu, menu.id_estado, id_usuario, nombre_accion,ruta_amigable, icon, descripcion';
         $where = ['id_usuario'=>$id];
         $join = ['accion'=>'id_accion', 'estado'=>'id_estado'];
         $funciones = $this->main->getListSelect('menu', $select, ['id_menu'=>'ASC'], $where, null, null, $join);

         $data['funciones'] = json_encode($funciones);
         $data['id'] = $id;

         $this->load->view('administrador/usuario/funciones', $data, FALSE);
         
      }

      public function cambiar_estado()
      {
         $id_menu = set_value('id_menu');
         $id_estado = set_value('id_estado');
         $id_usuario = set_value('id_usuario');


         if($id_estado == 1)
         {
            $estado['id_estado'] = 2;

            $this->main->update('menu', $estado, ['id_menu'=>$id_menu]);
         }

         else
         {
            $estado['id_estado'] = 1;
            $this->main->update('menu', $estado, ['id_menu'=>$id_menu]);

         }

         redirect('funciones-usuario/'.$id_usuario);
      }
   
   }
   
   /* End of file Controllername.php */
   