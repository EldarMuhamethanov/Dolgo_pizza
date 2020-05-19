/*window.onload = function() {
    let form  = document.getElementById('login_form');
    form.addEventListener('submit', function (event) {
        const formData = new FormData(this);
        await fetch('/checkExist',
        {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then((data) => console.log(data));
    })
}*/