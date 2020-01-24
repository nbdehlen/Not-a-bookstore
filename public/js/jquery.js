$('#search').on('keyup',function(){
    // "this" refers to the value in #search  
    var value = $(this).val();

    $.ajax({
        type: 'GET',
        url: '/items/search',
        data: {
            search: value,
        },

        success:function(data) {
            $('#initial_table').hide();
            $('#ajax').html(data);
        },
        error:function(jqXHR, textStatus, errorThrown) {
            console.log("AJAX error: " + textStatus + " : " + errorThrown + " " + jqXHR);
        },
    });
});