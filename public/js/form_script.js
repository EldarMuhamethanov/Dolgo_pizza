window.onload = function() {
    let form  = document.getElementsByTagName('form')[0];
    let email = document.getElementById('registration_form_email');
    let name = document.getElementById('registration_form_name');
    let password = document.getElementById('registration_form_password');
    let error_block = document.getElementById('form_error_block');
    var fields = form.querySelectorAll('.text_input');
    form.addEventListener('submit', function (event) {
        success = true;
        for (var i = 0; i < fields.length; i++) {
            fields[i].classList.remove('text_input_incorrect');
            if (!fields[i].value) {
                event.preventDefault();
                success = false;
                fields[i].classList.add('text_input_incorrect');
            }
        }
        if (!validateEmail(email)){
            event.preventDefault();
            success = false;
            email.classList.add('text_input_incorrect');
        }
        if (!validateName(name)){
            event.preventDefault();
            success = false;
            name.classList.add('text_input_incorrect');
        }
    
        if (success) {
            error_block.classList.add('block_hidden');
            error_block.classList.remove('block_visible');   
        } else {
            error_block.classList.add('block_visible');
            error_block.classList.remove('block_hidden');
        }
    })
}

function validateEmail(email) {
    let reg = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
    return reg.test(email.value);
}

function validateName(name) {
    let reg = /^[a-zа-я\s]+$/i;
    return reg.test(name.value);
}