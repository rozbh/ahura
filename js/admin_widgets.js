jQuery(document).ready(function($){
    $(document).on('click', '.ahura_social_upload', function(e){
        e.preventDefault();
        let mw_this = $(this);
        let media_uploader = wp.media({
            title: 'Selcet an icon',
            button: {
                'text' : 'Select'
            },
            multiple: false
        });
        media_uploader.on('select', function(){
            let media_attachment = media_uploader.state().get('selection').first().toJSON(),
                wrapper = mw_this.closest('p').find('input');
            wrapper.val(media_attachment.url);
            wrapper.trigger('input');
        });
        media_uploader.open();
    });
});