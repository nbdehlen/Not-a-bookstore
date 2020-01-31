import _API from "./api.js";

$(document).ready(() => {
    let cart = [];

    function search() {
        let value = $("#search")
            .val()
            .trim();

        _API.trader.search(value, data => {
            $("#shop").html(data);
            addListeners();
        });
    }
    $(".search button").on("click", () => {
        search();
    });

    $("#search").on("keyup", e => {
        if (e.which !== 13) return;
        search();
    });

    function traderAddValue() {
        let amountEl = $(this)
            .parent()
            .parent()
            .find("input");
        let amount = amountEl.val();
        let itemEl = $(this).parents(".npc-item");
        let quantity = itemEl.data("quantity");

        amount = parseInt(amount, 10);
        amount += 1;
        amountEl.val(amount);

        if (amount >= quantity) {
            $(this).prop("disabled", true);
            $(this).toggleClass("btn-disabled");
        }
    }

    function traderSubtractValue() {
        let addBtnEl = $(this)
            .parent()
            .parent()
            .find(".quantity-add");
        let amountEl = $(this)
            .parent()
            .parent()
            .find("input");
        let amount = amountEl.val();

        amount = parseInt(amount, 10);
        if (amount > 1) {
            amountEl.val(amount - 1);
        }

        addBtnEl.prop("disabled", false);
        addBtnEl.removeClass("btn-disabled");
    }

    function addHandler(e) {
        const itemEl = $(this).parents(".npc-item");
        const itemId = itemEl.data("id");
        const amountEl = itemEl.find("input");
        const amount = amountEl.val();

        _API.trader.addToCart(itemId, amount, data => {
            // $("#cart").append(data);
            // addListeners();
            // if (newQuantity === 0) {
            //     itemEl.toggleClass("item-disabled");
            // }
        });

        // let itemEl = $(this).parents(".npc-item");
        // let itemId = itemEl.data("id");
        // let quantity = itemEl.data("quantity");
        // let amountEl = itemEl.find("input");
        // let priceEl = itemEl.find(".price span");
        // let amount = amountEl.val();
        // let cartEl = $("body").find("#cart");
        // if (quantity === 0) {
        //     itemEl.toggleClass("item-disabled");
        // }
        // if (amount <= quantity) {
        //     let newQuantity = quantity - amount;
        //     itemEl.data("quantity", newQuantity);
        //     itemEl.attr("data-quantity", newQuantity);
        //     itemEl.find(".quantity").text(newQuantity);
        //     // console.log(cartEl.find(`[data-id="${itemId}"]`))
        //     let cartItemEl = cartEl.find(`[data-id="${itemId}"]`);
        //     if (cartItemEl.length === 0) {
        //         // Add item to cart
        //         _API.trader.addToCart(itemId, amount, data => {
        //             $("#cart").append(data);
        //             addListeners();
        //             if (newQuantity === 0) {
        //                 itemEl.toggleClass("item-disabled");
        //             }
        //         });
        //     } else {
        //         let cartItemAmount = cartItemEl.find(".amount").val();
        //         cartItemAmount = parseInt(cartItemAmount, 10);
        //         amount = parseInt(amount, 10);
        //         cartItemEl.find(".amount").val(cartItemAmount + amount);
        //         let cartItemPriceEl = cartItemEl.find(".price span");
        //         let cartItemPrice = cartItemPriceEl.text();
        //         let price = priceEl.text();
        //         price = parseInt(price, 10);
        //         cartItemPrice = parseInt(cartItemPrice, 10);
        //         price = price * amount;
        //         cartItemPriceEl.text(cartItemPrice + price);
        //         // Update amount in cart
        //         _API.trader.addToCart(itemId, amount);
        //     }
        // }
        // amountEl.val(1);
    }

    function removeHandler() {
        let itemEl = $(this).parents(".cart-item");
        let shopEl = $("body").find("#shop");
        let itemId = itemEl.data("id");
        let amount = itemEl.find("input").val();

        let shopItemEl = shopEl.find(`[data-id="${itemId}"]`);
        let shopItemQuantity = shopItemEl.data("quantity");
        amount = parseInt(amount, 10);
        let newQuantity = shopItemQuantity + amount;
        shopItemEl.data("quantity", newQuantity);
        shopItemEl.attr("data-quantity", newQuantity);
        shopItemEl.find(".quantity").text(newQuantity);
        shopItemEl.removeClass("item-disabled");

        let shopItemQuantityAddBtnEl = shopItemEl.find(".quantity-add");
        $(shopItemQuantityAddBtnEl).prop("disabled", false);
        $(shopItemQuantityAddBtnEl).removeClass("btn-disabled");

        _API.cart.delete(itemId, () => {
            itemEl.remove();
        });
    }

    function cartAddValue() {
        //pekar på närmaste input elementet och lagrar det i en variabel
        let amountEl = $(this)
            .parent()
            .parent()
            .find("input");
        //lagrar value av input elementet i en variabel
        let amount = amountEl.val();
        //omvandlar string till INT
        amount = parseInt(amount, 10);
        amount += 1;

        //hämtar ut en rad som har klassen .cart-item
        //this är knappen
        let itemEl = $(this).parents(".cart-item");
        //hämta ut shop, kunde ha varit body, html, w/e
        let shopEl = $("body").find("#shop");
        let itemId = itemEl.data("id");
        // let amount = itemEl.find('input').val();

        let shopItemEl = shopEl.find(`[data-id="${itemId}"]`);
        let shopItemQuantity = shopItemEl.data("quantity");
        let newQuantity = shopItemQuantity - 1;
        let priceEl = shopItemEl.find(".price span");
        let cartEl = $("body").find("#cart");
        let cartItemEl = cartEl.find(`[data-id="${itemId}"]`);
        let cartItemPriceEl = cartItemEl.find(".price span");
        let cartItemPrice = cartItemPriceEl.text();
        let price = priceEl.text();
        price = parseInt(price, 10);
        cartItemPrice = parseInt(cartItemPrice, 10);
        cartItemPriceEl.text(cartItemPrice + price);
        if (newQuantity < 0) {
            $(this).prop("disabled", true);
            $(this).addClass("btn-disabled");
        } else {
            //säger till valuen att den ska plussa på default värdet
            amountEl.val(amount);
            shopItemEl.data("quantity", newQuantity);
            shopItemEl.attr("data-quantity", newQuantity);
            shopItemEl.find(".quantity").text(newQuantity);
        }

        // Update cart item
        _API.cart.update(itemId, amount);
    }

    function cartSubtractValue() {
        //pekar på närmaste input elementet och lagrar det i en variabel
        let amountEl = $(this)
            .parent()
            .parent()
            .find("input");
        //lagrar value av input elementet i en variabel
        let amount = amountEl.val();
        //omvandlar string till INT
        amount = parseInt(amount, 10);
        amount -= 1;
        //säger till valuen att den ska plussa på default värdet
        amountEl.val(amount);

        //hämtar ut en rad som har klassen .cart-item
        //this är knappen
        let itemEl = $(this).parents(".cart-item");
        //hämta ut shop, kunde ha varit body, html, w/e
        let shopEl = $("body").find("#shop");
        let itemId = itemEl.data("id");
        // let amount = itemEl.find('input').val();
        let shopItemEl = shopEl.find(`[data-id="${itemId}"]`);
        let shopItemQuantity = shopItemEl.data("quantity");
        let newQuantity = shopItemQuantity + 1;

        let addBtnEl = itemEl.find(".cart-quantity-add");
        addBtnEl.removeClass("btn-disabled");
        addBtnEl.prop("disabled", false);

        shopItemEl.data("quantity", newQuantity);
        shopItemEl.attr("data-quantity", newQuantity);
        shopItemEl.find(".quantity").text(newQuantity);

        // Reduce price when substracting an item from the cart
        let priceEl = shopItemEl.find(".price span");
        let cartEl = $("body").find("#cart");
        let cartItemEl = cartEl.find(`[data-id="${itemId}"]`);
        let cartItemPriceEl = cartItemEl.find(".price span");
        let cartItemPrice = cartItemPriceEl.text();
        let price = priceEl.text();
        price = parseInt(price, 10);
        cartItemPrice = parseInt(cartItemPrice, 10);
        cartItemPriceEl.text(cartItemPrice - price);

        //
        if (amount <= 0) {
            itemEl.remove();
        }

        if (newQuantity >= 1) {
            shopItemEl.removeClass("item-disabled");
        }

        // Update cart item
        _API.cart.update(itemId, amount);
    }

    function addListeners() {
        elements.forEach(item => {
            document.querySelectorAll(item.selector).forEach(elt => {
                $(elt).off(item.event);
                $(elt).on(item.event, item.handler);
            });
        });
    }

    let elements = [
        {
            selector: ".quantity-add",
            event: "click",
            handler: traderAddValue
        },
        {
            selector: ".quantity-subtract",
            event: "click",
            handler: traderSubtractValue
        },
        {
            selector: ".btn-action",
            event: "click",
            handler: addHandler
        },
        {
            selector: ".btn-action-remove",
            event: "click",
            handler: removeHandler
        },
        {
            selector: ".cart-quantity-add",
            event: "click",
            handler: cartAddValue
        },
        {
            selector: ".cart-quantity-subtract",
            event: "click",
            handler: cartSubtractValue
        }
    ];

    addListeners();
});
