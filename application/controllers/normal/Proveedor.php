<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Proveedor extends CI_Controller
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
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }
        $select = "ROW_NUMBER() OVER (ORDER BY (SELECT NULL)) as row, nombre_completo, nit, correo_electronico,
            direccion, celular, representante, nro_rupe, id_estado,to_char(fecha_registro,'DD \"de\" TMMonth \"del\" YYYY') as fecha_format";
        $proveedores = $this->main->getListSelect('proveedor', $select, ['nombre_completo' => 'ASC']);
        $data['proveedores'] = json_encode($proveedores);


        $this->load->view('normal/proveedor/index', $data, FALSE);
    }
    public function listado()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }
        $select = "id_proveedor, nombre_completo, nit, correo_electronico, ROW_NUMBER() OVER (ORDER BY (SELECT NULL)) as row,
            direccion, celular, representante, rubro, id_estado,to_char(fecha_registro,'DD \"de\" TMMonth \"del\" YYYY') as fecha_format";
        $proveedores = $this->main->getListSelect('proveedor', $select, ['nombre_completo' => 'ASC']);
        $data['proveedores'] = json_encode($proveedores);


        $this->load->view('normal/proveedor/listado', $data, FALSE);
    }
    public function notificacion()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }
        $data['registro'] = $this->main->getListSelect('proveedor', "nombre_completo, correo_electronico");

        $this->load->library('email');

        /* $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'tcp://192.168.104.24';
        $config['smtp_port']    = '25';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'info@cochabamba.bo';
        $config['smtp_pass']    = 'temporal.1';
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['mailtype']   = 'html';
        $config['validation']   = FALSE; */
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'smtp.googlemail.com';
        $config['smtp_port']    = '465';
        $config['smtp_crypto'] = 'ssl';  // this is based on your smtp port -> ssl/tls
        $config['smtp_timeout'] = "400";
        $config['smtp_user']    = 'gamcb.cochabamba@gmail.com';
        $config['smtp_pass']    = 'wbemusizvchwtfxr';
        $config['charset']      = 'utf-8';
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['mailtype']     = 'html';
        $config['validate']   = true;

        $arraycorreos = [];

        foreach ($data['registro'] as $key => $value) {
            array_push($arraycorreos, $value->correo_electronico);
        }

        $this->email->initialize($config);


        //$this->email->from('info@cochabamba.bo', 'Info');
        $this->email->to('gamcb.cochabamba@gmail.com', 'Sistema Proveedores GAMC');
        $this->email->bcc(implode(', ', $arraycorreos));

        $this->email->subject('Nuevos Bienes y Servicios son Requeridos');

        $this->email->message($this->load->view('normal/proveedor/notificacion', $data, TRUE));

        if ($this->email->send()) {
            $this->session->set_flashdata('success', lang('notificacion.exitosa'));
        } else {
            $this->session->set_flashdata('alert', 'No se ha enviado las notificaciones');
        }

        redirect('ver-items');
    }
    public function personal()
    {
        $id_proveedor = set_value('proveedor');

        $select = "nombre_completo, nit, correo_electronico, direccion, celular, representante, nro_rupe, rubro, latitud, longitud, file_nit, file_rupe, file_poder";

        $data['proveedor'] = $this->main->getSelect('proveedor', $select, ['id_proveedor' => $id_proveedor, 'id_estado' => 1]);

        $this->load->view('normal/proveedor/personal', $data);
    }
}
