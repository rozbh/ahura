jQuery(document).ready(function($){
    $(document).on('input', '.search-form input[name="s"]', function(e){
        let mw_this = $(this),
            keyword = mw_this.val(),
            search_res_wrapper = $(".search-form #ajax_search_res"),
            ajax_load_spinner = $(".search-form #ajax_search_loading");
        if (keyword == '')
        {
            search_res_wrapper.html("");
            return false;
        }
        ajax_load_spinner.show();
        $.ajax({
            url: ahura_data.au,
            type: 'post',
            data: {
                action: 'mw_search_ajax',
                keyword: keyword
            },
            success: function(response){
                search_res_wrapper.html(response);
                ajax_load_spinner.hide();
            }
        });
    });
    $(document).on('click', 'body', function (e) {
        let mw_ajax_res_box = $('#ajax_search_res');
        // check if ajax result box is open
        if (mw_ajax_res_box.children().length)
        {
            if(!$(e.target).closest(mw_ajax_res_box.closest('form')).length)
            {
                // hide ajax result box
                mw_ajax_res_box.hide();
            }
        }
    })
    $(document).on('focus', '.search-form input[name="s"]', function (e) {
        if (this.value)
        {
            let mw_ajax_res_box = $('#ajax_search_res');
            // open ajax result box
            mw_ajax_res_box.show();
        }
    });
});