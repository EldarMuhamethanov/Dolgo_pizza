window.onload = function() {
    let buyButtons = document.querySelectorAll('.buying');
    for (let i = 1;i <= buyButtons.length; i++) {
        let button = document.getElementById(`${i}`);
        button.addEventListener('click', () => buy(`${i}`));
    }
};
async function buy(id) {
    let body = new FormData;
    body.append('id', id);
    await fetch('/get_orders',
        {
            method: 'POST',
            body
        })
        .then(response => response.json())
        .then((data) =>  redirect_url = data['redirect_url']);
    console.log(redirect_url);
    if (redirect_url)
    {
        document.location.href = redirect_url;
    }
    else
    {
        updateOrders();
    }
}

async function updateOrders() {
    let newHTML = '';
    await fetch('/update_table')
        .then(response => response.text())
        .then((data) =>  new_tab = data);
    console.log(new_tab);
    let table = document.getElementById('order_table');
    table.innerHTML = new_tab;
} 