# Laboratorio #4 Cloud Computing — Lift and Shift

Modernización de la aplicación web tradicional [proyectoWebMVC](https://github.com/jorgebanol/proyectoWebMVC)
(PHP puro con patrón MVC, sin framework) a un entorno 100% contenerizado con Docker.

## Análisis del proyecto original

- **Lenguaje:** PHP (vanilla, sin framework).
- **Puerto por defecto:** 80 (Apache) — el proyecto estaba pensado para correr sobre WAMP/XAMPP,
  con la base de datos en `localhost`.
- **Patrón de desarrollo:** MVC (Modelo - Vista - Controlador), implementado a mano con un
  front controller (`index.php`) que enruta por `?url=` (reescrito vía `.htaccess`) hacia
  `controllers/SiteController.php`, que carga el modelo (`models/ContactoModel.php`) y las
  vistas (`views/*.php`).

## Estructura

```
laboratorio-lift-and-shift/
  Dockerfile              PHP 8.2 + Apache + PDO MySQL + mod_rewrite
  docker-compose.yml       web-app (8080) + db-mysql (3306) + phpmyadmin (8085)
  schema.sql                esquema inicial de la tabla contactos (auto-cargado por MySQL)
  conexion.php              conexión PDO apuntando al host "db-mysql"
  controllers/
  models/
  views/
  assets/css/estilos.css   rediseño completo del CSS
```

## Despliegue

```bash
docker compose up --build
```

- App: http://localhost:8080
- phpMyAdmin: http://localhost:8085 (usuario `root`, contraseña `clave_secreta_nube`)
- MySQL: localhost:3306

La tabla `contactos` se crea automáticamente al primer arranque (vía `schema.sql` montado en
`/docker-entrypoint-initdb.d`), ya con las columnas `correo` y `comentario` requeridas por el
reto calificable.

## Reto Calificable — cambios realizados

1. **Tabla `contactos` ampliada** — columnas `correo` (VARCHAR) y `comentario` (TEXT) agregadas
   en [schema.sql](schema.sql).
2. **Nueva sección "Mis Gustos Personales"** — [views/gustos.php](views/gustos.php), enlazada
   en el menú de [views/header.php](views/header.php) y enrutada en
   [controllers/SiteController.php](controllers/SiteController.php).
3. **CSS rediseñado por completo** — [assets/css/estilos.css](assets/css/estilos.css), tema
   oscuro con tipografía monoespaciada.
4. **Formulario de contacto actualizado** — [views/contacto.php](views/contacto.php) ahora pide
   nombre, correo y comentario; [controllers/SiteController.php](controllers/SiteController.php)
   valida el correo y pasa los tres campos a
   [models/ContactoModel.php](models/ContactoModel.php), que los persiste en MySQL.

## Conclusiones

1. El patrón *Lift and Shift* permite llevar una aplicación tradicional (pensada para correr
   directamente sobre un servidor WAMP/XAMPP) a un entorno de contenedores sin reescribir su
   arquitectura: el único cambio estructural real fue apuntar la conexión a la base de datos al
   nombre del servicio de Docker en lugar de `localhost`. Esto demuestra que buena parte del
   esfuerzo de "migrar a la nube" es de configuración e infraestructura, no de reescritura de
   lógica de negocio.
2. Contenerizar con Docker Compose no solo resuelve el despliegue, sino que además estandariza
   el entorno de desarrollo entre todos los integrantes del equipo (misma versión de PHP,
   extensiones y base de datos para todos), eliminando el clásico "en mi máquina sí funciona".

## URL del repositorio

https://github.com/Icebreaker26/laboratorio-lift-and-shift
