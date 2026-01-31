<?php
require("layout/header.php");

?>

<div class="container mt-4">
  <h1 class="text-center">CLIENTES</h1>
  <br>

  <table class="table table-striped table-hover" id="tabla">
    <thead class="text-center">
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Apellidos</th>
        <th>Forma Pago</th>
      </tr>
    </thead>

    <tbody>
      <?php if ($clientes->filas): ?>
        <?php foreach ($clientes->filas as $fila): ?>
          <tr class="align-middle text-center">
            <td style="width: 5%;"><?php echo $fila->id; ?></td>
            <td><?php echo $fila->nombre; ?></td>
            <td><?php echo $fila->email; ?></td>
            <td><?php echo $fila->apellidos; ?></td>
            <td><?php echo isset($fila->formaPago) ? $fila->formaPago : ''; ?></td>
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
              <a href="index.php?c=facturas&m=verPorCliente&id=<?php echo $fila->id; ?>">
                <button type="button" class="btn btn-info btn-sm">Ver facturas</button>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="11" class="text-center text-muted">No hay registros de clientes.</td>
        </tr>
      <?php endif; ?>
    </tbody>

    <tfoot>
      <tr>
        <td colspan="5" class="text-start"><!--Poniendo colspan 4 no sabe calcular el espacio para los 4 botones-->
          <a href="index.php?c=clientes&m=nuevo" class="btn btn-primary">
            Nuevo
          </a>

          <a href="index.php?c=clientes&m=exportar" class="btn btn-success">
            Exportar CSV
          </a>

          <a href="index.php?c=clientes&m=exportar" class="btn btn-success">
            Exportar JSON
          </a>

          <a href="index.php?c=clientes&m=imprimir" target="_blanck" class="btn btn-primary">
            Imprimir
          </a>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

<?php require("layout/footer.php"); ?>