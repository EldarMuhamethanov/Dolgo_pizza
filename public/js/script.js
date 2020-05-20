window.onload = function () {
    let buyButtons = document.querySelectorAll('.buying');
    for (let i = 1; i <= buyButtons.length; i++) {
        let button = document.getElementById(`${i}`);
        button.addEventListener('click', () => buy(`${i}`));
    }
    let selectStatus = document.querySelectorAll('.status_select');
    for (let i = 0; i < selectStatus.length; i++) {
        let idStatus = selectStatus[i].id;
        let select = document.getElementById(idStatus);
        let id = idStatus.slice(13, idStatus.length);
        select.onblur = () => updateStatus(id);
    }
    highlightOrders();
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
    console.log(redirect_url);
    if (redirect_url) {
        document.location.href = redirect_url;
    } else {
        updateOrders();
        highlightOrders();
    }
}

async function updateOrders() {
    await fetch('/update_table')
        .then(response => response.text())
        .then((data) => new_tab = data);
    console.log(new_tab);
    let table = document.getElementById('order_table');
    table.innerHTML = new_tab;

}

async function highlightOrders() {
    let data_res;
    await fetch('/highlight_orders')
        .then(response => response.json())
        .then((data) => data_res = data);
    if (data_res['user'] === 'user') {
        let id_array = data_res['ids'];
        orders_array = document.getElementsByClassName('order_row');
        for (let j = 0; j < orders_array.length; j++) {
            id_order = orders_array[j].id.slice(6, orders_array[j].id.length);
            for (let i = 0; i < id_array.length; i++) {
                if (+id_order === id_array[i]) {
                    orders_array[j].classList.add('this_user_order');
                }
            }
        }
    }
}