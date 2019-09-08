jQuery(document).ready(function(){

    jQuery('body').on('click', '.delete-one-note', function(e){

        e.preventDefault();

        var url = jQuery(this).data('action');
        var note_id = jQuery(this).data('id');

        jQuery.ajax({
            url : url,
            type : "POST",
            data : "action=" + url + "&note_id=" + note_id,
            dataType : 'json',
            success : function( res ) {
                console.log('success');
            },
            error : function ( jqXHR, textStatus, errorThrown ) {
                console.log('error');
            }
        });
    });
    
    jQuery('body').on('submit', '.ajax-form-submit', function(e){

        e.preventDefault();

        var form = jQuery(this);

        var url = form.prop('action').defaultValue;

        var method = form.prop('method');

        var data = form.serialize();

        jQuery.ajax({
            url : url,
            type : method,
            data : data,
            dataType : 'json',
            success : function( res ) {
                console.log('success');
            },
            error : function ( jqXHR, textStatus, errorThrown ) {
                console.log('error');
            }
        });
    });
});