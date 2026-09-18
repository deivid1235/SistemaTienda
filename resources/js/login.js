//Password de la vista 
const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');
const toggleIcon = document.getElementById('toggleIcon');

if (togglePassword) {
    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password'
            ? 'text'
            : 'password';
        passwordInput.setAttribute('type', type);

        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
    });
}