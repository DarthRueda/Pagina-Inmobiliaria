# Introducción

Este repositorio contiene un proyecto de ejemplo desarrollado con **Laravel** y **Vue**, diseñado para el curso de Desarrollo de Aplicaciones Web (DAW). El objetivo principal es proporcionar una base sólida para construir aplicaciones web modernas utilizando tecnologías avanzadas como VueRouter, PrimeVue, y más.

El proyecto incluye funcionalidades completas como autenticación, gestión de usuarios, roles y permisos, y un panel de administración. Además, cuenta con una interfaz moderna basada en Bootstrap 5.

El propósito principal de este proyecto es simular una plataforma moderna para la compra y venta de inmuebles.
# Requisitos
Se recomienda usar Laragon

- ✅ PHP 8.2 o mayor (php -v)
- ✅ Composer (composer -v)
- ✅ Node JS (node -v)


## Como usar


### Clonar Repositorio 

```bash
git clone ....
```

### Instalar vía Composer

Entrar a la carpeta del repositorio
```bash
composer install
```

### Copiar el fichero .env.example  a .env edita las credenciales de la base de datos y la url


### Generar Application Key

```bash
php artisan key:generate
```

### Migrar base de datos

```bash
php artisan migrate
```

### Lanzar Seeders

```bash
php artisan db:seed
```

### Instalar las dependencias de Node

```bash
npm install

npm run dev
```
### Instalar los requisitos
```bash
npm install vue-leaflet
```
```bash
composer install && npm install
```

### Lanzar servidor

```bash
php artisan serve
```

### Lanzar a producción

```bash
npm run build or yarn build
```