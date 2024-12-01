document.getElementById('g').addEventListener('click', function () {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password');
    var cpassword = document.getElementById('cpassword');

    if (!name || !email || !password.value || !cpassword.value) {
        alert('Please fill in all fields!');
        return;
    }
    if (password.length >= 8 ){
        if (password.value === cpassword.value){
            alert('Registration successful!');
        }
    }
    console.log('User registered:', userData);

    alert('Registration successful!');

    window.location.href = 'Home.html';
});