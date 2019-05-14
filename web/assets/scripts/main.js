var cart = JSON.parse(localStorage.getItem("cart"));
if (cart == null) {
    cart = [];
}

function addItemToCart(item) {
    if (typeof item == "string") {
        item = JSON.parse(item);
    }

    var radios = document.getElementsByName(item.name);
    if (radios[0] != null) {
        console.log(radios);
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                cart.push(item.id + ":" + radios[i].value);
            }
        }
    } else {
        cart.push(item.id);
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartLength();
}

function clearCart() {
    cart = [];
    localStorage.setItem("cart", JSON.stringify(cart));
}

Date.prototype.addHours = function(h) {
    this.setTime(this.getTime() + (h*60*60*1000));
    return this;
}

function getTimeDiff(datetime) {
    var datetime = typeof datetime !== 'undefined' ? datetime : "2014-01-01 01:02:03.123456";

    var datetime = new Date(datetime).getTime();
    var now = new Date().getTime();

    if (isNaN(datetime)) {
        return "";
    }

    console.log(datetime + " " + now);

    if (datetime < now) {
        var milisec_diff = now - datetime;
    } else {
        var milisec_diff = datetime - now;
    }

    var days = Math.floor(milisec_diff / 1000 / 60 / (60 * 24));

    var date_diff = new Date(milisec_diff);

    return days + " Days " + date_diff.getHours() + " Hours " + date_diff.getMinutes() + " Minutes " + date_diff.getSeconds() + " Seconds";
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

function removeItemFromCart(id) {
    for (var i = 0; i < cart.length; i++) {
        if (cart[i] === id) {
            cart.splice(i, 1);
            break;
        }
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    location.reload();
}

function updateCartLength() {
    var elms = document.getElementsByClassName("cart-length");
    for (var i = 0; i < elms.length; i++) {
        elms[i].innerHTML = cart.length;
    }
}

function updateCartPrice(cartPrice) {
    var elms = document.getElementsByClassName("cart-price");
    for (var i = 0; i < elms.length; i++) {
        elms[i].innerHTML = cartPrice;
    }
}
