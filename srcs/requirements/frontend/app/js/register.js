document.addEventListener("DOMContentLoaded", function() {
    var registerForm = document.getElementById('register');

    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch('http://localhost:3000/api/user/create', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('error:', error);
            });
        });
    }
});