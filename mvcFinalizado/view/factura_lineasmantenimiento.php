<?php require("layout/header.php"); ?>

<h1>FACTURA LINEAS</h1>
<br/>

<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVO'); ?></h2>

<form action="<?php echo 'index.php?c=factura_lineas&m=' . ($opcion == 'EDITAR' ? 'modificar&id=' . $factura_lineas->id : 'insertar'); ?>" method="POST">
    <label for="factura_id" class="form-label">Factura Id</label>
    <select class="form-control" name="factura_id" id="factura_id" required>

        <?php
            if($opcion == 'NUEVA'):
        ?>
        
        <option value="" disabled selected>Seleccionar factura</option>

        <?php 
            endif;

            foreach($facturas->filas AS $factura):
        ?>

            <option value="<?php echo $factura->id; ?>"
                <?php 
                    if($opcion=='EDITAR')
                        echo($factura->id == $factura_lineas->factura_id ? 'selected' : '')
                ?>
            >
            <?php echo $factura->id; ?>
            </option>

        <?php
            endforeach;
        ?>
 
    </select>

    <br/>

    <label for="referencia" class="form-label">Referencia Articulo</label>
    <input
        type="text"
        class="form-control"
        name="referencia"
        id="referencia"
        value="<?php echo ($opcion == 'EDITAR' ? $factura_lineas->referencia : ''); ?>"
        required
    />

    <br/>

    <label for="descripcion" class="form-label">Descripcion</label>
    <input
        type="datetime"
        class="form-control"
        name="descripcion"
        id="descripcion"
        value="<?php echo ($opcion == 'EDITAR' ? $factura_lineas->descripcion : ''); ?>"
        required
    />

    <br/>

    <label for="cantidad" class="form-label">Cantidad</label>
    <input
        type="decimal"
        class="form-control"
        name="cantidad"
        id="cantidad"
        value="<?php echo ($opcion == 'EDITAR' ? $factura_lineas->cantidad : ''); ?>"
        required
    />

    <br/>

    <label for="precio" class="form-label">Precio</label>
    <input
        type="decimal"
        class="form-control"
        name="precio"
        id="precio"
        value="<?php echo ($opcion == 'EDITAR' ? $factura_lineas->precio : ''); ?>"
        required
    />

    <br/>

    <label for="iva" class="form-label">Iva</label>
    <input
        type="decimal"
        class="form-control"
        name="iva"
        id="iva"
        value="<?php echo ($opcion == 'EDITAR' ? $factura_lineas->iva : ''); ?>"
        required
    />

    <br/>

    <label for="importe" class="form-label">Importe</label>
    <input
        type="decimal"
        class="form-control"
        name="importe"
        id="importe"
        value="<?php echo ($opcion == 'EDITAR' ? $factura_lineas->importe : ''); ?>"
        required
    />

    <br/>

    <button type="submit" class="btn btn-primary">Aceptar</button>
    <a href="<?php echo URLSITE . '?c=factura_lineas'; ?>">
        <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
    </a>
</form>

<?php require("layout/footer.php"); ?>