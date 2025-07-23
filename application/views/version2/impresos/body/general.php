<table cellpadding="4" cellspacing="2" border="1">

    <tr colspan="2">
        <td width="20%"><b>ÍTEM</b></td>
        <td width="79.4%"><?= $item->nombre_item ?></td>
    </tr>

    <tr colspan="4">
        <td width="45%"><b>VALIDEZ DE LA PROPUESTA (DÍAS CALENDARIO)</b></td>
        <td width="8%"><?= $item->validez ?></td>
        <td width="37.8%"><b>TIEMPO DE ENTREGA (DÍAS CALENDARIO)</b></td>
        <td width="8%"><?= $item->tiempo_entrega ?></td>
    </tr>

    <tr colspan="2">
        <td width="20.3%"><b>FORMA ENTREGA</b></td>
        <td colspan="81.9%"><?= $item->forma_entrega ?></td>
    </tr>

    <tr colspan="6">
        <td width="11.7%"><b>CANTIDAD</b></td>
        <td width="8%"><?= $item->cantidad ?></td>
        <td width="19%"><b>UNIDAD DE MEDIDA</b></td>
        <td width="12%"><?= $item->unidad_medida ?></td>
        <td width="14%"><b>PROCEDENCIA</b></td>
        <td width="33.5%"><?= $item->procedencia ?></td>
    </tr>
</table>