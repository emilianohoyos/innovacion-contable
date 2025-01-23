$(document).ready(function () {
    // Inicializa la validación del formulario
    if ($('#formEmployee').length) {
        $('#formEmployee').validate({
            rules: {
                document_type_id: {
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
                document_type_id: {
                    required: "Por favor Seleccione el tipo de documento."
                },

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
                job_title: {
                    required: "Por favor ingrese el cargo"
                },
                role: {
                    required: "Por favor ingrese el rol"
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
            errorPlacement: function (error, element) {
                // Inserta el mensaje de error debajo del campo
                error.insertAfter(element);

                // Agrega el asterisco al label si no está ya
                const label = $(`label[for="${element.attr('id')}"]`);
                if (!label.find('.error-asterisk').length) {
                    label.append('<span class="error-asterisk" style="color: red;"> *</span>');
                }
            },
            success: function (label, element) {
                // Elimina el asterisco si el campo ya no tiene errores
                const labelElement = $(`label[for="${element.id}"] .error-asterisk`);
                if (labelElement.length) {
                    labelElement.remove();
                }
            },
            submitHandler: function (form) {
                // Llama a tu función de guardado
                saveEmployee(event);
            }
        });

    } else {
        console.log("El formulario no existe en el DOM.");
    }

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

window.editEmployee = function (id) {
    // Obtener los datos del empleado
    document.getElementById('formEditEmployee').reset();
    $('#job_title').val('').trigger('change');
    $('#role').val('').trigger('change');
    fetch('/employee' + '/' + id)
        .then(response => response.json())
        .then(data => {
            document.getElementById('id').value = data.data.id;
            document.getElementById('document_type_id').value = data.data.document_type_id;
            document.getElementById('nit').value = data.data.identification;
            document.getElementById('firstname').value = data.data.firstname;
            document.getElementById('lastname').value = data.data.lastname;
            $('#job_title').val(data.data.job_title).trigger('change');
            $('#role').val(data.data.role).trigger('change');
            // document.getElementById('job_title').value = data.data.job_title;
            // document.getElementById('role').value = data.data.role;
            document.getElementById('cellphone').value = data.data.cellphone;
            document.getElementById('email').value = data.data.email;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al obtener los datos del empleado');
        });

    // Obtener el modal por su ID
    var myModal = new bootstrap.Modal(document.getElementById('editModal'));
    // Mostrar el modal
    myModal.show();

    const form = document.getElementById('formEditEmployee');
    form.onsubmit = function (event) {
        event.preventDefault();
        isLoading(true)

        const formData = new FormData(form);
        // formData.append('_method', 'PUT');

        fetch('/employee/' + id, {
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
                myModal.hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Empleado actualizado',
                    text: 'El empleado se ha actualizado exitosamente.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    // Redirigir a la página de creación de empleado
                    if ($.fn.DataTable.isDataTable('#tblEmployees')) {
                        $('#tblEmployees').DataTable().ajax.reload(null, false); // false evita que se reinicie la paginación
                    } else {
                        console.error("El DataTable no está inicializado.");
                    }
                });
            })
            .catch(error => {
                isLoading(false)
                if (error.errors) {
                    // Muestra los errores de validación al usuario
                    console.error('Errores de validación:', error.errors);
                    alert('Errores de validación: ' + JSON.stringify(error.errors));
                } else {
                    alert('Error al actualizar empleado');
                }
            });
    }
}

window.disableEmployee = function (id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "El empleado será desactivado y no podrá iniciar sesión en el sistema.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, desactivar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('/employee/disable/' + id, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            }).then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            }).then(result => {
                if ($.fn.DataTable.isDataTable('#tblEmployees')) {
                    $('#tblEmployees').DataTable().ajax.reload(null, false); // false evita que se reinicie la paginación
                } else {
                    console.error("El DataTable no está inicializado.");
                }
                Swal.fire({
                    icon: 'success',
                    title: 'Empleado desactivado',
                    text: 'El empleado se ha desactivado exitosamente.',
                    confirmButtonText: 'Aceptar'
                })
            })


        }

    })
}

window.activeEmployee = function (id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "El empleado será Activado y  podrá iniciar sesión en el sistema.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Activar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('/employee/active/' + id, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            }).then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            }).then(result => {
                if ($.fn.DataTable.isDataTable('#tblEmployees')) {
                    $('#tblEmployees').DataTable().ajax.reload(null, false); // false evita que se reinicie la paginación
                } else {
                    console.error("El DataTable no está inicializado.");
                }
                Swal.fire({
                    icon: 'success',
                    title: 'Empleado Se ha activado',
                    text: 'El empleado se ha Activado exitosamente.',
                    confirmButtonText: 'Aceptar'
                })
            })


        }

    })
}
