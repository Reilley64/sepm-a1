var cart = JSON.parse(localStorage.getItem("cart"));
if (cart == null) {
    cart = [];
}

function addItem(item) {
    if (typeof item == "string") {
        item = JSON.parse(item);
    }

    var radios = document.getElementsByName(item.name);
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            cart.push(item.id + ":" + radios[i].value);
        }
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartLength();
}

function clearItem(id) {
    for (var i = 0; i < cart.length; i++) {
        if (cart[i] == id) {
            cart.splice(i, 1);
            break;
        }
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    location.reload();
}

function radioChange(item, size) {
    if (typeof item == "string") {
        item = JSON.parse(item);
    }

    switch (size) {
        case "S":
            document.getElementById(item.name).innerHTML = item.sprice;
            break;

        case "M":
            document.getElementById(item.name).innerHTML = item.mprice;
            break;

        case "L":
            document.getElementById(item.name).innerHTML = item.lprice;
            break;
    }
}

function updateCartLength() {
    document.getElementById("cartlength").innerHTML = cart.length;
}