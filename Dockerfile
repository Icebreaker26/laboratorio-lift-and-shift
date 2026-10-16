# 1. Usamos una imagen oficial de PHP con el servidor web Apache integrado
FROM php:8.2-apache

# 2. Instalar y compilar las extensiones necesarias para conectarse a MySQL (PDO)
RUN docker-php-ext-install pdo pdo_mysql

# 3. Habilitar el módulo mod_rewrite de Apache (Crucial para el archivo .htaccess del MVC)
RUN a2enmod rewrite

# 4. Copiar todo el código del repositorio dentro del directorio público de Apache
COPY . /var/www/html/

# 5. Dar permisos correctos a Apache para leer y ejecutar los archivos
RUN chown -R www-data:www-data /var/www/html

# 6. Exponer el puerto estándar HTTP
EXPOSE 80
