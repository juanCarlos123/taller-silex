# Sistema hotel las perlas 
Sistema de reservación de habitaciones para el hotel las perlas.

### intalación
Requerimientos

* php 5.6
* Mysql Server 
* modulos para php y apache: libapache2-mod-auth-mysql, php5-cli, php5-curl, php5-mysql, php5-intl
* modulo rewrite activado
* composer

### virtual host
```
    <VirtualHost *:80>
    ServerName hotel.dev
    DocumentRoot /var/www/html/hotelPerlas/web
    ServerAdmin juancarlos@indava.com
    <Directory /var/www/html/hotelPerlas >
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
    </VirtualHost>
```

### Configurar la base de datos
En la carpeta app/config ubicar el archivo prod.php y modificar el siguiente arreglo con los parametros de nuestra base de datos

```
$app['db.options'] = [
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'dbname' => 'hotelperlas',
    'user' => 'tallersilex',
    'password' => 'tallersilex',
    'charset' => 'utf8',
];
```

### corriendo migraciones
En la carpeta del proyecto
<code>
php bin/console m:m
</code>

### bajando dependencias 
En la carpeta del proyecto 
<code>
composer install
</code>
(Opcional)
