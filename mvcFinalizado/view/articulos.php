<?php require("layout/header.php"); ?>

<div class="container mt-4">
  <h1 class="text-center">ARTICULOS</h1>
  <br>

  <table class="table table-striped table-hover" id="tabla">
    <thead class="text-center">
      <tr>
        <th>Id</th>
        <th>Referencia</th>
        <th>Descripcion</th>
        <th>Precio</th>
        <th>Iva</th>
      </tr>
    </thead>

    <tbody>
      <?php if ($articulos->filas): ?>
        <?php foreach ($articulos->filas as $fila): ?>
          <tr class="align-middle text-center">
            <td style="width: 5%;"><?php echo $fila->id; ?></td>
            <td><?php echo htmlspecialchars($fila->referencia); ?></td>
            <td><?php echo htmlspecialchars($fila->descripcion); ?></td>
            <td><?php echo htmlspecialchars($fila->precio); ?></td>
            <td><?php echo htmlspecialchars($fila->iva); ?></td>
            <td style="width: 40%;">
              <a href="index.php?c=articulos&m=editar&id=<?php echo $fila->id; ?>" class="btn btn-success btn-sm">
                Editar
              </a>
              <a 
                href="index.php?c=articulos&m=borrar&id=<?php echo $fila->id; ?>" 
                class="btn btn-danger btn-sm borrar"
                onclick="return confirm('¿Estás seguro de borrar el registro <?php echo $fila->id; ?>?');">
                Borrar
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="5" class="text-center text-muted">No hay registros de articulos.</td>
        </tr>
      <?php endif; ?>
    </tbody>

    <tfoot>
      <tr>
        <td colspan="5" class="text-start">
          <a href="index.php?c=articulos&m=nuevo" class="btn btn-primary">
            Nuevo
          </a>

          <a href="index.php?c=articulos&m=exportar" class="btn btn-success">
            Exportar
          </a>

          <a href="index.php?c=articulos&m=imprimir" target="_blanck" class="btn btn-primary">
            Imprimir
          </a>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

<?php require("layout/footer.php"); ?>
