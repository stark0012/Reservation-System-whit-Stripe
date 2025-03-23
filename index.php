<?php  

$clienteNombre = (empty($_COOKIE['clienteNombre'])) ? "" : $_COOKIE['clienteNombre'];
$clienteEmail = (empty($_COOKIE['clienteEmail'])) ? "" : $_COOKIE['clienteEmail'];
$clienteTelefono = (empty($_COOKIE['clienteTelefono'])) ? "" : $_COOKIE['clienteTelefono'];
$beneficiarioNombre = (empty($_COOKIE['beneficiarioNombre'])) ? "" : $_COOKIE['beneficiarioNombre'];
$beneficiarioDireccion = (empty($_COOKIE['beneficiarioDireccion'])) ? "" : $_COOKIE['beneficiarioDireccion'];
$beneficiarioTelefono = (empty($_COOKIE['beneficiarioTelefono'])) ? "" : $_COOKIE['beneficiarioTelefono'];


date_default_timezone_set('America/Havana');


$fechaActual = date('Y-m-d');


$fechaMin = date('Y-m-d', strtotime($fechaActual . ' +1 day'));


$fechaMax = date('Y-m-d', strtotime($fechaActual . ' +365 day'));




?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Reserva fácilmente tus servicios con CubaHomeServices. Completa el formulario de reserva y asegúrate de obtener atención de calidad en la fecha y hora que prefieras. ¡Garantizamos comodidad y eficiencia!">
    <title>CubaHomeServices - Reservar servicio a Cuba</title>
    <link rel="stylesheet" href="css/styles.css?timestamp=<?php echo time();?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script defer src="js/script.js?timestamp=<?php echo time();?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="application/ld+json">{
  "@context": "https://schema.org",
  "@type": "Service",
  "serviceType": "Reserva de Servicios",
  "provider": {
    "@type": "Organization",
    "name": "CubaHomeServices",
    "url": "https://www.cubahomeservices.com",
    "logo": "https://www.cubahomeservices.com/logo.png",
    "contactPoint": {
      "@type": "ContactPoint",
      "email": "contact@cubahomeservices.com",
      "contactType": "Customer Service",
      "availableLanguage": ["Spanish", "English"]
    }
  },
  "areaServed": {
    "@type": "Place",
    "geo": {
      "@type": "GeoCircle",
      "geoMidpoint": {
        "@type": "GeoCoordinates",
        "latitude": 28.4666667,
        "longitude": -81.63166666666666
      },
      "geoRadius": 500000
    },
    "address": {
      "@type": "PostalAddress",
      "addressCountry": "CU",
      "addressRegion": [
        "Pinar del Río",
        "Artemisa",
        "La Habana",
        "Mayabeque",
        "Matanzas",
        "Villa Clara",
        "Cienfuegos",
        "Sancti Spíritus",
        "Ciego de Ávila",
        "Camagüey",
        "Las Tunas",
        "Holguín",
        "Granma",
        "Santiago de Cuba",
        "Guantánamo",
        "Isla de la Juventud"
      ]
    }
  },
  "audience": {
    "@type": "Audience",
    "geographicArea": {
      "@type": "Place",
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 37.09024,
        "longitude": -95.712891
      },
      "address": {
        "@type": "PostalAddress",
        "addressCountry": "US"
      }
    }
  }
}</script>
</head>
<body>
    <header>
        <div class="logo">
            <a href="https://cubahomeservices.com/"><img src="image/Logo.png" alt="Logo Cuba Home Services"></a>
        </div>
        <nav class="nav" id="nav">
            <ul>
                <li><a href="https://cubahomeservices.com/">Inicio</a></li>
                <li><a href="https://cubahomeservices.com/services-es/">Servicios</a></li>
                <li><a href="https://cubahomeservices.com/contact-es/">Contacto</a></li>
            </ul>
            <button id="close-menu" class="close-menu">&times;</button>
        </nav>
        <div class="menu-toggle" id="menu-toggle">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </header>
    <a href="https://cubahomeservices.com/how-does-it-work-es/" target="_blank" class="floating-button">¿Cómo funciona?</a>
    <a href="https://cubahomeservices.com/how-does-it-work-es/" target="_blank" class="mobile-button">?</a>
    <div class="container">
        <form class="form" method="POST" action="pay.php" id="reservation-form">
            <h1>Reserva tu Servicio</h1>
            <h2>Detalles del cliente:</h2>
            <div class="form-group">
                <label for="cliente-nombre"><i class="fas fa-asterisk required-icon"></i> Nombre Completo del Cliente</label>
                <input type="text" id="cliente-nombre" name="cliente-nombre" value="<?php echo $clienteNombre;?>" required>
                <small>Error: Nombre requerido</small>
            </div>
            <div class="form-group">
                <label for="cliente-email"><i class="fas fa-asterisk required-icon"></i> Correo Electrónico del Cliente</label>
                <input type="email" id="cliente-email" name="cliente-email" value="<?php echo $clienteEmail;?>" required>
                <small>Error: Correo electrónico no válido</small>
            </div>
            <div class="form-group">
                <label for="cliente-telefono"><i class="fas fa-asterisk required-icon"></i> Número de Teléfono del Cliente</label>
                <input type="tel" id="cliente-telefono" placeholder="Incluya el código del país" name="cliente-telefono" value="<?php echo $clienteTelefono;?>" required>
                <small>Error: Número de teléfono requerido</small>
            </div>
            <h2>Detalles del beneficiario:</h2>
            <div class="form-group">
                <label for="beneficiario-nombre"><i class="fas fa-asterisk required-icon"></i> Nombre Completo del Beneficiario</label>
                <input type="text" id="beneficiario-nombre" name="beneficiario-nombre" value="<?php echo $beneficiarioNombre;?>" required>
                <small>Error: Nombre requerido</small>
            </div>
            <div class="form-group">
                <label for="beneficiario-telefono"><i class="fas fa-asterisk required-icon"></i> Número de Teléfono del Beneficiario</label>
                <input type="tel" id="beneficiario-telefono" placeholder="Incluya el código del país" name="beneficiario-telefono" value="<?php echo $beneficiarioTelefono;?>" required>
                <small>Error: Número de teléfono requerido</small>
            </div>
            <div class="form-group">
                <label for="beneficiario-direccion"><i class="fas fa-asterisk required-icon"></i> Dirección del Beneficiario</label>
                <input type="text" id="beneficiario-direccion" name="beneficiario-direccion" value="<?php echo $beneficiarioDireccion;?>" required>
                <small>Error: Dirección requerida</small>
            </div>
            <div class="form-group">
                <label for="provincia"><i class="fas fa-asterisk required-icon"></i> Provincia</label>
                <select id="provincia" name="provincia" required>
                    <option value="">Seleccione una provincia</option>
                </select>
                <small>Error: Seleccione una provincia</small>
            </div>
            <div class="form-group">
                <label for="municipio"><i class="fas fa-asterisk required-icon"></i> Municipio</label>
                <select id="municipio" name="municipio" required>
                    <option value="">Seleccione una provincia</option>
                </select>
                <small>Error: Seleccione un municipio</small>
            </div>
            <h2>Detalles del Servicio:</h2>
            <div class="form-group">
                <label for="service"><i class="fas fa-asterisk required-icon"></i> Servicio</label>
                <select id="service" name="service" required>
                </select>
                <small>Error: Seleccione un servicio</small>
                <input id="priceInput" type="hidden" value="" name="price" required>
            </div>
            <div class="form-group">
                <label for="date"><i class="fas fa-asterisk required-icon"></i> Fecha</label>
                <input type="date" id="date" name="date" min="<?php echo $fechaMin;?>" max="<?php echo $fechaMax;?>" required>
                <small>Error: Fecha requerida</small>
            </div>
            <div class="form-group">
                <label for="time"><i class="fas fa-asterisk required-icon"></i> Hora</label>
                <select id="time" name="time" required>
                    <option value="">Seleccione una fecha</option>
                </select>
                <small>Error: Hora requerida</small>
            </div>

            <div class="form-group">
                <label for="message">Mensaje Adicional</label>
                <textarea id="message" name="message"></textarea>
                <small></small>
            </div>
            <div class="form-group">
            <input class="inp-cbx" id="morning" type="checkbox" name="remember" checked />
            <label class="cbx" for="morning"><span>
                <svg width="12px" height="10px">
                  <use xlink:href="#check"></use>
                </svg></span><span>Recordar mi información para la próxima vez.</span></label>
            <input class="inp-cbx" id="noon" type="checkbox" name="boletin" checked />

            <label class="cbx" for="noon"><span>
                <svg width="12px" height="10px">
                  <use xlink:href="#check"></use>
                </svg></span><span>Envíame promociones y ofertas al correo.</span></label>
            <svg class="inline-svg">
              <symbol id="check" viewbox="0 0 12 10">
                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
              </symbol>
            </svg>
            </div>
            <button type="submit" onclick="confirmSend()">Continuar</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


</body>
</html>