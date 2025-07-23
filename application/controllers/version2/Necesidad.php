<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Necesidad extends CI_Controller
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
        /* if ($this->session->funcionario->id_rol == 3) {
            redirect('requerimientos-gamc');
        } */

        $data['user'] = $this->session->funcionario->id_usuario;

        $grupos = $this->main->getListSelect('grupo', 'id_grupo, nombre_grupo', ['nombre_grupo' => 'ASC']);
        $data['grupos'] = $this->main->dropdown($grupos, 'Todos los Grupos');

        $grupos = $this->main->getListSelect('grupo', 'id_grupo, nombre_grupo', ['nombre_grupo' => 'ASC']);
        $data['grupo'] = $this->main->dropdown($grupos, 'SELECCIONE UN GRUPO');

        $unidades = $this->main->getListSelect('unidades', 'descripcion, descripcion', ['descripcion' => 'ASC']);
        $data['unidades'] = $this->main->dropdown($unidades, 'SELECCIONE UNA MEDIDA');

        $where['estado']= 'PUBLICADO';
        $where['fecha_limite >='] = '2020-08-24';

        if ($this->input->post('grupo')) {
            $this->db->where('grupo.id_grupo', $this->input->post('grupo'));
        }
        $this->db->join('propuesta', 'propuesta.id_item = item.id_item', 'left outer');
        $item = $this->main->getListSelect('item', "CONCAT(cod_grupo, '-', LPAD(nro_solicitud::text, 4, '0') ) AS codigo, item.id_item, nombre_item, item.descripcion, cantidad, unidad_medida, to_char(fecha_limite,'DD TMMonth YYYY') as limite, count(id_proveedor) as propuestas, fecha_limite, fecha_publicacion, ROW_NUMBER() OVER (ORDER BY (fecha_publicacion,item.id_item)DESC) as row,item.añadido_por as user", ['fecha_publicacion' => 'DESC'], $where, null, null, ['grupo' => 'id_grupo'], 'codigo, item.id_item');


        $data['item'] = json_encode($item);
        $this->load->view('version2/necesidad/index', $data, FALSE);
    }
    public function agregar()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }

        $grupos = $this->main->getListSelect('grupo', 'id_grupo, nombre_grupo', ['nombre_grupo' => 'ASC']);
        $data['grupo'] = $this->main->dropdown($grupos, 'SELECCIONE UN GRUPO');

        $unidades = $this->main->getListSelect('unidades', 'descripcion, descripcion', ['descripcion' => 'ASC']);
        $data['unidades'] = $this->main->dropdown($unidades, 'SELECCIONE UNA MEDIDA');

        $this->db->join('propuesta', 'propuesta.id_item = item.id_item', 'left outer');
        $item = $this->main->getListSelect('item', "ROW_NUMBER() OVER (ORDER BY (SELECT NULL)) as row, CONCAT(cod_grupo, '-', LPAD(nro_solicitud::text, 4, '0') ) AS codigo, item.id_item, nombre_item, item.descripcion, cantidad, unidad_medida, to_char(fecha_limite,'DD TMMonth YYYY') as limite, count(id_proveedor) as propuestas", ['row' => 'codigo'], ['estado' => 'PUBLICADO'], null, null, ['grupo' => 'id_grupo'], 'codigo, item.id_item');

        $data['item'] = json_encode($item);

        $this->load->view('version2/necesidad/registro', $data, FALSE);
    }
    public function new_registro()
    {
        mb_internal_encoding("UTF-8");

        $id_user = $this->session->funcionario->id_usuario;
        $this->form_validation->set_rules('caracteristica[]', lang('caracteristicas.tecnicas'), 'trim');
        $this->form_validation->set_rules('detalle[]', lang('detalle.caracteristica'), 'trim');
        $this->form_validation->set_rules('item', lang('item'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('cantidad', lang('cantidad'), 'trim|required|numeric');
        $this->form_validation->set_rules('grupo', lang('grupo'), 'required');
        $this->form_validation->set_rules('unidad_medida', lang('unidad.medida'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('procedencia', lang('procedencia'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('entrega', lang('entrega'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('forma_entrega', lang('forma.entrega'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('informacion', lang('informacion.adicional'), 'trim');
        $this->form_validation->set_rules('validez', lang('validez.propuesta'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('fecha_limite_submit', lang('fecha.limite'), 'required');

        if ($this->form_validation->run()) {
            $flag = false;

            if (is_uploaded_file($_FILES['file_requerimiento']['tmp_name'])) {

                $config['allowed_types']        = 'jpg|png|pdf|jpeg|ods|xlsx|xls|doc|docx';
                $config['file_name']            = random_string('alnum', 16);
                $config['upload_path']        = $_SERVER['DOCUMENT_ROOT'] . "proveedoresgamc.cochabamba.bo/uploads/";
                //$config['upload_path']          = $_SERVER['DOCUMENT_ROOT']."proveedor/uploads/";
                $config['max_size']             = 12000;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file_requerimiento')) {

                    var_dump($error = array('error' => $this->upload->display_errors()));
                    $this->session->set_flashdata('alert', $error['error']);

                    redirect('agregar-item');
                } else {
                    $nombre_file = $this->upload->data('file_name');
                    $ext = $this->upload->data('file_ext');
                    $flag = true;
                }
            }

            $date = date('Y-m-d H:i:s');

            $id_grupo = set_value('grupo');
            $num = $this->main->getField('grupo', 'ultima_propuesta', ['id_grupo' => $id_grupo]);            
            $num = intval($num) + 1;
            $gp = $this->main->getField('grupo', 'cod_grupo', ['id_grupo' => $id_grupo]);

            $registro['nombre_item'] = set_value('item');
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
            $registro['informacion'] = set_value('informacion');
            
            if ($flag) {                
                $new_name = "SolicitudItem".$gp."-".str_pad($num,4,"0", STR_PAD_LEFT).$ext;
                $ruta = $_SERVER['DOCUMENT_ROOT']."/proveedoresgamc.cochabamba.bo/uploads/";
                //$ruta = $_SERVER['DOCUMENT_ROOT']."/proveedor/uploads/";

                rename($ruta.$nombre_file, $ruta.$new_name);
                $registro['file_documento'] = $new_name;
            }


            $caracteristicas = set_value('caracteristica');
            $caracteristica_detalle = set_value('detalle');

            $id_item = $this->main->insert('item', $registro, 'item_id_item_seq');

            $detalle['id_item'] = $id_item;

            $arraycaracteristica=[];            
            foreach ($caracteristicas as $key => $value) {
              array_push($arraycaracteristica, ['descripcion' => $value, 'id_item' => $id_item,'caracteristica_detalle' => str_replace('&amp;NBSP;','',$caracteristica_detalle[$key])]); 
            }
        
            $this->db->insert_batch('caracteristica', $arraycaracteristica);

            $this->main->update('grupo', ['ultima_propuesta' => $num], ['id_grupo' => $id_grupo]);

            $this->session->set_flashdata('success', lang('item.correcto'));
        } else {
            $this->session->set_flashdata('alert', validation_errors('<div class="error"><i class="las la-exclamation-triangle la-2x"></i>', '</div>'));
        }
        redirect('agregar-item');  
    }  
    public function editar()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }

        $id_item = set_value('item');

        $editable= $this->main->get('propuesta', ['id_item' => $id_item]);

        if($editable != null)
        {
            redirect('ver-necesidades');
        }

        $grupos = $this->main->getListSelect('grupo', 'id_grupo, nombre_grupo', ['nombre_grupo' => 'ASC']);
        $data['grupo'] = $this->main->dropdown($grupos, 'SELECCIONE UN GRUPO');

        $unidades = $this->main->getListSelect('unidades', 'descripcion, descripcion', ['descripcion' => 'ASC']);
        $data['unidades'] = $this->main->dropdown($unidades, 'SELECCIONE UNA MEDIDA');

        $data['item'] = $this->main->get('item', ['id_item' => $id_item]);

        $select = "id_caracteristica, descripcion, caracteristica_detalle";
        $data['caracteristicas'] = $this->main->getListSelect('caracteristica', $select, ['caracteristica.id_caracteristica' => 'ASC'], ['caracteristica.id_item' => $id_item]);

        $this->load->view('version2/necesidad/editar', $data);
    }

    public function modificar()
    {
        if (!isset($this->session->funcionario->nombre_completo)) {
            redirect(site_url());
        }
        mb_internal_encoding("UTF-8");

        $this->form_validation->set_rules('nombre_item', lang('item'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('cantidad', lang('cantidad'), 'trim|required|numeric');
        $this->form_validation->set_rules('caracteristica[]', lang('caracteristicas.tecnicas'), 'trim|mb_strtoupper');
        $this->form_validation->set_rules('detalle[]', lang('detalle.caracteristica'), 'trim|mb_strtoupper');
        $this->form_validation->set_rules('nueva_caracteristica[]', lang('caracteristicas.tecnicas'), 'trim|mb_strtoupper');
        $this->form_validation->set_rules('new_detalle[]', lang('detalle.caracteristica'), 'trim|mb_strtoupper');
        $this->form_validation->set_rules('id_caracteristica[]', lang('detalle.caracteristica'), 'numeric');
        $this->form_validation->set_rules('grupo', lang('grupo'), 'required');
        $this->form_validation->set_rules('unidad_medida', lang('unidad.medida'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('procedencia', lang('procedencia'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('entrega', lang('entrega'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('informacion', lang('informacion.adicional'), 'trim');
        $this->form_validation->set_rules('forma_entrega', lang('forma.entrega'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('validez', lang('validez.propuesta'), 'trim|required|mb_strtoupper');

        $nombre_adjunto = set_value('nombre_adjunto');
        $id_item = set_value('id_item');


        if ($this->form_validation->run()) {
            $flag = false;

            if (is_uploaded_file($_FILES['file_requerimiento']['tmp_name'])) {

                $config['allowed_types']        = 'jpg|png|pdf|jpeg|ods|xlsx|xls|doc|docx';
                $config['file_name']            = random_string('alnum', 16);
                $config['upload_path']        = $_SERVER['DOCUMENT_ROOT'] . "proveedoresgamc.cochabamba.bo/uploads/";
                //$config['upload_path']          = $_SERVER['DOCUMENT_ROOT']."proveedor/uploads/";
                $config['max_size']             = 12000;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file_requerimiento')) {

                    var_dump($error = array('error' => $this->upload->display_errors()));
                    $this->session->set_flashdata('alert', $error['error']);

                    redirect('ver-necesidades');
                } else {
                    $nombre_file = $this->upload->data('file_name');
                    $ext = $this->upload->data('file_ext');
                    $flag = true;
                }
            }
            $nombre_usuario = $this->session->funcionario->nombre_completo;
            $date = date('Y-m-d H:i:s');

            $id_grupo = set_value('grupo');
            $id_gpant = set_value('gpanterior');

            $num = $this->main->getField('grupo', 'ultima_propuesta', ['id_grupo' => $id_grupo]);
            $gp = $this->main->getField('grupo', 'cod_grupo', ['id_grupo' => $id_grupo]);

            $cambio_grupo = false;

            if($id_grupo != $id_gpant)
            {                              
                           
                $num = intval($num) + 1;

                $numant = $this->main->getField('grupo', 'ultima_propuesta', ['id_grupo' => $id_gpant]);
                    
                $numant = intval($numant) - 1;
                
                $cambio_grupo = true;
            }
            else {
                $num = $this->main->getField('item', 'nro_solicitud', ['id_item' => $id_item]);
            }

            $actualizacion['nombre_item'] = set_value('nombre_item');
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
            $actualizacion['informacion'] = set_value('informacion');
            if ($flag) {
                $new_name = "SolicitudItem".$gp."-".str_pad($num,4,"0", STR_PAD_LEFT).$ext;
                $ruta = $_SERVER['DOCUMENT_ROOT']."/proveedoresgamc.cochabamba.bo/uploads/";
                //$ruta = $_SERVER['DOCUMENT_ROOT']."/proveedor/uploads/";

                $docuanterior = $this->main->getField('item', 'file_documento', ['id_item' => $id_item]);
                rename($ruta.$nombre_file, $ruta.$new_name);
                unlink($ruta = $_SERVER['DOCUMENT_ROOT']."/proveedores/proveedor/uploads/".$docuanterior);
                $actualizacion['file_documento'] = $new_name;
            }


            $this->main->update('item', $actualizacion, ['id_item' => $id_item]);

            $id_caracteristica = set_value('id_caracteristica');
            $caracteristicas = set_value('caracteristica');
            $caracteristica_detalle = set_value('detalle');

            $new_caracteristicas = set_value('nueva_caracteristica');
            $new_caracteristica_detalle = set_value('new_detalle');
         
            foreach ($caracteristicas as $llave => $valor) {

                $modificacion['descripcion'] = $valor;
                $modificacion['caracteristica_detalle'] = str_replace('&amp;NBSP;','',$caracteristica_detalle[$llave]);

                $this->main->update('caracteristica', $modificacion, ['id_caracteristica' => $id_caracteristica[$llave]]);                
            }
        
            $arraycaracteristica=[];            
            foreach ($new_caracteristicas as $key => $value) {

                if($value != "" && $new_caracteristica_detalle[$key] != "")
                {
                    array_push($arraycaracteristica, ['descripcion' => $value, 'id_item' => $id_item,'caracteristica_detalle' => str_replace('&amp;NBSP;','',$new_caracteristica_detalle[$key])]); 
                }              
            }

            if(!empty($arraycaracteristica))
            {
                $this->db->insert_batch('caracteristica', $arraycaracteristica);
            }      

            if($cambio_grupo)
            {
                $this->main->update('grupo', ['ultima_propuesta' => $num], ['id_grupo' => $id_grupo]);
                $this->main->update('grupo', ['ultima_propuesta' => $numant], ['id_grupo' => $id_gpant]);

                $this->main->update('item', ['nro_solicitud' => $num], ['id_item' => $id_item]);
            }        
                 
            $this->session->set_flashdata('success', lang('item.modificado'));
        } else {
            $this->session->set_flashdata('alert', validation_errors('<div class="error"><i class="las la-exclamation-triangle la-2x"></i>', '</div>'));
        }
        redirect('ver-necesidades');
    }
}
    
/* End of file Necesidad.php */