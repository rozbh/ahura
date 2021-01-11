jQuery(document).ready(function($){
    let cart_btn = $('#mcart-stotal')
    $(document.body).on('wc_fragments_loaded', function(e){
        $.ajax({
            url: ahura_cart.au,
            dataType: 'json',
            type: 'post',
            data: {
                action: 'ahura_update_mini_cart_btn',
                mode: cart_btn.attr('cart-mode')
            },
            success: function(response){
                if(response.edit)
                {
                    $.each(response.edit, function(el, value){
                        $(el).replaceWith(value)
                    })
                }
            },
            error: function(err){}
        })
    })
});