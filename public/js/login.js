document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    // Toggle password visibility
    togglePassword.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Update icon
        const eyeIcon = togglePassword.querySelector('img');
        eyeIcon.src = type === 'password' 
            ? 'https://api.iconify.design/lucide:eye.svg'
            : 'https://api.iconify.design/lucide:eye-off.svg';
    });
 
});


