<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">

    <!-- Marca -->
    <a class="navbar-brand" href="<?php echo URLSITE; ?>">Inicio</a>

    <!-- Botón para vista móvil -->
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido colapsable -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <!-- Menú principal -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <!-- Dropdown Clientes -->
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="clientesDropdown"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false">
            Clientes
          </a>
          <ul class="dropdown-menu" aria-labelledby="clientesDropdown">
            <li>
              <a class="dropdown-item" href="<?php echo URLSITE . '?c=clientes'; ?>">
                Clientes...
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo URLSITE . '?c=facturas'; ?>">
                Facturas...
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo URLSITE . '?c=factura_lineas'; ?>">
                Factura Lineas...
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo URLSITE . '?c=recibos'; ?>">
                Recibos...
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a class="nav-link" id="navbarSupportedContent" href="<?php echo URLSITE . '?c=articulos'; ?>">Articulos</a>
        </li>

      </ul>

      <!-- Enlace de ayuda -->
      <span class="navbar-text">
        <a class="nav-link active" href="<?php echo URLSITE . '?c=ayuda'; ?>">
          Ayuda
        </a>
      </span>

    </div>
  </div>
</nav>