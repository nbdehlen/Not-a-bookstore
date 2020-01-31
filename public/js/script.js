import _API from "./api.js";

$(document).ready(() => {
    function search() {
        let value = $("#search")
            .val()
            .trim();

        // Perform search
        _API.trader.search(value, data => {
            $("#shop").html(data);
            addListeners();
        });
    }

    // Search button click listener
    $(".search button").on("click", () => {
        search();
    });

    // Search button keyup listener
    $("#search").on("keyup", e => {
        if (e.which !== 13) return;
        search();
    });

    // Increment amount value
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

    // Decrement amount value
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

    // Add
    function addHandler(e) {
        const itemEl = $(this).parents(".npc-item");
        const itemId = itemEl.data("id");
        const amountEl = itemEl.find("input");
        const amount = amountEl.val();
        const cartEl = $("body").find("#cart");

        _API.trader.addToCart(itemId, amount, data => {
            let cartItemEl = cartEl.find(`[data-id="${itemId}"]`);
            if (cartItemEl.length === 0) {
                $("#cart").append(data);
            } else {
                cartItemEl[0].outerHTML = data;
            }

            _API.trader.getItem(itemId, data => {
                itemEl[0].outerHTML = data;
                addListeners();
            });
        });
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
        let amountEl = $(this)
            .parent()
            .parent()
            .find("input");

        let amount = amountEl.val();
        amount = parseInt(amount, 10);
        amount += 1;

        let itemEl = $(this).parents(".cart-item");
        let shopEl = $("body").find("#shop");
        let itemId = itemEl.data("id");
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
            amountEl.val(amount);
            shopItemEl.data("quantity", newQuantity);
            shopItemEl.attr("data-quantity", newQuantity);
            shopItemEl.find(".quantity").text(newQuantity);
        }

        // Update cart item
        _API.cart.update(itemId, amount);
    }

    function cartSubtractValue() {
        let amountEl = $(this)
            .parent()
            .parent()
            .find("input");
        let amount = amountEl.val();
        amount = parseInt(amount, 10);
        amount -= 1;
        amountEl.val(amount);

        let itemEl = $(this).parents(".cart-item");
        let shopEl = $("body").find("#shop");
        let itemId = itemEl.data("id");
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

        if (amount <= 0) {
            itemEl.remove();
        }

        if (newQuantity >= 1) {
            shopItemEl.removeClass("item-disabled");
        }

        // Update cart item
        _API.cart.update(itemId, amount);
    }

    // Eventlisteners
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
