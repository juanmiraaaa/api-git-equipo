<?php require("layout/header.php"); ?>

<div class="container mt-4">
  <h1 class="text-center">FACTURAS</h1>
  <br>

  <table class="table table-striped table-hover" id="tabla">
    <thead class="text-center">
      <tr>
        <th>Id</th>
        <th>Cliente id</th>
        <th>Número</th>
        <th>Fecha</th>
      </tr>
    </thead>

    <tbody>
      <?php if ($facturas->filas): ?>
        <?php foreach ($facturas->filas as $fila): ?>
          <tr class="align-middle text-center">
            <td style="width: 5%;"><?php echo $fila->id; ?></td>
            <td><?php echo htmlspecialchars($fila->cliente_id); ?></td>
            <td><?php echo htmlspecialchars($fila->numero); ?></td>
            <td><?php echo htmlspecialchars($fila->fecha); ?></td>
            <td><?php echo isset($fila->formaPago) ? $fila->formaPago : ''; ?></td>
            <td style="width: 40%;" class="align-middle text-end">
              <a href="index.php?c=facturas&m=editar&id=<?php echo $fila->id; ?>" class="btn btn-success btn-sm">
                Editar
              </a>
              <a
                href="index.php?c=facturas&m=borrar&id=<?php echo $fila->id; ?>"
                class="btn btn-danger btn-sm borrar"
                onclick="return confirm('¿Estás seguro de borrar el registro <?php echo $fila->id; ?>?');">
                Borrar
              </a>
              <a href="index.php?c=factura_lineas&m=verPorCliente&id=<?php echo $fila->id; ?>">
                <button type="button" class="btn btn-info btn-sm">Ver Lineas</button>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="4" class="text-center text-muted">No hay registros de facturas.</td>
        </tr>
      <?php endif; ?>
    </tbody>

    <tfoot>
      <tr>
        <td colspan="4" class="text-start">
          <a href="index.php?c=facturas&m=nuevo" class="btn btn-primary">
            Nuevo
          </a>

          <a href="index.php?c=facturas&m=exportar" class="btn btn-success">
            Exportar
          </a>

          <a href="index.php?c=facturas&m=imprimir" target="_blank" class="btn btn-primary">
            Imprimir
          </a>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

<?php require("layout/footer.php"); ?>
