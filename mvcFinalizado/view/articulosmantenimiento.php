<?php require("layout/header.php"); ?>

<h1>ARTICULOS</h1>
<br/>

<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVO'); ?></h2>

<form action="<?php echo 'index.php?c=articulos&m=' . ($opcion == 'EDITAR' ? 'modificar&id=' . $articulos->id : 'insertar'); ?>" method="POST">
    <label for="referencia" class="form-label">Articulo id</label>
    
    <select class="form-control" name="referencia" id="referencia" required>

        <?php
            if($opcion == 'NUEVA'):
        ?>
        
        <option value="" disabled selected>Seleccionar articulo</option>

        <?php 
            endif;

            foreach($articulos->filas AS $articulo):
        ?>

            <option value="<?php echo $articulo->id; ?>"
                <?php 
                    if($opcion=='EDITAR')
                        echo($articulo->referencia == $factura_lineas->referencia ? 'selected' : '')
                ?>
            >
            </option>

        <?php
            endforeach;
        ?>
 
    </select>

    <br/>

    <label for="descripcion" class="form-label">Descripción</label>
    <textarea
        class="form-control"
        name="descripcion"
        id="descripcion"
        rows="3" placeholder="Escribe aqui..."
        value="<?php echo ($opcion == 'EDITAR' ? $articulos->descripcion : ''); ?>"
        required
    ></textarea>

    <br/>

    <label for="precio" class="form-label">Precio</label>
    <input
        type="number"
        class="form-control"
        name="precio"
        id="precio"
        value="<?php echo ($opcion == 'EDITAR' ? $articulos->precio : ''); ?>"
        required
    />

    <br/>

    <button type="submit" class="btn btn-primary">Aceptar</button>
    <a href="<?php echo URLSITE . '?c=articulos'; ?>">
        <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
    </a>
</form>

<?php require("layout/footer.php"); ?>