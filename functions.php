<?php  


function boletin($name, $correo, $mysqli_insert) {

	$fecha = date('d-m-Y');


	$comprobarConsult = "SELECT correo FROM maillist  WHERE correo = '$correo'";
	$comprobarDued = mysqli_query($mysqli_insert, $comprobarConsult);
	$comprobar = mysqli_fetch_array($comprobarDued);

	if (!@$comprobar['correo']) {
		$consult = "INSERT INTO maillist (nombre, correo, fecha) VALUES ('$name', '$correo', '$fecha')";
		$insert = mysqli_query($mysqli_insert, $consult);
	}


}

function rememberMe($clienteNombre, $clienteEmail, $clienteTelefono, $beneficiarioNombre, $beneficiarioDireccion, $beneficiarioTelefono, $provincia, $municipio, $mysqli_insert) {

	$cookie_time = time() + (30 * 24 * 60 * 60);

    setcookie('clienteNombre', $clienteNombre, $cookie_time, "/");
    setcookie('clienteEmail', $clienteEmail, $cookie_time, "/");
    setcookie('clienteTelefono', $clienteTelefono, $cookie_time, "/");
    setcookie('beneficiarioNombre', $beneficiarioNombre, $cookie_time, "/");
    setcookie('beneficiarioDireccion', $beneficiarioDireccion, $cookie_time, "/");
    setcookie('beneficiarioTelefono', $beneficiarioTelefono, $cookie_time, "/");
    setcookie('provincia', $provincia, $cookie_time, "/");
    setcookie('municipio', $municipio, $cookie_time, "/");
    setcookie('municipio', $municipio, $cookie_time, "/");
    

}


function formatearFecha($fecha) {
    
    $fecha = DateTime::createFromFormat('d-m-Y', $fecha);
    
    
    setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain', 'Spanish');
    
    
    $fecha_formateada = strftime("%A, %e de %B del %Y", $fecha->getTimestamp());
    
    return $fecha_formateada;
}

function formatearHora($hora) {
    
    $hora = DateTime::createFromFormat('H:i', $hora);
    
    
    $hora_formateada = $hora->format('h:i A');
    
    return $hora_formateada;
}



?>