<table border="1" cellpadding="3">
    <tr>
        <td width="19%">Característica Requerida</td>
        <td width="35%">Detalle Característica</td>
        <td width="37%">Característica Ofertada</td>
        <td width="9%">Evaluación</td>
    </tr>


    <?php foreach ($caracteristicas as $value): ?>
        <tr>
        <td width="19%"><?=$value->descripcion ?></td>
        <td width="35%"><?=html_entity_decode($value->caracteristica_detalle)?></td>
        <td width="37%"><?=html_entity_decode($value->detalle)?></td>
        <td width="9%"></td>
    </tr>
    <?php endforeach; ?>
</table>