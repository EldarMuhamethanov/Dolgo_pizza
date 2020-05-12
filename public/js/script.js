window.onload = function() {
    let buyButtons = document.querySelectorAll('.buying');
    for (let i = 1;i <= buyButtons.length; i++) {
        let button = document.getElementById(`${i}`);
        button.addEventListener('click', () => buy(`${i}`));
    }
    let selectStatus = document.querySelectorAll('.status_select');
    for (let i = 0;i < selectStatus.length; i++) {
        let idStatus = selectStatus[i].id;
        let select = document.getElementById(idStatus);
        let id = idStatus.slice(13, idStatus.length);
        select.onblur = () => updateStatus(id, idStatus);
    }
};

async function updateStatus(id, idStatus)
{
    let n = document.getElementById(idStatus).options.selectedIndex;
    let value = document.getElementById(idStatus).options[n].text;
    let body = new FormData;
    body.append('status_id', id);
    body.append('new_value', value);
    await fetch('/update_status',
        {
            method: 'POST',
            body
        })
        .then(response => response.json())
        .then((data) =>  console.log(data));
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
    await fetch('/update_table')
        .then(response => response.text())
        .then((data) =>  new_tab = data);
    console.log(new_tab);
    let table = document.getElementById('order_table');
    table.innerHTML = new_tab;
} 