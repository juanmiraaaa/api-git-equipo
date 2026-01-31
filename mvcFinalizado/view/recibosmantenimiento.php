<?php require("layout/header.php"); ?>

<h1>RECIBOS</h1>
<br />

<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVO'); ?></h2>

<form action="<?php echo 'index.php?c=recibos&m=' . ($opcion == 'EDITAR' ? 'modificar&id=' . $recibo->recibo_id : 'insertar'); ?>" method="POST">


    <label for="factura_id" class="form-label">Factura Id</label>
    <select class="form-control" name="factura_id" id="factura_id" required>

        <?php
        if ($opcion == 'NUEVA'):
        ?>

            <option value="" disabled selected>Seleccionar factura</option>

        <?php
        endif;

        foreach ($facturas->filas as $factura): ?>
            <option value="<?php echo $factura->id; ?>"
                <?php
                // Solo marcar selected si estamos editando y coincide con esta factura
                echo (isset($recibo->factura_id) && $recibo->factura_id == $factura->id) ? 'selected' : '';
                ?>>
                <?php echo $factura->id; ?>
            </option>
        <?php endforeach; ?>

    </select>

    <br />

    <label for="fecha" class="form-label">Fecha</label>
    <input
        type="date"
        class="form-control"
        name="fecha"
        id="fecha"
        value="<?php echo ($opcion == 'EDITAR' ? $recibo->fecha : ''); ?>"
        required />

    <br />

    <label for="importe" class="form-label">Importe</label>
    <input
        type="text"
        class="form-control"
        name="importe"
        id="importe"
        value="<?php echo ($opcion == 'EDITAR' ? $recibo->importe : ''); ?>"
        required />

    <br />

    <button type="submit" class="btn btn-primary">Aceptar</button>
    <a href="<?php echo URLSITE . '?c=recibos'; ?>">
        <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
    </a>
</form>

<?php require("layout/footer.php"); ?>