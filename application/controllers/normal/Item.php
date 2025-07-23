<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
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
        if($this->session->funcionario->id_rol == 3){
            redirect('requerimientos-gamc');
        }
        $grupos = $this->main->getListSelect('grupo', 'id_grupo, nombre_grupo', ['nombre_grupo' => 'ASC']);
        $data['grupos'] = $this->main->dropdown($grupos, 'Todos los Grupos');

        $grupos = $this->main->getListSelect('grupo', 'id_grupo, nombre_grupo', ['nombre_grupo' => 'ASC']);
        $data['grupo'] = $this->main->dropdown($grupos, 'SELECCIONE UN GRUPO');

        $unidades = $this->main->getListSelect('unidades', 'descripcion, descripcion', ['descripcion' => 'ASC']);
        $data['unidades'] = $this->main->dropdown($unidades, 'SELECCIONE UNA MEDIDA');

        $where['estado']= 'PUBLICADO';
        $where['fecha_limite <'] = '2020-08-24';

        if ($this->input->post('grupo')) {
            $this->db->where('grupo.id_grupo', $this->input->post('grupo'));
        }
	$this->db->join('propuesta', 'propuesta.id_item = item.id_item', 'left outer');
        $item = $this->main->getListSelect('item', "ROW_NUMBER() OVER (ORDER BY (SELECT NULL)) as row, CONCAT(cod_grupo, '-', LPAD(nro_solicitud::text, 4, '0') ) AS codigo, item.id_item, nombre_item, item.descripcion, cantidad, unidad_medida, to_char(fecha_limite,'DD TMMonth YYYY') as limite, count(id_proveedor) as propuestas", ['row' => 'codigo'], $where, null, null, ['grupo' => 'id_grupo'],'codigo, item.id_item');


        $data['item'] = json_encode($item);

        $this->load->view('normal/item/index', $data, FALSE);
    }


    public function propuesta()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }

        if ($this->input->post('id_item')) {
            $this->db->where('item.id_item', $this->input->post('item'));
        }




        $id = $this->input->post('item');

        $data['item'] = $this->main->getSelect('item', "nombre_item, CONCAT(cod_grupo, '-', LPAD(nro_solicitud::text, 4, '0') ) AS codigo, item.descripcion, unidad_medida, cantidad,procedencia, tiempo_entrega, forma_entrega, validez, fecha_limite", ['id_item' => $id, 'estado' => 'PUBLICADO'], ['grupo' => 'id_grupo']);
        

        $propuestas = $this->main->getListSelect('propuesta', "ROW_NUMBER() OVER (ORDER BY (SELECT NULL)) as row,  id_item, precio_propuesto, file_cotizacion, nombre_completo, proveedor.id_proveedor, descripcion_propuesta,to_char(propuesta.fecha_registro,'DD \"de\" TMMonth \"del\" YYYY') as fecha_format", ['row' => 'codigo'], ['id_item' => $id, 'publicado' => 'SI'], null, null, ['proveedor' => 'id_proveedor']);

        $data['propuestas'] = json_encode($propuestas);

        $this->load->view('normal/proveedor/index', $data, FALSE);
    }

    public function registro()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }
        mb_internal_encoding("UTF-8");

        $id_user = $this->session->funcionario->id_usuario;

        $this->form_validation->set_rules('item', lang('item'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('cantidad', lang('cantidad'), 'trim|required|numeric');
        $this->form_validation->set_rules('descripcion', lang('descripcion'), 'trim|required');
        $this->form_validation->set_rules('grupo', lang('grupo'), 'required');
        $this->form_validation->set_rules('unidad_medida', lang('unidad.medida'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('procedencia', lang('procedencia'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('entrega', lang('entrega'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('forma_entrega', lang('forma.entrega'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('validez', lang('validez.propuesta'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('fecha_limite_submit', lang('fecha.limite'), 'required');

        if ($this->form_validation->run()) {
            $flag = false;

            if (is_uploaded_file($_FILES['file_requerimiento']['tmp_name'])) {

                $config['allowed_types']        = 'pdf';
                $config['file_name']            = random_string('alnum', 16);
                $config['upload_path']        = $_SERVER['DOCUMENT_ROOT'] . "proveedoresgamc.cochabamba.bo/uploads/";
                //$config['upload_path']          = $_SERVER['DOCUMENT_ROOT'] . "proveedor/uploads/";
                $config['max_size']             = 6000;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file_requerimiento')) {

                    var_dump($error = array('error' => $this->upload->display_errors()));
                    $this->session->set_flashdata('alert', $error['error']);

                    redirect('ver-items');
                } else {
                    $nombre_file = $this->upload->data('file_name');
                    $flag = true;
                }
            }

            $date = date('Y-m-d H:i:s');
            //$fecha = date('Y-m-d H:i:s', strtotime($date . "+ 2 days"));

            $id_grupo = set_value('grupo');
            $num = $this->main->getField('grupo', 'ultima_propuesta', ['id_grupo' => $id_grupo]);
            $num = intval($num) + 1;

            $registro['nombre_item'] = set_value('item');
            $registro['descripcion'] = set_value('descripcion');
            $registro['cantidad'] = set_value('cantidad');
            $registro['fecha_limite'] = set_value('fecha_limite_submit');
            $registro['unidad_medida'] = set_value('unidad_medida');
            $registro['id_grupo'] = $id_grupo;
            $registro['nro_solicitud'] = $num;
            $registro['fecha_publicacion'] = $date;
            $registro['estado'] = 'PUBLICADO';
            $registro['procedencia'] = set_value('procedencia');
            $registro['tiempo_entrega'] = set_value('entrega');
            $registro['añadido_por'] = $id_user;
            $registro['validez'] = set_value('validez');
            $registro['forma_entrega'] = set_value('forma_entrega');
            if ($flag) {
                $registro['file_documento'] = $nombre_file;
            }


            $this->main->insert('item', $registro, 'item_id_item_seq');
            $this->main->update('grupo', ['ultima_propuesta' => $num], ['id_grupo' => $id_grupo]);

            $this->session->set_flashdata('success', lang('item.correcto'));
        } else {
            $this->session->set_flashdata('alert', validation_errors('<div class="error"><i class="las la-exclamation-triangle la-2x"></i>', '</div>'));
        }
        redirect('ver-items');
    }

    public function editar()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }

        $id_item = set_value('item');

        $grupos = $this->main->getListSelect('grupo', 'id_grupo, nombre_grupo', ['nombre_grupo' => 'ASC']);
        $data['grupo'] = $this->main->dropdown($grupos, 'SELECCIONE UN GRUPO');

        $unidades = $this->main->getListSelect('unidades', 'descripcion, descripcion', ['descripcion' => 'ASC']);
        $data['unidades'] = $this->main->dropdown($unidades, 'SELECCIONE UNA MEDIDA');

        $data['item'] = $this->main->get('item', ['id_item' => $id_item]);

        $this->load->view('normal/item/editar', $data);
    }

    public function modificar()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }
        mb_internal_encoding("UTF-8");

        $this->form_validation->set_rules('item', lang('item'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('cantidad', lang('cantidad'), 'trim|required|numeric');
        $this->form_validation->set_rules('descripcion', lang('descripcion'), 'trim|required');
        $this->form_validation->set_rules('grupo', lang('grupo'), 'required');
        $this->form_validation->set_rules('unidad_medida', lang('unidad.medida'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('procedencia', lang('procedencia'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('entrega', lang('entrega'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('forma_entrega', lang('forma.entrega'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('validez', lang('validez.propuesta'), 'trim|required|mb_strtoupper');

        $nombre_adjunto = set_value('nombre_adjunto');
        $id_item = set_value('id_item');


        if ($this->form_validation->run()) {
            $flag = false;

            if (is_uploaded_file($_FILES['file_requerimiento']['tmp_name'])) {

                $config['allowed_types']        = 'pdf';
                $config['file_name']            = random_string('alnum', 16);
                $config['upload_path']        = $_SERVER['DOCUMENT_ROOT'] . "proveedoresgamc.cochabamba.bo/uploads/";
                //$config['upload_path']          = $_SERVER['DOCUMENT_ROOT'] . "proveedor/uploads/";
                $config['max_size']             = 6000;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file_requerimiento')) {

                    var_dump($error = array('error' => $this->upload->display_errors()));
                    $this->session->set_flashdata('alert', $error['error']);

                    redirect('ver-items');
                } else {
                    $nombre_file = $this->upload->data('file_name');
                    unlink($_SERVER['DOCUMENT_ROOT'] . "proveedor/uploads/" . $nombre_adjunto);
                    $flag = true;
                }
            }
            $nombre_usuario = $this->session->funcionario->nombre_completo;
            $date = date('Y-m-d H:i:s');

            $actualizacion['nombre_item'] = set_value('item');
            $actualizacion['descripcion'] = set_value('descripcion');
            $actualizacion['cantidad'] = set_value('cantidad');
            $actualizacion['unidad_medida'] = set_value('unidad_medida');
            $actualizacion['id_grupo'] = set_value('grupo');
            $actualizacion['estado'] = 'PUBLICADO';
            $actualizacion['procedencia'] = set_value('procedencia');
            $actualizacion['tiempo_entrega'] = set_value('entrega');
            $actualizacion['modificado_por'] = $nombre_usuario;
            $actualizacion['fecha_modificado'] = $date;
            $actualizacion['validez'] = set_value('validez');
            $actualizacion['forma_entrega'] = set_value('forma_entrega');
            if ($flag) {
                $actualizacion['file_documento'] = $nombre_file;
            }


            $this->main->update('item', $actualizacion, ['id_item' => $id_item]);

            $this->session->set_flashdata('success', lang('item.modificado'));
        } else {
            $this->session->set_flashdata('alert', validation_errors('<div class="error"><i class="las la-exclamation-triangle la-2x"></i>', '</div>'));
        }
        redirect('ver-items');
    }
}
    /* End of file Item.php */
