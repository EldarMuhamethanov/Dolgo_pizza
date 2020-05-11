window.onload = function() {
    let form  = document.getElementsByTagName('form')[0];
    let error_block = document.getElementById('form_error_block');
    let fields = form.querySelectorAll('.text_input');
    form.addEventListener('submit', function (event) {
        isSuccess = true;
        for (let i = 0; i < fields.length; i++) {
            fields[i].classList.remove('text_input_incorrect');
            if (!fields[i].value) {
                isSuccess = false;
                fields[i].classList.add('text_input_incorrect');
            }
        }
        isSuccess = validateEmail(isSuccess);
        isSuccess = validateName(isSuccess);
        isSuccess = validateAddress(isSuccess);
        if (isSuccess) {
            error_block.classList.add('block_hidden');
            error_block.classList.remove('block_visible');   
        } else {
            event.preventDefault();
            error_block.classList.add('block_visible');
            error_block.classList.remove('block_hidden');
        }
    })
}

function validateEmail(isSuccess) {
    let email = document.getElementById('registration_form_email');
    let reg = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
    if (!reg.test(email.value)){
        isSuccess = false;
        email.classList.add('text_input_incorrect');
    }
    else
    {
        email.classList.remove('text_input_incorrect');
    }
    return isSuccess;
}

function validateName(isSuccess) {
    let name = document.getElementById('registration_form_name');
    let reg = /^[a-zа-я\s]+$/i;
    if (!reg.test(name.value)){
        isSuccess = false;
        name.classList.add('text_input_incorrect');
    }
    else
    {
        name.classList.remove('text_input_incorrect');
    }
    return isSuccess;
}

function validatePassword() {
    let password = document.getElementById('registration_form_password').value; // Получаем пароль из формы
    pass_message = document.querySelector('.about_pass');
    pass_message.classList.remove('easy_pass');
    pass_message.classList.remove('mid_pass');
    pass_message.classList.remove('strong_pass');
    pass_message.textContent = '';
    let s_letters = "qwertyuiopasdfghjklzxcvbnm"; // Буквы в нижнем регистре
    let b_letters = "QWERTYUIOPLKJHGFDSAZXCVBNM"; // Буквы в верхнем регистре
    let digits = "0123456789"; // Цифры
    let specials = "!@#$%^&*()_-+=\|/.,:;[]{}"; // Спецсимволы
    let is_s = false; // Есть ли в пароле буквы в нижнем регистре
    let is_b = false; // Есть ли в пароле буквы в верхнем регистре
    let is_d = false; // Есть ли в пароле цифры
    let is_sp = false; // Есть ли в пароле спецсимволы
    for (let i = 0; i < password.length; i++) {
      /* Проверяем каждый символ пароля на принадлежность к тому или иному типу */
      if (!is_s && s_letters.indexOf(password[i]) != -1) is_s = true;
      else if (!is_b && b_letters.indexOf(password[i]) != -1) is_b = true;
      else if (!is_d && digits.indexOf(password[i]) != -1) is_d = true;
      else if (!is_sp && specials.indexOf(password[i]) != -1) is_sp = true;
    }
    let rating = 0;
    let text = "";
    if (is_s) rating++; // Если в пароле есть символы в нижнем регистре, то увеличиваем рейтинг сложности
    if (is_b) rating++; // Если в пароле есть символы в верхнем регистре, то увеличиваем рейтинг сложности
    if (is_d) rating++; // Если в пароле есть цифры, то увеличиваем рейтинг сложности
    if (is_sp) rating++; // Если в пароле есть спецсимволы, то увеличиваем рейтинг сложности
    /* Далее идёт анализ длины пароля и полученного рейтинга, и на основании этого готовится текстовое описание сложности пароля */
    if (password.length < 6 && rating < 3) text = "Простой";
    else if (password.length < 6 && rating >= 3) text = "Средний";
    else if (password.length >= 8 && rating < 3) text = "Средний";
    else if (password.length >= 8 && rating >= 3) text = "Сложный";
    else if (password.length >= 6 && rating == 1) text = "Простой";
    else if (password.length >= 6 && rating > 1 && rating < 4) text = "Средний";
    else if (password.length >= 6 && rating == 4) text = "Сложный";
    if (text === 'Простой') {
        pass_message.classList.add('easy_pass');
        pass_message.textContent = 'Пароль: Простой';
    }   
    if (text === 'Средний') {
        pass_message.classList.add('mid_pass');
        pass_message.textContent = 'Пароль: Средний';
    }   
    if (text === 'Сложный') {
        pass_message.classList.add('strong_pass');
        pass_message.textContent = 'Пароль: Сложный';
    }   
}

function validateAddress(isSuccess){
    let address = document.getElementById('registration_form_address');
    let reg = /^[а-я\s.]+?\d+/i;
    if (!reg.test(address.value)){
        isSuccess = false;
        address.classList.add('text_input_incorrect');
    }
    else
    {
        address.classList.remove('text_input_incorrect');
    }
    return isSuccess;
}

