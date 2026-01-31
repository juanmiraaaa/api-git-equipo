<?php require("layout/header.php"); ?>

<div class="container mt-4">
  <h1 class="text-center">FACTURA LINEAS</h1>
  <br>

  <table class="table table-striped table-hover" id="tabla">
    <thead class="text-center">
      <tr>
        <th>Id</th>
        <th>Factura id</th>
        <th>Referencia</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Iva</th>
        <th>Importe</th>
        <th>Acciones</th>
      </tr>
    </thead>

    <tbody>
      <?php if ($factura_lineas->filas): ?>
        <?php foreach ($factura_lineas->filas as $fila): ?>
          <tr class="align-middle text-center">
            <td style="width: 5%;"><?php echo $fila->id; ?></td>
            <td><?php echo htmlspecialchars($fila->factura_id); ?></td>
            <td><?php echo htmlspecialchars($fila->referencia); ?></td>
            <td><?php echo htmlspecialchars($fila->descripcion); ?></td>
            <td><?php echo htmlspecialchars($fila->cantidad); ?></td>
            <td><?php echo htmlspecialchars($fila->precio); ?></td>
            <td><?php echo htmlspecialchars($fila->iva); ?></td>
            <td><?php echo htmlspecialchars($fila->importe); ?></td>
            <td style="width: 40%;" class="align-middle text-end">
              <a href="index.php?c=clientes&m=editar&id=<?php echo $fila->id; ?>" class="btn btn-success btn-sm">
                Editar
              </a>
              <a
                href="index.php?c=clientes&m=borrar&id=<?php echo $fila->id; ?>"
                class="btn btn-danger btn-sm borrar"
                onclick="return confirm('¿Estás seguro de borrar el registro <?php echo $fila->id; ?>?');">
                Borrar
              </a>
              <a href="index.php?c=articulos&m=verPorCliente&id=<?php echo $fila->id; ?>">
                <button type="button" class="btn btn-info btn-sm">Ver Articulos</button>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="9" class="text-center text-muted">No hay registros de lineas.</td>
        </tr>
      <?php endif; ?>
    </tbody>

    <tfoot>
      <tr>
        <td colspan="9" class="text-start">
          <a href="index.php?c=factura_lineas&m=nuevo" class="btn btn-primary">
            Nuevo
          </a>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

<?php require("layout/footer.php"); ?>
