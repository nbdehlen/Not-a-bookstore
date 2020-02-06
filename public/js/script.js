import _API from "./api.js";
import npcMessages from "./npc-messages.js";

$(document).ready(() => {
    function searchHandler() {
        let value = $("#search")
            .val()
            .trim();

        // Perform search
        _API.trader.search(value, data => {
            $("#shop").html(data);
            addListeners();
        });
    }

    // Increment amount value
    function traderAddValueHandler() {
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
    function traderSubtractValueHandler() {
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

    // Add to cart
    function addToCartHandler(e) {
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

    function removeFromCartHandler() {
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

    function cartAddValueHandler() {
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

    function cartSubtractValueHandler() {
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

    function acceptPurchaseHandler() {
        $("#dialog").modal("show");
        $("body")
            .find("#cart")
            .html("");
    }

    function declinePurchaseHandler() {
        // Clear cart
        _API.cart.clear(data => {
            if (data == 1) setRandomMessage("decline");
        });
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

    // Get random vendor response message by type
    function setRandomMessage(type) {
        const messages = npcMessages;
        const randomIndex = Math.floor(Math.random() * messages[type].length);
        $(".messagebox-message").text(messages[type][randomIndex]);
    }

    // Modal on show
    $("#dialog").on("show.bs.modal", e => {
        // Get cart content
        _API.cart.get(data => {
            if (!data.cart) {
                console.log("Error!");
            } else {
                data.cart.forEach(item => {
                    $(e.target)
                        .find("ul")
                        .append(`<li>${item.name} x ${item.amount}</li>`);

                    $(e.target)
                        .find(".price > span")
                        .text(data.sum);
                });
                setRandomMessage("accept");
                // Clear cart
                _API.cart.clear();
            }
        });
    });

    // Modal after hidden
    $("#dialog").on("hidden.bs.modal", e => {
        $(e.target)
            .find("ul")
            .text("");
        $(e.target)
            .find(".price > span")
            .text("");
    });

    const elements = [
        {
            selector: "#search",
            event: "search",
            handler: searchHandler
        },
        {
            selector: ".search button",
            event: "click",
            handler: searchHandler
        },
        {
            selector: ".quantity-add",
            event: "click",
            handler: traderAddValueHandler
        },
        {
            selector: ".quantity-subtract",
            event: "click",
            handler: traderSubtractValueHandler
        },
        {
            selector: ".btn-action",
            event: "click",
            handler: addToCartHandler
        },
        {
            selector: ".btn-action-remove",
            event: "click",
            handler: removeFromCartHandler
        },
        {
            selector: ".cart-quantity-add",
            event: "click",
            handler: cartAddValueHandler
        },
        {
            selector: ".cart-quantity-subtract",
            event: "click",
            handler: cartSubtractValueHandler
        },
        {
            selector: "#accept",
            event: "click",
            handler: acceptPurchaseHandler
        },
        {
            selector: "#decline",
            event: "click",
            handler: declinePurchaseHandler
        }
    ];

    addListeners();
    setRandomMessage("welcome");
});
