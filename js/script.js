document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('reservation-form');
    const inputs = form.querySelectorAll('input, select, textarea');
    const menuToggle = document.getElementById('menu-toggle');
    const closeMenu = document.getElementById('close-menu');
    const nav = document.getElementById('nav');
    const dateInput = document.getElementById('date');
    const timeSelect = document.getElementById('time');

    menuToggle.addEventListener('click', () => {
        nav.classList.toggle('active');
    });

    closeMenu.addEventListener('click', () => {
        nav.classList.remove('active');
    });

    const showError = (input) => {
        const formGroup = input.parentElement;
        const error = formGroup.querySelector('small');
        error.style.visibility = 'visible';
    };

    const hideError = (input) => {
        const formGroup = input.parentElement;
        const error = formGroup.querySelector('small');
        error.style.visibility = 'hidden';
    };

    const validateInput = (input) => {
        if (input.type === 'email') {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(input.value.trim())) {
                showError(input);
                return false;
            }
        } else if (input.value.trim() === '') {
            showError(input);
            return false;
        }
        hideError(input);
        return true;
    };

});

    
    function obtenerMensajeDeServicio() {
        var servicio = document.getElementById('service').value;

        if (servicio) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'ajax/get_service_message.php?service=' + encodeURIComponent(servicio) + '&api=asfji657893248dsf**dsfdsf*asd', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.message) {
                        Swal.fire({
                            title: 'Información del Servicio',
                            html: response.message,
                            icon: 'info'
                        });
                    }
                }
            };
            xhr.send();
        }
    }


    document.getElementById('service').addEventListener('change', function() {
        obtenerMensajeDeServicio();
    });


function confirmSend() {
            
            const nameClienteInput = document.getElementById('cliente-nombre');
            const nameCliente = nameClienteInput.value;
            const emailClienteInput = document.getElementById('cliente-email');
            const emailCliente = emailClienteInput.value;
            const phoneClienteInput = document.getElementById('cliente-telefono');
            const phoneCliente = phoneClienteInput.value;
            
            const nameBeneficiarioInput = document.getElementById('beneficiario-nombre');
            const nameBeneficiario = nameBeneficiarioInput.value;
            const addressBeneficiarioInput = document.getElementById('beneficiario-direccion');
            const addressBeneficiario = addressBeneficiarioInput.value;
            const phoneBeneficiarioInput = document.getElementById('beneficiario-telefono');
            const phoneBeneficiario = phoneBeneficiarioInput.value;
            const provinciaBeneficiarioInput = document.getElementById('provincia');
            const provinciaBeneficiario = provinciaBeneficiarioInput.value;
            const municipioBeneficiarioInput = document.getElementById('municipio');
            const municipioBeneficiario = municipioBeneficiarioInput.value;
            
            const serviceInput = document.getElementById('service');
            const service = serviceInput.value;
            const dateInput = document.getElementById('date');
            const date = dateInput.value;
            const timeInput = document.getElementById('time');
            const time = timeInput.value;


            let valid = true;
            if (!nameCliente) {
                nameClienteInput.classList.add('input-error-border');
                valid = false;
            } else {
                nameClienteInput.classList.remove('input-error-border');
            }

            if (!emailCliente) {
                emailClienteInput.classList.add('input-error-border');
                valid = false;
            } else {
                emailClienteInput.classList.remove('input-error-border');
            }

            if (!phoneCliente) {
                phoneClienteInput.classList.add('input-error-border');
                valid = false;
            } else {
                phoneClienteInput.classList.remove('input-error-border');
            }

            if (!nameBeneficiario) {
                nameBeneficiarioInput.classList.add('input-error-border');
                valid = false;
            } else {
                nameBeneficiarioInput.classList.remove('input-error-border');
            }

            if (!addressBeneficiario) {
                addressBeneficiarioInput.classList.add('input-error-border');
                valid = false;
            } else {
                addressBeneficiarioInput.classList.remove('input-error-border');
            }

            if (!phoneBeneficiario) {
                phoneBeneficiarioInput.classList.add('input-error-border');
                valid = false;
            } else {
                phoneBeneficiarioInput.classList.remove('input-error-border');
            }

            if (!provinciaBeneficiario) {
                provinciaBeneficiarioInput.classList.add('input-error-border');
                valid = false;
            } else {
                provinciaBeneficiarioInput.classList.remove('input-error-border');
            }

            if (!municipioBeneficiario) {
                municipioBeneficiarioInput.classList.add('input-error-border');
                valid = false;
            } else {
                municipioBeneficiarioInput.classList.remove('input-error-border');
            }

            if (!service) {
                serviceInput.classList.add('input-error-border');
                valid = false;
            } else {
                serviceInput.classList.remove('input-error-border');
            }

            if (!date) {
                dateInput.classList.add('input-error-border');
                valid = false;
            } else {
                dateInput.classList.remove('input-error-border');
            }

            if (!time) {
                timeInput.classList.add('input-error-border');
                valid = false;
            } else {
                timeInput.classList.remove('input-error-border');
            }

            if (!valid) {

                    window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                    });

                Swal.fire({
                      title: "Campos requeridos",
                      text: "Faltan campos requeridos",
                      icon: "error",
                      buttons: {
                        confirm: {
                          className: "button-alert"
                        }
                      }
                    });
                return;
            }

    const formulario = document.getElementById('reservation-form');


    formulario.submit();

}


