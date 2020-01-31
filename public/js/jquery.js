$(document).ready(function () {
    $('#search').on('keyup', _.debounce(function (e) {
        // "this" refers to the value in #search  
        let value = $(this).val();

        $.ajax({
            type: 'GET',
            url: 'shop/search',
            data: {
             search : value,
            },

            success: function (data) {
              $('#shop').html(data);
              addListeners();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("AJAX error: " + textStatus + " : " + errorThrown + " " + jqXHR);
            },
        })
    }, 50));


    let cart = [];

    let totalPrice = 0;
    let totalPriceEl = document.querySelector('#totalPrice');
    totalPriceEl.innerHTML = totalPrice;


    function addValue() {

        let amountEl = $(this)
            .parent()
            .parent()
            .find('input');
        let amount = amountEl.val();
        let itemEl = $(this)
            .parents('.npc-item');
        let quantity = itemEl.data('quantity');
        amount = parseInt(amount, 10);
        amount += 1;
        amountEl.val(amount);
        console.log(amount, quantity)



        if (amount >= quantity) {
            $(this).prop('disabled', true);
            $(this).toggleClass('btn-disabled');
        }

    }

    function subtractValue() {

        let amountEl = $(this)
            .parent()
            .parent()
            .find('input');
        let amount = amountEl.val();
        amount = parseInt(amount, 10);
        if (amount > 1) {
            amountEl.val(amount - 1);
        }
    }


    function amountHandler(e) {
        let amount = $(this).val();
        amount = parseInt(amount, 10)
        if (amount < 1) {
            $(this).val(1);

        }

    }


    function actionHandler(e) {
        let itemEl = $(this)
            .parents('.npc-item');
        let itemId = itemEl.data('id');
        let quantity = itemEl.data('quantity');
        let amountEl = itemEl.find('input');
        let priceEl = itemEl.find('.price span');
        let amount = amountEl.val();
        let itemName = itemEl.find('.item-name').text().trim();

        let cartEl = $('body')
            .find('#cart');

        if (quantity === 0) {
            itemEl.toggleClass('item-disabled');
            console.log('voff');
        }

        if (amount <= quantity) {
            let newQuantity = quantity - amount;
            itemEl.data('quantity', newQuantity);
            itemEl.attr('data-quantity', newQuantity);
            itemEl.find('.quantity').text(newQuantity);

            // console.log(cartEl.find(`[data-id="${itemId}"]`))
            let cartItemEl = cartEl.find(`[data-id="${itemId}"]`);

            // Add to cart
            let index = _.findIndex(cart, ["name", itemName]);
            if (index !== -1) {
                cart[index]["amount"] += parseInt(amount, 10);
                console.log(cart[index]["amount"], parseInt(amount, 10))
            } else {
                cart.push({
                    "name": itemName,
                    "amount": parseInt(amount, 10)
                });
            }

            if (cartItemEl.length === 0) {
                $.ajax({
                    type: 'GET',
                    url: `/api/item/${itemId}/${amount}`,
                    //url: 'items/search',
                    success: function (data) {
                        $('#cart').append(data);
                        addListeners();
                        if (newQuantity === 0) {
                            itemEl.toggleClass('item-disabled');
                            console.log('voff');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("AJAX error: " + textStatus + " : " + errorThrown + " " + jqXHR);
                    },
                })
            } else {
                let cartItemAmount = cartItemEl.find('.amount').val();
                cartItemAmount = parseInt(cartItemAmount, 10);
                amount = parseInt(amount, 10);
                cartItemEl.find('.amount').val(cartItemAmount + amount);

                let cartItemPriceEl = cartItemEl.find('.price span');
                let cartItemPrice = cartItemPriceEl.text();
                let price = priceEl.text();
                price = parseInt(price, 10);

                cartItemPrice = parseInt(cartItemPrice, 10);
                price = price * amount;



                cartItemPriceEl.text(cartItemPrice + price);




            }
        }
        // let priceEl = itemEl.find('.price span');
        let price = priceEl.text();
        price = parseInt(price, 10);
        price = price * amount;
        totalPrice = totalPrice + price;
        totalPriceEl.innerHTML = totalPrice;
        console.log(totalPrice);
        amountEl.val(1);

    }

    function removeHandler() {
        let itemEl = $(this)
            .parents('.cart-item');
        console.log(itemEl)
        let shopEl = $('body')
            .find('#shop');
        let itemId = itemEl.data('id');
        console.log(itemId)
        let amount = itemEl.find('input').val();


        let shopItemEl = shopEl.find(`[data-id="${itemId}"]`);
        console.log(shopItemEl)
        let shopItemQuantity = shopItemEl.data('quantity');
        console.log(shopItemQuantity);
        amount = parseInt(amount, 10);
        let newQuantity = shopItemQuantity + amount;
        shopItemEl.data('quantity', newQuantity);
        shopItemEl.attr('data-quantity', newQuantity);
        shopItemEl.find('.quantity').text(newQuantity);
        shopItemEl.removeClass('item-disabled');

        shopItemQuantityAddBtnEl = shopItemEl.find('.quantity-add');
        $(shopItemQuantityAddBtnEl).prop('disabled', false);
        $(shopItemQuantityAddBtnEl).removeClass('btn-disabled');

        let itemName = itemEl.find('.item-name').text().trim();
        let index = _.findIndex(cart, ["name", itemName]);
        cart.splice(index, 1);

        itemEl.remove();
    }

    function cartAddValue() {
        //pekar på närmaste input elementet och lagrar det i en variabel
        let amountEl = $(this)
            .parent()
            .parent()
            .find('input');
        //lagrar value av input elementet i en variabel
        let amount = amountEl.val();
        //omvandlar string till INT
        amount = parseInt(amount, 10);
        amount += 1;

        //hämtar ut en rad som har klassen .cart-item
        //this är knappen
        let itemEl = $(this)
            .parents('.cart-item');
        //hämta ut shop, kunde ha varit body, html, w/e
        let shopEl = $('body')
            .find('#shop');
        let itemId = itemEl.data('id');
        // let amount = itemEl.find('input').val();


        let totalPriceEl = document.getElementById('totalPrice');

        let shopItemEl = shopEl.find(`[data-id="${itemId}"]`);
        let shopItemQuantity = shopItemEl.data('quantity');
        let newQuantity = shopItemQuantity - 1;
        let priceEl = shopItemEl.find('.price span');
        let cartEl = $('body')
            .find('#cart');
        let cartItemEl = cartEl.find(`[data-id="${itemId}"]`);
        let cartItemPriceEl = cartItemEl.find('.price span');
        let cartItemPrice = cartItemPriceEl.text();
        let price = priceEl.text();
        price = parseInt(price, 10);
        cartItemPrice = parseInt(cartItemPrice, 10);
        cartItemPriceEl.text(cartItemPrice + price);
        totalPrice = totalPrice + price;
        totalPriceEl.innerHTML = totalPrice;


        let itemName = itemEl.find('.item-name').text().trim();
        let index = _.findIndex(cart, ["name", itemName]);
        if (index !== -1) {
            cart[index]["amount"] += parseInt(amount, 10);
        }

        if (newQuantity < 0) {
            $(this).prop('disabled', true);
            $(this).addClass('btn-disabled');
        } else {
            //säger till valuen att den ska plussa på default värdet
            amountEl.val(amount);
            shopItemEl.data('quantity', newQuantity);
            shopItemEl.attr('data-quantity', newQuantity);
            shopItemEl.find('.quantity').text(newQuantity);

        }
    }

    function cartSubtractValue() {
        //pekar på närmaste input elementet och lagrar det i en variabel
        let amountEl = $(this)
            .parent()
            .parent()
            .find('input');
        //lagrar value av input elementet i en variabel
        let amount = amountEl.val();
        //omvandlar string till INT
        amount = parseInt(amount, 10);
        //säger till valuen att den ska plussa på default värdet
        amountEl.val(amount - 1);

        //hämtar ut en rad som har klassen .cart-item
        //this är knappen
        let itemEl = $(this)
            .parents('.cart-item');
        //hämta ut shop, kunde ha varit body, html, w/e
        let shopEl = $('body')
            .find('#shop');
        let itemId = itemEl.data('id');
        // let amount = itemEl.find('input').val();

        let shopItemEl = shopEl.find(`[data-id="${itemId}"]`);
        let shopItemQuantity = shopItemEl.data('quantity');
        amount = parseInt(amount, 10);
        let newQuantity = shopItemQuantity + 1;

        let addBtnEl = itemEl.find('.cart-quantity-add');
        addBtnEl.removeClass('btn-disabled');
        addBtnEl.prop('disabled', false);

        shopItemEl.data('quantity', newQuantity);
        shopItemEl.attr('data-quantity', newQuantity);
        shopItemEl.find('.quantity').text(newQuantity);

        // Reduce price when substracting an item from the cart
        let priceEl = shopItemEl.find('.price span');
        let cartEl = $('body')
            .find('#cart');
        let cartItemEl = cartEl.find(`[data-id="${itemId}"]`);
        let cartItemPriceEl = cartItemEl.find('.price span');
        let cartItemPrice = cartItemPriceEl.text();
        let price = priceEl.text();
        price = parseInt(price, 10);
        cartItemPrice = parseInt(cartItemPrice, 10);
        cartItemPriceEl.text(cartItemPrice - price);
        totalPrice = totalPrice - price;
        totalPriceEl.innerHTML = totalPrice;

        //
        if (amount <= 1) {
            itemEl.remove();
        }

        if (newQuantity >= 1) {
            shopItemEl.removeClass('item-disabled');

        }
    }

    const messageBoxList = {
        "welcome": [
            "Welcome, stranger. I have everything you require, right here.",
            "Welcome, stranger"
        ],
        "accept": [
            "Thank you for your purchase.",
            "Thank you for your purchase. I hope you're not my last customer."
        ],
        "decline": [

            "All right, buy something next time, will you? This stuff's heavy."
        ]
    };

    function setRandomMessage(type) {
        let randomIndex = Math.floor(Math.random() * messageBoxList[type].length);
        $('.messagebox-message').text(messageBoxList[type][randomIndex]);
    }
    setRandomMessage("welcome");

    function acceptPurchase() {
        setRandomMessage("accept");

        let dialog = $('#dialog');
        cart.forEach(item => {
            dialog.find('ul').append(`<li>${item.name} x ${item.amount}</li>`);
        });
        dialog.find('ul').after(`<p class="price text-center">Total cost: ${totalPrice}<img src="https://baby.yoda/images/gold.png" alt="Price" class="ml-1"></p> `);
        dialog.modal('show')

        cart = [];
        totalPrice = 0;
        totalPriceEl.innerHTML = totalPrice;
        $('body')
            .find('#cart')
            .html('');
    }

    function declinePurchase() {
        setRandomMessage("decline");

        let itemEl = $(this)
            .parents('.cart-item');
        console.log(itemEl)
        let itemId = itemEl.data('id');
        console.log(itemId)
        let amount = itemEl.find('input').val();

        let shopEl = $('body')
            .find('#shop');
        let shopItemEl = shopEl.find(`[data-id="${itemId}"]`);
        console.log(shopItemEl);
        let shopItemQuantity = shopItemEl.data('quantity');
        console.log(shopItemQuantity);
        amount = parseInt(amount, 10);
        let newQuantity = shopItemQuantity + amount;
        shopItemEl.data('quantity', newQuantity);
        shopItemEl.attr('data-quantity', newQuantity);
        shopItemEl.find('.quantity').text(newQuantity);
        console.log(newQuantity);

        $('body')
            .find('#cart')
            .html('');
        totalPrice = 0;
        totalPriceEl.innerHTML = totalPrice;
    }



    let elements = [{
            selector: '.quantity-add',
            event: 'click',
            handler: addValue
        },
        {
            selector: '.quantity-subtract',
            event: 'click',
            handler: subtractValue
        },
        {
            selector: '.amount',
            event: 'input',
            handler: amountHandler
        },
        {
            selector: '.btn-action',
            event: 'click',
            handler: actionHandler
        },
        {
            selector: '.btn-action-remove',
            event: 'click',
            handler: removeHandler
        },
        {
            selector: '.cart-quantity-add',
            event: 'click',
            handler: cartAddValue
        },
        {
            selector: '.cart-quantity-subtract',
            event: 'click',
            handler: cartSubtractValue
        },
        {
            selector: '#accept',
            event: 'click',
            handler: acceptPurchase
        },
        {
            selector: '#decline',
            event: 'click',
            handler: declinePurchase
        }
    ];



    // document.getElementById('totalPrice').innerHTML = totalPrice;
    // Loop over list of event handlers and attach events to present elements.

    $('#dialog').on('hidden.bs.modal', (e) => {
        $(e.target).find('ul').text('');
        $(e.target).find('p').text('');
    });

    function addListeners() {
        elements.forEach(item => {
            document
                .querySelectorAll(item.selector)
                .forEach(elt => {
                    $(elt).off(item.event)
                    $(elt).on(item.event, item.handler)
                });
        });
    }
    addListeners();
});
