const form = document.getElementById('register-form');
const passwordInput = document.getElementById('password');

form.addEventListener('submit', (e) => {
    const passwordValue = passwordInput.value.trim();
    if (passwordValue.length < 8) {
        alert('Password must be at least 8 characters long');
        e.preventDefault();
    }
});