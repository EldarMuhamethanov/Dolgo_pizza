window.onload = function () {
    let buyButtons = document.querySelectorAll('.buying');
    for (let i = 1; i < buyButtons.length; i++) {
        let button = document.getElementById(`${i}`);
        button.addEventListener('click', () => buy(`${i}`));
    }
};

async function buy() {
    await fetch('/get_orders',
        {
            method: 'POST',
        })
        .then(response => response.text())
    updateOrders();
}

async function updateOrders() {
    let newHTML = '';
    await fetch('/')
        .then(response => response.text())
        .then((data) => {
            newHTML = data.slice(data.indexOf('<table'), data.indexOf('</table>') + 8);
        });
    let tableOrders = document.getElementById('order_table');
    tableOrders.innerHTML = newHTML;
}