window.onload = async function () {
    let buyButtons = document.querySelectorAll('.buying');
    await updateOrders();
    for (let i = 0; i < buyButtons.length; i++) {
        buttonId = buyButtons[i].id;
        buyButtons[i] !== null ? buyButtons[i].addEventListener('click', () => buy(buttonId)) : null;
    }
    let updateButtons = document.querySelectorAll('.update');
    for (let i = 0; i < updateButtons.length; i++)
    {
        let thisButtonId = updateButtons[i].id;
        updateButtons[i] !== null ? updateButtons[i].addEventListener('click', () => updatePizza(thisButtonId)) : null;
    }
    let deleteButtons = document.querySelectorAll('.close_icon');
    for (let i = 0; i < deleteButtons.length; i++) {
        let thisButtonId = deleteButtons[i].id;
        deleteButtons[i] !== null ? deleteButtons[i].addEventListener('click', () => deletePizza(thisButtonId)) : null;
    }
    let selectStatus = document.querySelectorAll('.status_select');
    for (let i = 0; i < selectStatus.length; i++) {
        let idStatus = selectStatus[i].id;
        let select = document.getElementById(idStatus);
        let id = idStatus.slice(13, idStatus.length);
        select.onchange = () => updateStatus(id);
    }  
    let newPizzaPicture = document.getElementById('new_pizza_picture');
    newPizzaPicture.onblur = () => checkPicture(newPizzaPicture.value);
    /*const form = document.getElementById('add_pizza_form');
    form.addEventListener('submit', function(e) {
        wrongPicMessage = document.getElementById('wrong_pic_modal');
        if (!wrongPicMessage.style.hidden) {
            e.preventDefault();
        }

    });*/
}
async function checkPicture(newPizzaPicture) {
    let body = new FormData();
    body.append('image', newPizzaPicture);
        await fetch('/check/modal', {
            method: 'POST',
            body
        })
        .then(response => response.json())
        .then((data) => isWrongPicture = data['wrong_pic']);
        wrongPicMessage = document.getElementById('wrong_pic_modal');
        if (isWrongPicture) {
            wrongPicMessage.classList.remove('block_hidden');
            wrongPicMessage.classList.add('block_visible');
        } else {
            wrongPicMessage.classList.remove('block_visible');
            wrongPicMessage.classList.add('block_hidden');
        }
}
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
    id = id.slice(4, id.length)
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
    id = id.slice(7, id.length)
    let body = new FormData;
    body.append('id', id);
    let newTitle = document.getElementById(`pizza_name_${id}`).value;
    body.append('new_title', newTitle);
    let newDescription = document.getElementById(`pizza_description_${id}`).value;
    body.append('new_description', newDescription);
    let newCost = document.getElementById(`pizza_cost_${id}`).value;
    newCost = newCost.slice(3, newCost.indexOf('р'));
    body.append('new_cost', newCost);
    let newPic = document.getElementById(`pizza_pic_${id}`).value;
    newPic = newPic.slice(0, newPic.length - 4);
    body.append('new_pic', newPic);
    await fetch('/update/menu',
        {
            method: 'POST',
            body
        })
        .then(response => response.json())
        .then((data) => isWrongPic = data['wrong_pic']);
    let wrongPicMessage = document.getElementById(`wrong_pic_${id}`);
    if (isWrongPic) {
        wrongPicMessage.classList.remove('block_hidden');
        wrongPicMessage.classList.add('block_visible');
    } else {
        wrongPicMessage.classList.remove('block_visible');
        wrongPicMessage.classList.add('block_hidden');
        let pizzaImage = document.getElementById(`pizza_image_${id}`);
        pizzaImage.src = 'img/' + newPic + '.jpg'
    }
}

async function deletePizza(id) {
    id = id.slice(13, id.length)
    let body = new FormData();
    body.append('id_pizza', id)
    await fetch('/delete/pizza', {
        method: 'POST',
        body
    });
    let name = 'this_pizza_' + id;
    let deletedPizza = document.getElementById(name);
    deletedPizza.parentNode.removeChild(deletedPizza);

}
