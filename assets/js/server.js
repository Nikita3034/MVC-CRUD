jQuery(document).ready(function(){

    jQuery('body').on('click', '.actions-one-note', function(e){

        e.preventDefault();

        var _this = jQuery(this);

        var tr = _this.closest('tr');

        var entity = tr.data('entity');
        var action = _this.data('action');

        var data = "action=" + entity + '/' + action;

        var note_id = _this.data('id');

        if( typeof note_id != "undefined" )
            data += "&note_id=" + note_id;

        var form_data = "&" + tr.find('form').serialize();

        if( typeof form_data != "undefined" )
            data += form_data;

        jQuery.ajax({
            url : entity + '/' + action,
            type : "POST",
            data : data,
            dataType : 'json',
            success : function( res ) {

                if( res.status ){
                    location.reload(true);
                    console.log('success');
                }

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

                if( res.status ){
                    location.reload(true);
                    console.log('success');
                }
                
            },
            error : function ( jqXHR, textStatus, errorThrown ) {
                console.log('error');
            }
        });
    });
});