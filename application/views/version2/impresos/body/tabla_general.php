<table cellpadding="4" cellspacing="2">

    <tr colspan="6">
        <td width="7%" border="1"><b>N°</b></td>
        <td width="41%" border="1"><b>Razón Social/Nombre Empresa/Persona</b></td>
        <td width="13%" border="1"><b>N° de Contacto</b></td>
        <td width="15%" border="1"><b>Precio Propuesto</b></td>
        <td width="22.8%" border="1"><b>Registro de Propuesta</b></td>
    </tr>

    <?php
    $date = date('Y-m-d');
    if ($this->session->funcionario->id_rol == '3') {
        if ($item->fecha_limite >= $date) {
            $precio = "OCULTO";
            foreach ($propuestas as $value) {
                echo '<tr colspan="6"><td width="7%" border="1">' . $value->row . '</td>' .
                    '<td width="41%" border="1">' . $value->nombre_completo . '</td>' .
                    '<td width="13%" border="1">' . $value->celular . '</td>' .
                    '<td width="15%" border="1">' . $precio . '</td>' .
                    '<td width="22.8%" border="1">' . $value->fecha_format . '</td></tr>';
            }
        } else {
            
            foreach ($propuestas as $value) {
                $precio = number_format($value->precio_propuesto, 0, ',', '.');
                echo '<tr colspan="6"><td width="7%" border="1">' . $value->row . '</td>' .
                    '<td width="41%" border="1">' . $value->nombre_completo . '</td>' .
                    '<td width="13%" border="1">' . $value->celular . '</td>' .
                    '<td width="15%" border="1">' . $precio . '</td>' .
                    '<td width="22.8%" border="1">' . $value->fecha_format . '</td></tr>';
            }
        }
    } else {

        foreach ($propuestas as $value) {
            $precio = number_format($value->precio_propuesto, 0, ',', '.');
            echo '<tr colspan="6"><td width="7%" border="1">' . $value->row . '</td>' .
                '<td width="41%" border="1">' . $value->nombre_completo . '</td>' .
                '<td width="13%" border="1">' . $value->celular . '</td>' .
                '<td width="15%" border="1">' . $precio . '</td>' .
                '<td width="22.8%" border="1">' . $value->fecha_format . '</td></tr>';
        }
    }
    ?>

</table>