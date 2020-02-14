function fetch(settings, callback = () => {}) {
    $.ajax({
        ...settings,
        success: data => {
            callback(data);
        },
        error: (jqXHR, textStatus, errorThrown) => {
            console.log(
                "AJAX error: " + textStatus + " : " + errorThrown + " " + jqXHR
            );
        }
    });
}

const _API = {
    joke: {
        get(callback) {
            fetch(
                {
                    type: "GET",
                    url: "https://icanhazdadjoke.com/",
                    dataType: "json"
                },
                callback
            );
        }
    },
    trader: {
        search(value, callback) {
            fetch(
                {
                    type: "POST",
                    url: "/api/items/search",
                    data: {
                        search: value
                    }
                },
                callback
            );
        },
        getItem(itemId, callback) {
            fetch(
                {
                    type: "GET",
                    url: `/api/items/${itemId}`
                },
                callback
            );
        },
        addToCart(itemId, amount, callback) {
            fetch(
                {
                    type: "POST",
                    url: "/api/cart",
                    data: {
                        item_id: itemId,
                        amount: amount
                    }
                },
                callback
            );
        }
    },
    cart: {
        get(callback) {
            fetch(
                {
                    type: "GET",
                    url: "/api/cart"
                },
                callback
            );
        },
        sum(callback) {
            fetch(
                {
                    type: "GET",
                    url: "/api/cart/sum"
                },
                callback
            );
        },
        update(itemId, amount, callback) {
            fetch(
                {
                    type: "PATCH",
                    url: `/api/cart/${itemId}`,
                    data: {
                        amount: amount
                    }
                },
                callback
            );
        },
        delete(itemId, callback) {
            fetch(
                {
                    type: "DELETE",
                    url: `/api/cart/${itemId}`
                },
                callback
            );
        },
        clear(callback) {
            fetch(
                {
                    type: "DELETE",
                    url: `/api/cart`
                },
                callback
            );
        }
    }
};

export default _API;
