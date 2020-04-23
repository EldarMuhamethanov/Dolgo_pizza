window.onload = function() {
    let buyButtons = document.querySelectorAll('.buying');
    for (let i = 1;i < buyButtons.length; i++) {
        let button = document.getElementById(`${i}`);
        button.addEventListener('click', () => buy(`${i}`));
    }
};
async function buy(id) {
    let body = new FormData;
    body.append('id', id);
    fetch('/get_orders',
        {
            method: 'POST',
            body
        })
        .then(response => response.json())
        .then((data) =>  console.log(data))
};