<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Login
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Login extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    
    mb_internal_encoding("UTF-8");
  }

  public function index()
  {
    $this->load->view('general/login/login');
  }
  

  public function iniciar_sesion()
  {
    $this->form_validation->set_rules('dni', lang('dni'), 'trim|required');
    $this->form_validation->set_rules('password', lang('password'), 'trim|required|md5');

    if($this->form_validation->run())
    {

        $usuario['dni'] = set_value('dni');
        $usuario['contrasenia'] = set_value('password');
        
        $usuario['editable'] = 'SI';

        $select = 'id_usuario, nombre_completo, dni, nombre_rol, descripcion_gestion, unidad_organizacional, cargo, nro_item, usuario.id_rol';
        $join   = ['persona'=>'id_persona', 'gestion'=>'id_gestion', 'rol'=>'id_rol' ];

        $existe_login = $this->main->getSelect('usuario', $select, $usuario, $join);
        
        if($existe_login)
        {
          $this->session->set_userdata('funcionario', $existe_login);
          $info['ip_ingreso'] = $this->input->ip_address();

          $this->main->update('usuario', $info, ['id_usuario'=>$existe_login->id_usuario]);

          redirect('bienvenido');
        }
	
	else
	{
	  redirect(site_url());
	}
    }

    else
    {
      redirect(site_url());
    }
  }


  public function registro()
  {
    mb_internal_encoding("UTF-8");

    $this->form_validation->set_rules('dni', lang('dni'), 'trim|required|mb_strtoupper|callback_dni_check');
    $this->form_validation->set_rules('nombre_completo', lang('nombre.completo'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('unidad_organizacional', lang('unidad.organizacional'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('cargo', lang('cargo'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('nro_item', lang('nro.item'), 'trim|required');
    $this->form_validation->set_rules('register_correo', lang('correo'), 'trim|required|mb_strtolower|valid_email');
    $this->form_validation->set_rules('register_password', lang('password'), 'trim|required|mb_strtoupper|md5');


    if($this->form_validation->run())
    {
      
      $usuario_especial = $this->main->get('especial', array('dni'=>set_value('dni'), 'id_estado'=>1));

      $id_rol = ($usuario_especial) ? $usuario_especial->id_rol : 2 ;

      $funciones = $this->main->getListSelect('por_defecto', 'id_accion, id_estado', ['id_accion'=>'ASC'], ['id_rol'=>$id_rol]);
      
      $persona_existe = $this->main->get('persona', ['dni'=>set_value('dni')]);
      $gestion_activa = $this->main->get('gestion', ['editable'=>'SI']);

      if(!$persona_existe)
      {
        $persona['dni'] = set_value('dni');
        $persona['nombre_completo'] = set_value('nombre_completo');
        $persona['fecha_registro'] = date('Y-m-d H:i:s');
        $persona['fecha_habilitacion'] = date('Y-m-d H:i:s');
        $persona['id_estado'] = 1;

        $id  = $this->main->insert('persona', $persona, 'persona_id_persona_seq');

      }

      else
      {
        $id = $persona_existe->id_persona;
      }
      
      $registro['id_persona'] = $id;
      $registro['id_gestion'] = $gestion_activa->id_gestion;
      $registro['id_rol'] = $id_rol;
      $registro['fecha_registro'] = date('Y-m-d H:i:s');
      $registro['unidad_organizacional'] = set_value('unidad_organizacional');
      $registro['cargo'] = set_value('cargo');
      $registro['nro_item'] = set_value('nro_item');
      $registro['correo_municipal'] = set_value('register_correo');
      $registro['contrasenia'] = set_value('register_password');

      $id_usuario = $this->main->insert('usuario', $registro, 'usuario_id_usuario_seq');

     


      $menu = [];

      foreach ($funciones as $funcion) 
      {
        $dato['id_accion'] = $funcion->id_accion;
        $dato['id_estado'] = $funcion->id_estado;
        $dato['id_usuario'] = $id_usuario;

        array_push($menu, $dato);
      }

      $this->db->insert_batch('menu', $menu);
      $this->session->set_flashdata('success', lang('registro.correcto'));
    }

    else
    {
      
      $this->session->set_flashdata('alert', validation_errors());
       
    }

    redirect(site_url());
    
  }


  public function dni_check($dni)
  {
    
    $existe_usuario = $this->main->get('usuario', ['dni'=>$dni, 'editable'=>'AB'], ['persona'=>'id_persona', 'gestion'=>'id_gestion']);
    
    if ($existe_usuario)
    {
      $this->form_validation->set_message('dni_check', lang('existe.usuario'));
      return FALSE;
    }

    else
    {
      return TRUE;
    }
  }

  public function logout()
  {
    $this->session->userdata = Array();
    $this->session->sess_destroy();
    $this->session->unset_userdata('sistema');
    redirect(site_url(),'refresh');
  }

}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */