# 🌐 Sistema de Reservas con PHP y Stripe 💳

¡Bienvenido al sistema de reservas interactivo con **PHP** y **Stripe**! 🎉 Este sistema te permite realizar reservas de forma fácil y rápida, con una interfaz dinámica gracias a **AJAX** y pagos seguros mediante **Stripe**. 🚀

## 🛠️ Características

- **Interfaz Dinámica** con AJAX: Disfruta de una experiencia fluida donde los usuarios pueden realizar reservas sin necesidad de recargar la página. 🔄
- **Pago Seguro con Stripe**: Integración completa con **Stripe** para gestionar pagos de reservas de manera segura y rápida. 💳🔒
- **Backend en PHP**: Utiliza PHP para gestionar el sistema, con un enfoque limpio y fácil de mantener. 🔧
- **Base de Datos MySQL**: Toda la información de las reservas y usuarios se almacena de manera segura en MySQL. 🗄️
- **Formulario Validado**: Validación de formularios tanto del lado del cliente (con JavaScript) como del servidor (con PHP). ✅

## ⚡ Requisitos

Para ejecutar este proyecto necesitarás lo siguiente:

- **PHP 7.4+** 🖥️
- **MySQL o MariaDB** 🗃️
- **Stripe API Key** (¡regístrate en Stripe y obtén tu clave API!) 💳
- **AJAX** para la interacción dinámica del sistema.

## 📦 Instalación

### 1️⃣ Clona el repositorio
Primero, clona el repositorio en tu máquina local:

git clone https://github.com/tu_usuario/sistema-de-reservas.git

2️⃣ Configura tu entorno de servidor

  Sube los archivos a un servidor web compatible con PHP (por ejemplo, Apache o Nginx).

  Asegúrate de tener habilitado PHP y MySQL.

3️⃣ Configura la Base de Datos

Crea una base de datos en MySQL o MariaDB y ejecuta el script de base de datos:

CREATE DATABASE reservas;
USE reservas;
-- Ejecuta las tablas necesarias

4️⃣ Configura Stripe

  Regístrate en Stripe y obtén tus claves API (pública y secreta).

  Abre config.php y coloca tus claves API de Stripe:

define('STRIPE_SECRET_KEY', 'tu_clave_secreta');
define('STRIPE_PUBLIC_KEY', 'tu_clave_publica');

5️⃣ Instalar Dependencias

Si es necesario, instala las dependencias de Stripe utilizando Composer:

composer require stripe/stripe-php

6️⃣ Permisos de Carpeta

Asegúrate de que la carpeta uploads/ tenga permisos de escritura.
💡 Uso
1️⃣ Realizar una Reserva

Los usuarios pueden seleccionar el servicio, fecha y hora. La página se actualizará dinámicamente con la disponibilidad utilizando AJAX. ⏰
2️⃣ Realizar el Pago

Una vez seleccionada la reserva, los usuarios podrán proceder al pago seguro a través de Stripe. Una vez completado el pago, el sistema confirmará la reserva y enviará un correo de confirmación. 📧
🗂️ Estructura de Archivos

/ (Raíz del proyecto)
│
├── assets/                # Archivos CSS, JS y otras dependencias estáticas
│   ├── css/               # Archivos CSS
│   └── js/                # Archivos JavaScript
│
├── includes/              # Archivos PHP comunes (conexión a base de datos, configuración)
│   ├── db.php             # Conexión a la base de datos
│   └── config.php         # Configuración de la API de Stripe y otras variables
│
├── public/                # Archivos accesibles públicamente
│   ├── index.php          # Página principal (reservas)
│   ├── payment.php        # Página de pago con Stripe
│   └── thank_you.php      # Página de agradecimiento tras la reserva
│
├── templates/             # Archivos de plantillas (HTML)
│   └── reservation_form.php  # Formulario de reserva
│
└── database.sql           # Script de creación de base de datos

🤝 Contribuir

Si deseas contribuir a este proyecto, ¡estamos encantados de recibir tu ayuda! 🙌

Sigue estos pasos:

  Haz un fork del repositorio.

  Crea una nueva rama para tu característica (git checkout -b feature/mi-feature).

  Realiza tus cambios y haz un commit (git commit -am 'Agrega nueva característica').

  Haz un push a tu rama (git push origin feature/mi-feature).

  Crea un pull request detallando los cambios realizados.
