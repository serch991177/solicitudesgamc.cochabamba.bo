<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reporte extends CI_Controller
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


        $this->load->view('normal/reporte/propuestas', $data, FALSE);
    }
    public function proveedor()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }

        $id = $this->input->post('item');
        $proveedor = $this->input->post('proveedor');

        $data['item'] = $this->main->getSelect('item', "nombre_item, CONCAT(cod_grupo, '-', LPAD(nro_solicitud::text, 4, '0') ) AS codigo, item.descripcion, unidad_medida, cantidad,procedencia, tiempo_entrega, forma_entrega, validez, fecha_limite", ['id_item' => $id, 'estado' => 'PUBLICADO'], ['grupo' => 'id_grupo']);

        $data['propuesta'] = $this->main->getSelect('propuesta', "id_item, precio_propuesto, file_cotizacion, nombre_completo, descripcion_propuesta,to_char(propuesta.fecha_registro,'DD \"de\" TMMonth \"del\" YYYY \"hrs.:\" HH24:MI') as fecha_format, proveedor.celular, proveedor.correo_electronico, proveedor.nit, proveedor.representante", ['id_item' => $id, 'proveedor.id_proveedor' => $proveedor, 'publicado' => 'SI'], ['proveedor' => 'id_proveedor']);


        $this->load->view('normal/reporte/proveedor', $data, FALSE);
    }
    public function general()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }
        $grupos = $this->main->getListSelect('grupo', 'id_grupo, nombre_grupo', ['nombre_grupo' => 'ASC']);
        $data['grupos'] = $this->main->dropdown($grupos, 'TODOS LOS GRUPOS');

        $this->db->join('propuesta', 'propuesta.id_item = item.id_item', 'left outer');

        $items = $this->main->getListSelect('item', "ROW_NUMBER() OVER (ORDER BY cod_grupo) as row, CONCAT(cod_grupo, '-', LPAD(nro_solicitud::text, 4, '0') ) AS codigo, item.id_item, cantidad, nombre_item, unidad_medida, count(id_proveedor) as proponentes, to_char(fecha_publicacion, 'DD TMMonth YYYY') as publicacion, to_char(fecha_limite, 'DD TMMonth YYYY') as limite, fecha_limite", ['row' => 'codigo'], ['estado' => 'PUBLICADO'], null, null, ['grupo' => 'id_grupo'], 'codigo, item.id_item, cod_grupo');

        $data['items'] = json_encode($items);

        $this->load->view('normal/reporte/general', $data, FALSE);
    }
    public function todos_propuestas()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }
        $select = "ROW_NUMBER() OVER (ORDER BY (SELECT NULL)) as row, CONCAT(cod_grupo, '-', LPAD(nro_solicitud::text, 4, '0') ) AS codigo, 
            cantidad, nombre_item, unidad_medida, propuestas, precios, to_char(fecha_publicacion, 'DD TMMonth YYYY') as publicacion,
            to_char(fecha_limite, 'DD TMMonth YYYY') as limite";

        $query = "(SELECT id_item, count(id_proveedor) as propuestas, STRING_AGG(cast(precio_propuesto as VARCHAR(10)),' - ') as precios
            FROM propuesta GROUP BY propuesta.id_item)precio";

        $join   = ['item' => 'id_item', 'grupo' => 'id_grupo'];

        $where['estado'] = 'PUBLICADO';


        $items = $this->main->consultaAnidada($select, 'precio', $query, $join, $where, ['codigo' => 'ASC']);
        $data['items'] = json_encode($items);

        $this->load->view('normal/reporte/total', $data, FALSE);
    }
    public function filtros()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }
        $where = "estado = 'PUBLICADO' ";
        $date = date('Y-m-d');

        $grupo = set_value('grupo');
        $inicial = set_value('inicial');
        $final = set_value('final');
        $estado = set_value('estado');

        if ($grupo != '') {
            $where = $where . ' AND item.id_grupo = ' . $grupo;
        }
        if ($inicial != '' && $final != '') {
            $where = $where . " AND fecha_publicacion BETWEEN '" . $inicial . "' AND '" . $final . "'";
        }
        if ($estado != '') {

            if ($estado == 'ACTIVOS') {
                $where = $where . " AND fecha_limite >= '" . $date . "'";
            } else {
                $where = $where . " AND fecha_limite < '" . $date . "'";
            }
        }

        $select = "ROW_NUMBER() OVER (ORDER BY cod_grupo) as row, CONCAT(cod_grupo, '-', LPAD(nro_solicitud::text, 4, '0') ) AS codigo, item.id_item, cantidad, nombre_item, unidad_medida, count(id_proveedor) as proponentes, to_char(fecha_publicacion, 'DD TMMonth YYYY') as publicacion, to_char(fecha_limite, 'DD TMMonth YYYY') as limite, fecha_limite";

        $this->db->join('propuesta', 'propuesta.id_item = item.id_item', 'left outer');


        $reporte = $this->main->getListSelect('item', $select, ['codigo' => 'ASC', 'publicacion' => 'ASC'], $where, null, null, ['grupo' => 'id_grupo'], 'codigo, item.id_item, cod_grupo');
        $data['resultado'] = json_encode($reporte);

        echo $data['resultado'];
    }
    public function imprimir_general()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }
        $where = "estado = 'PUBLICADO' ";
        $date = date('Y-m-d');

        $grupo = set_value('grupo');
        $inicial = set_value('fecha_publicacion_submit');
        $final = set_value('fecha_limite_submit');
        $publi = set_value('fecha_publicacion');
        $limite = set_value('fecha_limite');
        $estado = set_value('estado');

        if ($grupo != '') {
            $where = $where . ' AND item.id_grupo = ' . $grupo;
            $data['grupo'] = $this->main->get('grupo', ['id_grupo' => $grupo]);
        }
        if ($inicial != '' && $final != '') {
            $where = $where . " AND fecha_publicacion BETWEEN '" . $inicial . "' AND '" . $final . "'";
        }
        if ($estado != '') {

            if ($estado == 'ACTIVOS') {
                $where = $where . " AND fecha_limite >= '" . $date . "'";
            } else {
                $where = $where . " AND fecha_limite < '" . $date . "'";
            }
        }

        $select = "ROW_NUMBER() OVER (ORDER BY cod_grupo) as row, CONCAT(cod_grupo, '-', LPAD(nro_solicitud::text, 4, '0') ) AS codigo, item.id_item, cantidad, nombre_item, unidad_medida, count(id_proveedor) as proponentes, to_char(fecha_publicacion, 'DD TMMonth YYYY') as publicacion, to_char(fecha_limite, 'DD TMMonth YYYY') as limite, fecha_limite";

        $this->db->join('propuesta', 'propuesta.id_item = item.id_item', 'left outer');


        $reporte = $this->main->getListSelect('item', $select, ['codigo' => 'ASC'], $where, null, null, ['grupo' => 'id_grupo'], 'codigo, item.id_item, cod_grupo');
        $data['reporte'] = $reporte;

        $data['inicial'] = $publi;
        $data['final'] = $limite;
        $data['estado'] = $estado;
        $this->load->view('normal/reporte/imprimir', $data, FALSE);
    }
}
    
    /* End of file Reporte.php */
