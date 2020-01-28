$(document).ready(function () {
    $('#search').on('keyup', _.debounce(function (e) {
        // "this" refers to the value in #search  
        var value = $(this).val();

        $.ajax({
            type: 'GET',
            url: '/items/search',
            data: {
                search: value,
            },

            success: function (data) {
                $('#initial_table').hide();
                $('#ajax').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("AJAX error: " + textStatus + " : " + errorThrown + " " + jqXHR);
            },
        })
    }, 50));




    let cart = [];

    function addValue() {

        let amountEl = $(this)
            .parent()
            .parent()
            .find('input');
        let amount = amountEl.val();
        amount = parseInt(amount, 10);

        amountEl.val(amount + 1);
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
        let amount = itemEl.find('input').val();

        if (quantity === 0) {
            itemEl.toggleClass('item-disabled');
            console.log('voff');
        }

        if (amount <= quantity) {
            let newQuantity = quantity - amount;
            itemEl.data('quantity', newQuantity);
            itemEl.attr('data-quantity', newQuantity);
            itemEl.find('.quantity').text(newQuantity);
            $.ajax({
                type: 'GET',
                url: `/items/${itemId}/${amount}`,
                success: function (data) {
                    $('#cart').append(data);
                    if (newQuantity === 0) {
                        itemEl.toggleClass('item-disabled');
                        console.log('voff');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("AJAX error: " + textStatus + " : " + errorThrown + " " + jqXHR);
                },
            })
        }
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
        }
    ];




    // Loop over list of event handlers and attach events to present elements.

    elements.forEach(item => {
        document
            .querySelectorAll(item.selector)
            .forEach(elt => {
                $(elt).on(item.event, item.handler)
            });
    });


});
