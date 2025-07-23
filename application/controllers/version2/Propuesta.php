<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Propuesta extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here     
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }
    }


    public function index()
    {
        if ($this->input->post('id_item')) {
            $this->db->where('item.id_item', $this->input->post('item'));
        }

        $id = $this->input->post('item');

        $data['item'] = $this->main->getSelect('item', "id_item, nombre_item, CONCAT(cod_grupo, '-', LPAD(nro_solicitud::text, 4, '0') ) AS codigo, item.descripcion, unidad_medida, cantidad,procedencia, tiempo_entrega, forma_entrega, validez, fecha_limite, propuesta_adjudicada, to_char(fecha_adjudicacion,'DD \"de\" TMMonth \"del\" YYYY') as fecha_adj, adj_file1, adj_file2, adj_file3, informacion", ['id_item' => $id, 'estado' => 'PUBLICADO'], ['grupo' => 'id_grupo']);

        $select = "id_caracteristica, descripcion, caracteristica_detalle";
        $data['caracteristicas'] = $this->main->getListSelect('caracteristica', $select, ['caracteristica.id_caracteristica' => 'ASC'], ['caracteristica.id_item' => $id]);

        $propuestas = $this->main->getListSelect('propuesta', "ROW_NUMBER() OVER (ORDER BY (SELECT NULL)) as row, id_propuesta, id_item, precio_propuesto, file_cotizacion, nombre_completo, proveedor.id_proveedor, descripcion_propuesta,to_char(propuesta.fecha_registro,'DD \"de\" TMMonth \"del\" YYYY') as fecha_format, proveedor.celular", ['row' => 'codigo'], ['id_item' => $id, 'publicado' => 'SI'], null, null, ['proveedor' => 'id_proveedor']);

        $data['propuestas'] = json_encode($propuestas);

        $this->load->view('version2/propuesta/detalle', $data, FALSE);
    }

    public function propuesta()
    {

        if ($this->input->post('id_item')) {
            $this->db->where('item.id_item', $this->input->post('item'));
        }

        $id = $this->input->post('item');
        $id_propuesta = $this->input->post('propuesta');
        $id_proveedor = $this->input->post('proveedor');

        $data['item'] = $this->main->getSelect('item', "nombre_item, CONCAT(cod_grupo, '-', LPAD(nro_solicitud::text, 4, '0') ) AS codigo, item.descripcion, unidad_medida, cantidad,procedencia, tiempo_entrega, forma_entrega, validez, fecha_limite, informacion", ['id_item' => $id, 'estado' => 'PUBLICADO'], ['grupo' => 'id_grupo']);

        $data['propuesta'] = $this->main->getSelect('propuesta', "id_item, precio_propuesto, file_cotizacion, descripcion_propuesta,to_char(propuesta.fecha_registro,'DD \"de\" TMMonth \"del\" YYYY \"hrs.:\" HH24:MI') as fecha_format, proveedor.nombre_completo, proveedor.celular", ['id_item' => $id, 'proveedor.id_proveedor' => $id_proveedor, 'publicado' => 'SI'], ['proveedor' => 'id_proveedor']);

        $select = "caracteristica.id_caracteristica, descripcion, caracteristica_detalle, detalle";
        $data['caracteristicas'] = $this->main->getListSelect('caracteristica', $select, ['caracteristica.id_caracteristica' => 'ASC'], ['caracteristica.id_item' => $id, 'caracteristica_propuesta.id_propuesta' => $id_propuesta], null, null, ['caracteristica_propuesta' => 'id_caracteristica']);

        $this->load->view('version2/propuesta/detalle_propuesta', $data, FALSE);
    }

    public function adjudicar()
    {
        $id_item = set_value('id_item');
        $id_propuesta = set_value('id_propuesta');

        $actualizacion['fecha_adjudicacion'] = set_value('fecha_adjudicacion_submit');
        $actualizacion['propuesta_adjudicada'] = $id_propuesta;

        $this->main->update('item', $actualizacion, ['id_item' => $id_item]);

        $this->session->set_flashdata('success', lang('adjudicacion.correcta'));

        redirect('ver-necesidades');
    }

    public function adjudicacion_adjuntos()
    {
        $id_item = set_value('id_item');
        $flag = false;
 
        if (is_uploaded_file($_FILES['file_informe']['tmp_name'])) {
           $aleatorio = random_string('alnum', 16);
           $config['file_name']            = $aleatorio;
           $config['upload_path']          = $_SERVER['DOCUMENT_ROOT']."solicitudesgamc.cochabamba.bo/uploads/adjudicaciones/informe";
           //$config['upload_path']          = $_SERVER['DOCUMENT_ROOT'] . 'propuestas/uploads/adjudicaciones/';
           $config['allowed_types']        = 'jpg|png|pdf|jpeg';
           $config['max_size']             = 12000;
  
           $this->load->library('upload', $config);
  
  
           if (!$this->upload->do_upload('file_informe')) {
  
              $this->session->set_flashdata('alert', $this->upload->display_errors('<div class="error"><i class="las la-exclamation-triangle la-2x"></i>', '</div>'));
  
              redirect('ver-necesidades');
           }
            $file_informe = $this->upload->data('file_name');
        }
        if (is_uploaded_file($_FILES['file_resolucion']['tmp_name'])) {
            $aleatorio = random_string('alnum', 16);
            $config['file_name']            = $aleatorio;
            $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'] . "solicitudesgamc.cochabamba.bo/uploads/adjudicaciones/resolucion";
            //$config['upload_path']          = $_SERVER['DOCUMENT_ROOT'] . 'propuestas/uploads/adjudicaciones/';
            $config['allowed_types']        = 'jpg|png|pdf|jpeg';
            $config['max_size']             = 12000;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file_resolucion')) {

                $this->session->set_flashdata('alert', $this->upload->display_errors('<div class="error"><i class="las la-exclamation-triangle la-2x"></i>', '</div>'));

                redirect('ver-necesidades');
            }
            $file_resolucion = $this->upload->data('file_name');
        }
        if (is_uploaded_file($_FILES['file_contrato']['tmp_name'])) {
            $aleatorio = random_string('alnum', 16);
            $config['file_name']            = $aleatorio;
            $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'] . "solicitudesgamc.cochabamba.bo/uploads/adjudicaciones/contrato";
            //$config['upload_path']          = $_SERVER['DOCUMENT_ROOT'] . 'propuestas/uploads/adjudicaciones/';
            $config['allowed_types']        = 'jpg|png|pdf|jpeg';
            $config['max_size']             = 12000;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file_contrato')) {

                $this->session->set_flashdata('alert', $this->upload->display_errors('<div class="error"><i class="las la-exclamation-triangle la-2x"></i>', '</div>'));

                redirect('ver-necesidades');
            }
            $file_contrato = $this->upload->data('file_name');
        }


        if (isset($file_informe))
        {
            $flag = true;
            $actualizacion['adj_file1'] = $file_informe;
        }
        if (isset($file_resolucion))
        {
            $flag = true;
            $actualizacion['adj_file2'] = $file_resolucion;
        }
        if (isset($file_contrato))
        {
            $flag = true;
            $actualizacion['adj_file3'] = $file_contrato;
        }

        if($flag)
        {
            $actualizacion['adjuntado_por'] = $this->session->funcionario->nombre_completo;
            
            $this->main->update('item', $actualizacion, ['id_item' => $id_item]);
            $this->session->set_flashdata('success', lang('adjunto.correcto'));
        }
        else{
            $this->session->set_flashdata('alert', 'No Se Cargo Ningun Archivo');
        }

        redirect('ver-necesidades');
    }

}
    
    /* End of file Propuesta.php */