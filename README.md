# Sistema hotel las perlas 
Sistema de reservación de habitaciones para el hotel las perlas.

### intalación
Requerimientos

* php 5.6
* Mysql Server 
* modulos para php y apache: libapache2-mod-auth-mysql, php5-cli, php5-curl, php5-mysql, php5-intl
* mod rewrite activado

### virtual host


> <VirtualHost *:80>
> ServerName hotel.dev
>  DocumentRoot /var/www/html/hotelPerlas/web
>  ServerAdmin juancarlos@indava.com
>
>  <Directory /var/www/html/hotelPerlas >
>    AllowOverride All
>    Order allow,deny
>    Allow from all
>  </Directory>
> </VirtualHost>