function cargarProvincias() {

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var provincias = JSON.parse(this.responseText);
            

            var selectProvincias = document.getElementById("provincia");


            
            provincias.forEach(function(provincia) {
                var option = document.createElement("option");

                
                var value = provincia.provincia.replace(/\s+/g, '').toLowerCase();
                var text = provincia.provincia.toLowerCase().replace(/\b\w/g, function(l) {
                    return l.toUpperCase();
                });

                option.value = value;
                option.text = text;
                selectProvincias.appendChild(option);
            });
        }
    };
    xhr.open("GET", "ajax/provincias.php?key=asdffdg3456rtgfdg5423*fdsf4", true);
    xhr.send();
}


document.addEventListener("DOMContentLoaded", function() {
    cargarProvincias();
});



function cargarMunicipios() {
    
    var provinciaSeleccionada = document.getElementById("provincia").value;

    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            var municipios = JSON.parse(this.responseText);
            
            
            var selectMunicipios = document.getElementById("municipio");

            
            selectMunicipios.innerHTML = "";

            var option = document.createElement("option");
            option.value = "";
            option.selected = "";
            option.text = "Seleccione un municipio.";
            selectMunicipios.appendChild(option);

            
            municipios.forEach(function(municipio) {
                var option = document.createElement("option");

                
                var value = municipio.municipio.replace(/\s+/g, '').toLowerCase();
                
                
                var text = municipio.municipio.toLowerCase().replace(/\b\w/g, function(l) {
                    return l.toUpperCase();
                });

                option.value = value;
                option.text = text;
                selectMunicipios.appendChild(option);
            });
        }
    };
    xhr.open("GET", "ajax/municipios.php?api=dashgfdsg546789234**adf8&provincia=" + provinciaSeleccionada, true);
    xhr.send();
}


document.addEventListener("DOMContentLoaded", function() {
    
    document.getElementById("provincia").addEventListener("change", cargarMunicipios);
});


function cargarServicios() {
    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            var servicios = JSON.parse(this.responseText);
            
            
            var selectServicios = document.getElementById("service");

            
            selectServicios.innerHTML = "";

            
            var optionDefault = document.createElement("option");
            optionDefault.value = "";
            optionDefault.text = "Seleccione un servicio";
            selectServicios.appendChild(optionDefault);

            
            servicios.forEach(function(servicio) {
                var option = document.createElement("option");
                option.value = servicio.valor;
                option.text = `${servicio.texto} ($${servicio.precio})`;
                selectServicios.appendChild(option);
            });
        }
    };
    xhr.open("GET", "ajax/servicios.php?api=adshfdgdg75467834592*shdjf44f3", true);
    xhr.send();

    selectServiceFromUrlWithDelay();
}


