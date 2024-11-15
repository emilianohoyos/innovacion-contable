

$(document).ready(function () {

    // Inicializa la validación del formulario
    $('#formApplyDocumentType').validate({
        rules: {
            name: {
                required: true
            },
            apply_type_id: {
                required: true
            },
            is_required: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Por favor ingrese El nombre .",

            },
            apply_type_id: {
                required: "Por favor Seleccione el tipo de solicitud correspondiente."
            },
            is_required: {
                required: "Por favor Selecciona si es requerido",
            }
        },
        submitHandler: function (form) {
            // Llama a tu función de guardado si el formulario es válido
            save(event);
        }
    });
});

window.save = function (e) {
    e.preventDefault();
    isLoading(true)
    // Captura el formulario
    const form = document.getElementById('formApplyDocumentType');

    // Crea un objeto FormData con los datos del formulario
    const formData = new FormData(form);

    // Envía los datos usando fetch
    fetch(pathCreate, {
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
                title: 'Se ha creado el tipo de solicitud',
                text: 'El tipo de solicitud se ha registrado exitosamente.',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                // Redirigir a la página de creación de empleado
                window.location.href = pathlist; // Ajusta la ruta si es necesario
            });
        })
        .catch(error => {
            isLoading(false)
            if (error.errors) {
                // Muestra los errores de validación al usuario
                console.error('Errores de validación:', error.errors);
                alert('Errores de validación: ' + JSON.stringify(error.errors));
            } else {
                alert('Error al registrar tipo de solicitud');
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
