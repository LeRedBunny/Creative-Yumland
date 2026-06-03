

function getCart () {
    /* Returns the cart. */
    const value = getCookie('cart');

    if (value === null) {
        return Array();
    } else {
        return JSON.parse(decodeURIComponent(value));
    }
}



function updateAmount (item, amount) {
    /* Changes the amount of an item in the cart. Returns the new amount. */

    let cart = getCart();

    if (item in cart) {
        cart[item] += amount;
    } else {
        cart[item] = amount;
    }

    if (cart[item] == 0) {
        removeItem(item);
        return 0;
    }

    setCookie('cart', JSON.stringify(cart));
    displayCart();
    return cart[item];
}



function removeItem (item) {
    /* Removes an item from the cart. */

    let cart = getCart();

    delete cart[item];

    setCookie('cart', JSON.stringify(cart));
    displayCart();
}

function countCart () {
    /* Counts the amount of items in the cart */
    const cart = getCart();
    let count = 0;
    for (const [_, amount] of Object.entries(cart)) {
        count += amount;
    }
    return count;
}


async function getPrice (item) {
    /* Returns the price of an item */

    const response = await fetch('../php/get_price.php?item=' + item);

    if (!response.ok) {
        throw new Error('Could not fetch resource.');
    }

    return parseFloat(await response.text());
}


async function displayCart () {
    /* Displays the cart */
    
    const cart = getCart();

    let string1 = '';
    let string2 = '';
    if (Object.keys(cart).length) {
        
        let total_price = 0;
        let price = 0;

        for (const [item, amount] of Object.entries(cart)) {

            price = await getPrice(item);
            total_price += price * amount;

            string1 += '<br> <tr> <td>' + item + ' - </td> <td>' + price + '€ </td> <td> ✕ </td> <td>' + cart[item] + '</td>';
            string1 += '<td> <button onclick="removeItem(\'' + item + '\');"> ✕ </button> </td>';
            string1 += '<td> <button onclick="updateAmount(\'' + item + '\', -1);"> - </button> </td>';
            string1 += '<td> <button onclick="updateAmount(\'' + item + '\', 1);"> + </button> </td> </tr>';
        }

        string2 += '<form method="post"> <br> <br> <div> Prix total: ' + total_price + '€</div>';
        string2 += "<select id='type' name='type'> <option value='livraison' selected> En livraison </option> <option value='emporter'> À emporter </option> <option value='sur place'> Sur place </option> </select>";
        string2 += '<input type="hidden" name="price" id="price" value="' + total_price + '">';
        string2 += "<button type='submit' value='pay' id='plat' name='plat'> Commander </button> </form>"; 

    } else {
        string1 = 'Votre panier est vide. <a href="carte.php"> Remplissez le vite! </a>';
    }

    let table = document.getElementById('cart');
    table.innerHTML = string1;

    let div = document.getElementById('order');
    div.innerHTML = string2;

    updateCartCount();
}


function updateCartCount () {
    /* Updates the number of items in the cart, displayed in the top right */
    const count = countCart();
    let link = document.getElementById('cart_link');
    if (count == 0) {
        link.innerHTML = 'Panier';
    } else {
        link.innerHTML = 'Panier (' + count + ')';
    }
}