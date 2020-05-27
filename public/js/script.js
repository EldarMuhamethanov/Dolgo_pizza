window.onload = async function () {
    let buyButtons = document.querySelectorAll('.buying');
    await updateOrders();
    for (let i = 1; i <= buyButtons.length; i++) {
        let button = document.getElementById(`${i}`);
        let buttonChange = document.getElementById(`change_${i}`);
        button !== null ? button.addEventListener('click', () => buy(`${i}`)) : null;
        buttonChange !== null ? buttonChange.addEventListener('click', () => updatePizza(`${i}`)) : null;
    }
    let selectStatus = document.querySelectorAll('.status_select');
    for (let i = 0; i < selectStatus.length; i++) {
        let idStatus = selectStatus[i].id;
        let select = document.getElementById(idStatus);
        let id = idStatus.slice(13, idStatus.length);
        select.onchange = () => updateStatus(id);
    }  
};

async function updateStatus(id) {
    let n = document.getElementById('status_select' + id).options.selectedIndex;
    let value = document.getElementById('status_select' + id).options[n].text;
    let body = new FormData;
    console.log(id);
    body.append('status_id', id);
    body.append('new_value', value);
    await fetch('/update_status',
        {
            method: 'POST',
            body
        })
        .then(response => response.json())
        .then((data) => console.log(data));
}

async function buy(id) {
    let body = new FormData;
    body.append('id', id);
    await fetch('/get_orders',
        {
            method: 'POST',
            body
        })
        .then(response => response.json())
        .then((data) => redirect_url = data['redirect_url']);
    if (redirect_url) {
        document.location.href = redirect_url;
    } else {
        await updateOrders();
    }
}

async function updateOrders() {
    await fetch('/order/table')
        .then(response => response.text())
        .then((data) => new_tab = data);
    console.log(new_tab);
    let table = document.getElementById('order_table');
    table.innerHTML = new_tab;
}

async function updatePizza(id) {
    let body = new FormData;
    body.append('id', id);
    let newTitle = document.getElementById(`pizza_name_${id}`).value;
    body.append('new_title', newTitle);
    let newDescription = document.getElementById(`pizza_description_${id}`).value;
    body.append('new_description', newDescription);
    let newCost = document.getElementById(`pizza_cost_${id}`).value;
    newCost = newCost.slice(3, newCost.indexOf('р'));
    body.append('new_cost', newCost);
    await fetch('/update/menu',
        {
            method: 'POST',
            body
        })
}