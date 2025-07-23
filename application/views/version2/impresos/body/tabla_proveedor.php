<table cellpadding="4" cellspacing="2">

    <tr colspan="6">
        <td width="46%" border="1"><b>Razón Social/Nombre Empresa/Persona</b></td>
        <td width="15%" border="1"><b>Precio Propuesto</b></td>
        <td width="22.8%" border="1"><b>Registro de Propuesta</b></td>
        <td width="16.2%" border="1"><b>Adjunto Propuesta</b></td>
    </tr>

    <?php
    $date = date('Y-m-d');
    if ($this->session->funcionario->id_rol == '3') {
        if ($item->fecha_limite >= $date) {
            $precio = "OCULTO";
        } else {
            $precio = number_format($propuesta->precio_propuesto, 0, ',', '.');
        }
    } else {
        $precio = number_format($propuesta->precio_propuesto, 0, ',', '.');
    }
    ?>

    <tr colspan="6">
        <td width="46%" border="1"><?= $propuesta->nombre_completo; ?></td>
        <td width="15%" border="1"><?= $precio; ?></td>
        <td width="22.8%" border="1"><?= $propuesta->fecha_format; ?></td>
        <td width="16.2%" border="1"><?= ($propuesta->file_cotizacion) ? 'SI Adjunto' : 'NO Adjunto'; ?></td>
    </tr>

    <tr colspan="1">
        <td width="100.9%" border="1">DATOS DE CONTACTO</td>
    </tr>

    <tr colspan="4">
        <td width="20.8%" border="1">Número de Celular</td>
        <td width="10%" border="1"><?= $propuesta->celular; ?></td>
        <td width="23.2%" border="1">Correo Electrónico</td>
        <td width="46%" border="1"><?= $propuesta->correo_electronico ?></td>
    </tr>

    <tr colspan="4">
        <td width="20.8%" border="1">Número de NIT</td>
        <td width="10%" border="1"><?= $propuesta->nit; ?></td>
        <td width="23.2%" border="1">Representante Legal</td>
        <td width="46%" border="1"><?= $propuesta->representante ?></td>
    </tr>
</table>