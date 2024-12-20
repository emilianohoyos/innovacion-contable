$(document).ready(function () {
    // Inicializa la validación del formulario
    $('#formEmployee').validate({
        rules: {
            documenttype_id: {
                required: true
            },
            identification: {
                required: true,
                maxlength: 20
            },
            firstname: {
                required: true,
                maxlength: 50
            },
            lastname: {
                required: true,
                maxlength: 50
            },

            job_title: {
                required: true
            },
            role: {
                required: true
            },
            cellphone: {
                required: true,
                digits: true,
                maxlength: 15
            },
            email: {
                required: true,
                email: true,
                maxlength: 100
            }
        },
        messages: {
            identification: {
                required: "Por favor ingrese la identificación.",
                maxlength: "La identificación no debe exceder los 20 caracteres."
            },
            firstname: {
                required: "Por favor ingrese el nombre.",
                maxlength: "El nombre no debe exceder los 50 caracteres."
            },
            lastname: {
                required: "Por favor ingrese el apellido.",
                maxlength: "El apellido no debe exceder los 50 caracteres."
            },
            cellphone: {
                required: "Por favor ingrese el número de celular.",
                digits: "Solo se permiten números.",
                maxlength: "El número de celular no debe exceder los 15 caracteres."
            },
            email: {
                required: "Por favor ingrese un correo electrónico.",
                email: "Por favor ingrese un correo electrónico válido.",
                maxlength: "El correo electrónico no debe exceder los 100 caracteres."
            }
        },
        submitHandler: function (form) {
            // Llama a tu función de guardado si el formulario es válido
            saveEmployee(event);
        }
    });
});

window.saveEmployee = function (e) {
    e.preventDefault();
    isLoading(true)
    // Captura el formulario
    const form = document.getElementById('formEmployee');

    // Crea un objeto FormData con los datos del formulario
    const formData = new FormData(form);

    // Envía los datos usando fetch
    fetch(pathCreateEmployee, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(result => {
            isLoading(false)
            Swal.fire({
                icon: 'success',
                title: 'Empleado registrado',
                text: 'El empleado se ha registrado exitosamente.',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                // Redirigir a la página de creación de empleado
                window.location.href = pathlistEmployee; // Ajusta la ruta si es necesario
            });
        })
        .catch(error => {
            isLoading(false)
            if (error.errors) {
                // Muestra los errores de validación al usuario
                console.error('Errores de validación:', error.errors);
                alert('Errores de validación: ' + JSON.stringify(error.errors));
            } else {
                alert('Error al registrar empleado');
            }
        });
}

window.isLoading = function (show) {
    const spinner = document.getElementById('loadingSpinner');
    if (show) {
        spinner.style.display = 'flex'; // Muestra el spinner
    } else {
        spinner.style.display = 'none'; // Oculta el spinner
    }
};
