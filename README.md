# Proyecto de Gestión de Tareas (CRUD)
Este es un proyecto simple en PHP para gestionar las facturas de clientes, utilizando:
- Apache: Para poder correr PHP
- MySQL: Gestión de BD

## Requisitos
- Xampp (Apache, PHP 7.4 o superior y MySQL)

## Procedimiento para ejecutar el proyecto exitosamente
1. Instala Xampp
2. Clona este repositorio en la carpeta /c/xampp.
3. Ejecuta el servidor de Apache
4. Abre `http://localhost/api-git-equipo/mvcFinalizado/index.php` en tu navegador (siempre y cuando no lo hayas renombrado).
***AHORA YA TE FUNCIONA LA PRIMERA PARTE DEL PROYECTO***
5. Para conseguir que las páginas no den error, tenemos que abrir desde el panel de Xampp --> phpMyAdmin.
Una vez aquí, procedemos a crear la bd con el mismo nombre que tiene el archivo .sql (localizado en nuestro repositorio bd/). En este caso bd_CRUD.sql.
Una vez creada, importamos el archivo .sql, lo que creará la BD correctamente en nuestro servidor local.
***AHORA YA TENEMOS TODO FUNCIONANDO***

## Funcionalidades
- **C**reate: Añadir nuevas tareas.
- **R**ead: Listar las tareas existentes.
- **U**pdate: Editar el título o estado de una tarea.
- **D**elete: Eliminar tareas.