document.addEventListener("DOMContentLoaded", function() {

    cargarServicios();
});


function selectServiceFromUrlWithDelay() {
  setTimeout(() => {

    const urlParams = new URLSearchParams(window.location.search);
    const serviceValue = urlParams.get('service');

    if (serviceValue) {
      const select = document.getElementById('service');
      select.value = serviceValue;
      actualizarPrecio();
    }
  }, 2500);
}


    function actualizarPrecio(){
    var selectServicios = document.getElementById('service');
    var inputPrecio = document.getElementById('priceInput');


        var selectedOptionText = selectServicios.options[selectServicios.selectedIndex].text;


        var regex = /\((\$\d+\.\d{2})\)/;
        var match = selectedOptionText.match(regex);

        actualizarHorarios()

        if (match && match[1]) {
            
            var precio = match[1].replace('$', '');
            inputPrecio.value = precio; 
        } else {
            inputPrecio.value = ""; 
        }
    }



document.getElementById("service").addEventListener("change", actualizarPrecio);






document.addEventListener('DOMContentLoaded', function() {
    
    var urlParams = new URLSearchParams(window.location.search);
    var servicio = urlParams.get('service');

    
    if (servicio) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'ajax/get_service_message.php?service=' + encodeURIComponent(servicio) + '&api=asfji657893248dsf**dsfdsf*asd', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.message) {
                    Swal.fire({
                        title: 'Información del Servicio',
                        html: response.message,
                        icon: 'info'
                    });
                }
            }
        };
        xhr.send();
    }
});




function actualizarHorarios() {
    
    const fechaInput = document.getElementById('date');
    const horaInput = document.getElementById('time');
    const serviceInput = document.getElementById('service');
    const municipioInput = document.getElementById('municipio');

    
    const fecha = fechaInput.value;
    const service = serviceInput.value;
    const municipio = municipioInput.value;

    
    const [year, month, day] = fecha.split('-');
    const formattedDate = `${day}-${month}-${year}`;

    console.log('Fecha original:', fecha);
    console.log('Fecha formateada:', formattedDate);
    console.log('Servicio:', service);
    console.log('Municipio:', municipio);

    
    horaInput.innerHTML = '';

    
    if (fecha && service && municipio) {
        
        const requestUrl = `ajax/get_available_times.php?date=${formattedDate}&service=${service}&municipio=${municipio}&apiKey=Fdsreedsfdg478574gdfhf46h8748h7gfh2dg2hdfgdfsg5`;

        console.log('URL de la solicitud:', requestUrl);

        
        const xhr = new XMLHttpRequest();

        
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    const availableTimes = response.availableTimes;

                    if (Array.isArray(availableTimes)) {
                        
                        const primerValor = availableTimes[0];
                        if (primerValor === "No hay espacio en la fecha seleccionada.") {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Alerta',
                                text: 'No hay espacio en la fecha seleccionada.',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    
                                    obtenerMensajeDeServicio();

                                    
                                    Swal.close();
                                }
                            });
                        }

                        
                        availableTimes.forEach(timeSlot => {
                            const option = document.createElement('option');
                            option.setAttribute('value', timeSlot);
                            option.textContent = timeSlot;
                            horaInput.appendChild(option);
                        });

                    } else {
                        console.error('availableTimes no es un array:', availableTimes);
                    }
                } catch (e) {
                    console.error('Error al analizar la respuesta JSON:', e);
                }
            } else {
                console.error('Error al obtener los horarios disponibles');
            }
        };

        
        xhr.onerror = function() {
            console.error('Error de red al intentar la solicitud AJAX');
        };

        
        xhr.open('GET', requestUrl, true);
        xhr.send();

    } else {
        
        horaInput.innerHTML = '<option value="">Complete el resto del formulario antes.</option>';
    }
}


document.getElementById('date').addEventListener('change', function() {
    actualizarHorarios()
});



document.getElementById('municipio').addEventListener('change', function() {
    actualizarHorarios()
});