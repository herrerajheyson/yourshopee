### :fa-cart-plus: YourShopee

**Proyecto de Prueba**: Tienda en linea realizada en Framework [Laravel](https://laravel.com/ "Laravel") cuyo proposito general es poder realizar una operación de venta online de productos para todo público.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Como Instalarlo

- Clonar proyecto de Github en tu repositorio local.
- Debes tener instalado composer en tu PC, si no lo tienes dirígete [aquí](https://getcomposer.org/ "aquí") y descarga el programa manejador de dependencias.
- Ejecuta Composer Install para instalar las dependencias instaladas en el proyecto.
- Configura el archivo de configuraciones .env en la raiz del proyecto.
	- Configura la variable APP_ENV con production o local.
	- Configura la variable APP_DEBUG con true o false.
	- Configura la variable APP_URL.
	- Configura los datos de conexión a tu base de datos.
- Ejecuta el comando php artisan migrate para correr las migraciones y crear nuestra base de datos.
- Ejecuta el comando php artisan db:seed para ejecutar los seeders y llenar tu base de datos con información por defecto o inicial.

