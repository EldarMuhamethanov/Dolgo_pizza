window.onload = function() {
    let buyButtons = document.querySelectorAll('.buying');
    for (let i = 1;i <= buyButtons.length; i++) {
        let button = document.getElementById(`${i}`);
        button.addEventListener('click', () => buy(`${i}`));
        button.addEventListener('click', updateOrders);
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
        .then((data) =>  console.log(data));
}

async function updateOrders() {
    let newHTML = '';
    await fetch('/')
        .then(response => response.text())
        .then((data) =>  {
            newHTML = data.slice(data.indexOf('<table'), data.indexOf('</table>') + 8);
        });
    let table = document.getElementById('order_table');
    table.innerHTML = newHTML;
} 