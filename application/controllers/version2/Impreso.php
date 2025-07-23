<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Impreso extends CI_Controller
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
    }

    public function propuestas()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }
        $id = $this->input->post('item');

        $data['item'] = $this->main->getSelect('item', "nombre_item, CONCAT(cod_grupo, '-', LPAD(nro_solicitud::text, 4, '0') ) AS codigo, item.descripcion, unidad_medida, cantidad,procedencia, tiempo_entrega, forma_entrega, validez, fecha_limite", ['id_item' => $id, 'estado' => 'PUBLICADO'], ['grupo' => 'id_grupo']);

        $data['propuestas'] = $this->main->getListSelect('propuesta', "ROW_NUMBER() OVER (ORDER BY (SELECT NULL)) as row,  id_item, precio_propuesto, file_cotizacion, nombre_completo, descripcion_propuesta,to_char(propuesta.fecha_registro,'DD \"de\" TMMonth \"del\" YYYY \"hrs.:\" HH24:MI') as fecha_format, proveedor.celular, proveedor.correo_electronico", ['row' => 'codigo'], ['id_item' => $id, 'publicado' => 'SI'], null, null, ['proveedor' => 'id_proveedor']);


        $this->load->view('version2/impresos/propuestas', $data, FALSE);
    }
    public function proveedor()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }

        $id = $this->input->post('item');
        $proveedor = $this->input->post('proveedor');
        $id_propuesta = $this->input->post('propuesta');

        $data['item'] = $this->main->getSelect('item', "nombre_item, CONCAT(cod_grupo, '-', LPAD(nro_solicitud::text, 4, '0') ) AS codigo, item.descripcion, unidad_medida, cantidad,procedencia, tiempo_entrega, forma_entrega, validez, fecha_limite", ['id_item' => $id, 'estado' => 'PUBLICADO'], ['grupo' => 'id_grupo']);

        $data['propuesta'] = $this->main->getSelect('propuesta', "id_item, precio_propuesto, file_cotizacion, nombre_completo, descripcion_propuesta,to_char(propuesta.fecha_registro,'DD \"de\" TMMonth \"del\" YYYY \"hrs.:\" HH24:MI') as fecha_format, proveedor.celular, proveedor.correo_electronico, proveedor.nit, proveedor.representante", ['id_item' => $id, 'proveedor.id_proveedor' => $proveedor, 'publicado' => 'SI'], ['proveedor' => 'id_proveedor']);

        $select = "caracteristica.id_caracteristica, descripcion, caracteristica_detalle, detalle";
        $data['caracteristicas'] = $this->main->getListSelect('caracteristica', $select, ['caracteristica.id_caracteristica' => 'ASC'], ['caracteristica.id_item' => $id, 'caracteristica_propuesta.id_propuesta' => $id_propuesta], null, null, ['caracteristica_propuesta' => 'id_caracteristica']);

        $this->load->view('version2/impresos/proveedor', $data, FALSE);
    }
}
    
    /* End of file Impreso.php */
