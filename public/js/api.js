const _API = {
    trader: {
        search(value, callback = function() {}) {
            $.ajax({
                type: "GET",
                url: "shop/search",
                data: {
                    search: value
                },
                success: function(data) {
                    callback(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(
                        "AJAX error: " +
                            textStatus +
                            " : " +
                            errorThrown +
                            " " +
                            jqXHR
                    );
                }
            });
        },
        getItem(itemId, callback = function() {}) {
            $.ajax({
                type: "GET",
                url: `/api/item/${itemId}`,
                success: function(data) {
                    callback(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(
                        "AJAX error: " +
                            textStatus +
                            " : " +
                            errorThrown +
                            " " +
                            jqXHR
                    );
                }
            });
        },
        addToCart(itemId, amount, callback = function() {}) {
            $.ajax({
                type: "GET",
                url: `/api/item/${itemId}/${amount}`,
                success: function(data) {
                    callback(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(
                        "AJAX error: " +
                            textStatus +
                            " : " +
                            errorThrown +
                            " " +
                            jqXHR
                    );
                }
            });
        }
    },
    cart: {
        get(callback = function() {}) {
            $.ajax({
                type: "GET",
                url: "/api/cart",
                success: function(data) {
                    callback(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(
                        "AJAX error: " +
                            textStatus +
                            " : " +
                            errorThrown +
                            " " +
                            jqXHR
                    );
                }
            });
        },
        update(itemId, amount, callback = function() {}) {
            $.ajax({
                type: "PATCH",
                url: `/api/cart/${itemId}/${amount}`,
                success: function(data) {
                    callback(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(
                        "AJAX error: " +
                            textStatus +
                            " : " +
                            errorThrown +
                            " " +
                            jqXHR
                    );
                }
            });
        },
        delete(itemId, callback = function() {}) {
            $.ajax({
                type: "DELETE",
                url: `/api/cart/${itemId}`,
                success: function(data) {
                    callback(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(
                        "AJAX error: " +
                            textStatus +
                            " : " +
                            errorThrown +
                            " " +
                            jqXHR
                    );
                }
            });
        },
        clear(callback = function() {}) {
            $.ajax({
                type: "DELETE",
                url: "/api/cart",
                success: function(data) {
                    callback(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(
                        "AJAX error: " +
                            textStatus +
                            " : " +
                            errorThrown +
                            " " +
                            jqXHR
                    );
                }
            });
        }
    }
};

export default _API;
