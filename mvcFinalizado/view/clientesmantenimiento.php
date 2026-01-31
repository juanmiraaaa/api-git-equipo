<?php require("layout/header.php"); ?>

<h1>CLIENTES</h1>
<br />

<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVO'); ?></h2>

<form action="<?php echo 'index.php?c=clientes&m=' . ($opcion == 'EDITAR' ? 'modificar&id=' . $cliente->id : 'insertar'); ?>" method="POST">
    <label for="nombre" class="form-label">Nombre</label>
    <input
        type="text"
        class="form-control"
        name="nombre"
        id="nombre"
        value="<?php echo ($opcion == 'EDITAR' ? $cliente->nombre : ''); ?>"
        required />

    <br />

    <label for="email" class="form-label">Email</label>
    <input
        type="email"
        class="form-control"
        name="email"
        id="email"
        value="<?php echo ($opcion == 'EDITAR' ? $cliente->email : ''); ?>"
        required />

    <br />

    <label for="apellidos" class="form-label">Apellidos</label>
    <input
        type="text"
        class="form-control"
        name="apellidos"
        id="apellidos"
        value="<?php echo ($opcion == 'EDITAR' ? $cliente->apellidos : ''); ?>"
        required />

    <br />

    <label for="password" class="form-label">Password</label>
    <input
        type="password"
        class="form-control"
        name="password"
        id="password"
        value="<?php echo ($opcion == 'EDITAR' ? $cliente->password : ''); ?>"
        required />

    <br />

    <label for="direccion" class="form-label">Direccion</label>
    <input
        type="text"
        class="form-control"
        name="direccion"
        id="direccion"
        value="<?php echo ($opcion == 'EDITAR' ? $cliente->direccion : ''); ?>"
        required />

    <br />

    <label for="cp" class="form-label">Cp</label>
    <input
        type="number"
        class="form-control"
        name="cp"
        id="cp"
        value="<?php echo ($opcion == 'EDITAR' ? $cliente->cp : ''); ?>"
        required />

    <br />

    <label for="poblacion" class="form-label">Población</label>
    <input
        type="text"
        class="form-control"
        name="poblacion"
        id="poblacion"
        value="<?php echo ($opcion == 'EDITAR' ? $cliente->poblacion : ''); ?>"
        required />

    <br />

    <label for="provincia" class="form-label">Provincia</label>
    <input
        type="text"
        class="form-control"
        name="provincia"
        id="provincia"
        value="<?php echo ($opcion == 'EDITAR' ? $cliente->provincia : ''); ?>"
        required />

    <br />

    <label for="fechaNac" class="form-label">Fecha de nacimiento</label>
    <input
        type="date"
        class="form-control"
        name="fechaNac"
        id="fechaNac"
        value="<?php echo ($opcion == 'EDITAR' ? $cliente->fechaNac : ''); ?>"
        required />

    <br />

    <label for="formaPago" class="form-label">Forma de Pago</label>
    <select class="form-control" name="formaPago" id="formaPago" required>

        <option value="" disabled
            <?php echo (!isset($cliente->formaPago)) ? 'selected' : ''; ?>>
            Seleccionar Forma Pago
        </option>
        <option value="1" <?php echo (isset($cliente->formaPago) && $cliente->formaPago == '1') ? 'selected' : ''; ?>>
            Contado
        </option>
        <option value="2" <?php echo (isset($cliente->formaPago) && $cliente->formaPago == '2') ? 'selected' : ''; ?>>
            Recibo 30 días
        </option>
        <option value="3" <?php echo (isset($cliente->formaPago) && $cliente->formaPago == '3') ? 'selected' : ''; ?>>
            Recibo 30/60 días
        </option>

    </select>

    <br />

    <button type="submit" class="btn btn-primary">Aceptar</button>
    <a href="<?php echo URLSITE . '?c=clientes'; ?>">
        <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
    </a>
</form>

<?php require("layout/footer.php"); ?>