jQuery(document).ready(function($){
    var mw_qty_mode = {};
    mw_qty_mode.increase = function(mw_qty_input)
    {
        let cu_value = mw_qty_input.val(),
            new_value = parseInt(cu_value) + 1;
        mw_qty_input.val(new_value);
    }
    mw_qty_mode.decrease = function(mw_qty_input)
    {
        let cu_value = mw_qty_input.val(),
            new_value = parseInt(cu_value) - 1;
        if(new_value == 0)
        {
            return false;
        }
        mw_qty_input.val(new_value);
    }
    function mw_change_qty(mw_qty_input, mode)
    {
        let cu_value = parseInt(mw_qty_input.val()),
            new_value = '';
        switch(mode)
        {
            case 'increase':
                new_value = cu_value + 1;
                break;
            case 'decrease':
                if(cu_value == 1)
                {
                    return false;
                }
                new_value = cu_value - 1;
                break;
        }

        mw_qty_input.val(new_value);
        mw_qty_input.trigger('change');
    }
    $(document).on('click', '.mw_qty_btn', function (e) {
        let mw_this = $(this),
            mw_qty_input = mw_this.parent().find('input[type=number].qty'),
            mw_mode = mw_this.data('mw_qty_mode');
        mw_change_qty(mw_qty_input, mw_mode);
    });
});