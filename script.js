document.addEventListener('DOMContentLoaded', function() {
    var userTypeSelect = document.querySelector('[name="userType"]');
    userTypeSelect.addEventListener('change', function() {
        // Envía el formulario automáticamente cuando cambia la opción
        this.form.submit();
    });
});