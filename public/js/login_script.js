window.onload = function() {
    let form  = document.getElementById('login_form');
    let fields = form.querySelectorAll('.text_input');
    let email_field = document.getElementById('login_username');
    email_field.onblur = validateEmail;
    form.addEventListener('submit', function (e) {
        isFiled = true;
        for (let i = 0; i < fields.length; i++) {
            fields[i].classList.remove('text_input_incorrect');
            if (!fields[i].value) {
                isFiled = false;
                fields[i].classList.add('text_input_incorrect');
            }
        }
        emailIsValid = validateEmail();
        if (!(emailIsValid && isFiled))
        {
            e.preventDefault();
        }
    })
}

function validateEmail() {
    let email = document.getElementById('login_username');
    let reg = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
    if (!reg.test(email.value)){
        isSuccess = false;
        email.classList.add('text_input_incorrect');
    }
    else
    {
        isSuccess = true;
        email.classList.remove('text_input_incorrect');
    };
    return isSuccess;
}