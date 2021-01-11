jQuery(document).ready(function($){
    let ahura_header_field = $("#ahura_page_header"),
        fields_wrapper = $("#ahura_header_option_fields")
    function init_fields()
    {
        let header_mode = ahura_header_field.val();
        fields_wrapper.find('p:not([header-' + header_mode +'])').hide();
        fields_wrapper.find('p[header-' + header_mode + ']').show()
    }
    init_fields();
    ahura_header_field.on('change', function(){
        init_fields();
    })
});