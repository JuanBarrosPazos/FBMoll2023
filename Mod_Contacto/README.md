# PROYECTO F. BORJA MOLL, N2 DISEÑO WEB 2023.
## Actualizado 2023/01/21
---
## EN ESTE DIRECTORIO Mod_Contacto/ SE COMPILAN LOS ARCHIVOS NECESARIOS PARA CRUD BBDD CONTACTOS:
- Comprobar la conexión básica a la bbdd.
- index.php: Modal para inserción de reservas.
- index(InitRaizOk).php: Con todas la funciones integradas.
- index(IntegraModulo).php: Redirecciona si está integrado en Mod_Admin y no encuentra los archivos necesarios.
- www/
    - conexion.php: Conexión a la bbdd.
    - index(InitRaizOk).php: Con todas la funciones integradas, desde este directorio (a modo de copia).
    - indexFeedback.php: Gestiona las reservas borradas. Se podrán recuperar o borrar definitivamente.
    - formContacto.php y formModif.php: Gestionan los modales para reservas y comentarios de la empresa.
    - tablesHead.php y feddbackHead.php: Construyen la cabecera de la tabla de datos.
    - datos.php y feedbackDatos.php: Gestionan las acciones con MySql.
- miJs/
    - datos.js y feddbackDatos.js:
        - Construcción de tabla de resultados.
        - Evantos de botones.
        - Funciones que interactuan con la entrada de datos.
        - Funciones que se comunican con el server mendiante AJAX.
    - conentCount.js y modificaCount.js: Contadores de caracteres de los campos textarea.
- js/
    - Librerias integradas.
- Integra_Admin/
    - index(ConexBbdd).php: Comprobación básica de la conexión a la bbdd.
    - CreaTablasContacto.php: Constructor de las tablas necesarias, en caso de detectar el Mod_Admin.
    - appweb_Mod_Contacto.sql: Tablas necesarias en caso de no integrarse en el Mod_Admin.
- inclu/
    - footer.php: Footer de las páginas.
    - head.php: Cabecera de las páginas.
- img/... Imagenes.
- css/... Archivos de estilos.
- .vscode/sftp.json: Integración con el servidor sftp y Visual Studio Code.
---
---
### PENDIENTE:
- VALIDACIONES DE MODALES.
- BOTONES DE NAVEGACIÓN ENTRE FEEDBACK Y GESTIÓN.
- INTEGRACION DE DATOS JS.
- INTEGRACION DE SEGURIDAD DE ACCESO POR CAPAS USUARIOS.
- 
---
---
### COMENTARIOS.
- LAS LIBRERIAS JS NO RESPETAN LA VALIDACIÓN HTML5.
-
---
---
### VERSION Mod_ContactoV05.zip 2023/01/21
- SE MODIFICAN AJUSTES DE LA CREACIÓN DE BBDD AL INTEGRARLA CON MOD_ADMIN.
---
---
### VERSION Mod_ContactoV04.zip 2023/01/21
- FUNCIONA TODO CORRECTAMENTE A FALTA DE LOS AJUSTES PENDIENTES.
---
---


