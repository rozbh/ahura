jQuery(document).ready(function ($) {
    $(document).on('click', '.mw_upload_media', function (e) {
        e.preventDefault();
        var mw_this = $(this);
        mediaUploader = wp.media({
            title: 'Select an icon',
            button: {
                'text': 'Select'
            },
            multiple: false
        });
        mediaUploader.on('select', function () {
            var mw_media_data_wrapper = mw_this.parent().next('input.mw_media_url'),
                mw_attachment = mediaUploader.state().get('selection').first().toJSON();
            mw_media_data_wrapper.val(mw_attachment.url);
        });
        mediaUploader.open();
    });
    
});