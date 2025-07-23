<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Grupo extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if(!isset($this->session->funcionario->nombre_completo))
        {
            redirect(site_url());
        }
    }


    public function index()
    {
        if(!isset($this->session->funcionario->nombre_completo))
        {
            redirect(site_url());
        }

        $select = "ROW_NUMBER() OVER (ORDER BY (SELECT NULL)) as row,nombre_grupo, descripcion, to_char(fecha_actualizacion,'DD \"de\" TMMonth \"del\" YYYY') as fecha_format, cod_grupo";
        $grupos = $this->main->getListSelect('grupo', $select, ['nombre_grupo' => 'ASC']);
        $data['grupos'] = json_encode($grupos);


        $this->load->view('normal/grupo/index', $data, FALSE);
    }

    public function registro()
    {
        if(!isset($this->session->funcionario->nombre_completo))
        {
            redirect(site_url());
        }
        mb_internal_encoding("UTF-8");

        $this->form_validation->set_rules('grupo', lang('nombre.grupo'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('codigo', lang('cod.grupo'), 'trim|required|mb_strtoupper|is_unique[grupo.cod_grupo]');
        $this->form_validation->set_rules('descripcion', lang('descripcion'), 'trim|required|mb_strtoupper');

        if ($this->form_validation->run()) {

            $nombre_usuario = $this->session->funcionario->nombre_completo;

            $registro['nombre_grupo'] = set_value('grupo');
            $registro['descripcion'] = set_value('descripcion');
            $registro['actualizado_por'] = $nombre_usuario;
            $registro['fecha_actualizacion'] = date('Y-m-d H:i:s');
            $registro['cod_grupo'] = set_value('codigo');
            $registro['ultima_propuesta'] = 0;
            $registro['id_estado'] = 1;

            $this->main->insert('grupo', $registro, 'grupo_id_grupo_seq');
            
            $this->session->set_flashdata('success', lang('grupo.correcto'));
        } 
        else
        {
            $this->session->set_flashdata('alert', validation_errors('<div class="error"><i class="las la-exclamation-triangle la-2x"></i>', '</div>'));

        }
        redirect('ver-grupos');
    }
}
    
    /* End of file Grupo.php */