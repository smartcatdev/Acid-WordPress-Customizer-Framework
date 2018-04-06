( function( $ ) {
    wp.customizerCtrlEditor = {

        init: function() {

            $(window).load(function(){

                $('.wp-editor-area').each(function(){
                    var tArea = $(this),
                        id = tArea.attr('id'),
                        editor = tinyMCE.get(id),
                        setChange,
                        content;

                    if(editor){
                        editor.onChange.add(function (ed, e) {
                            ed.save();
                            content = editor.getContent();
                            clearTimeout(setChange);
                            setChange = setTimeout(function(){
                                tArea.val(content).trigger('change');
                            },500);
                        });
                    }

                    tArea.css({
                        visibility: 'visible'
                    }).on('keyup', function(){
                        content = tArea.val();
                        clearTimeout(setChange);
                        setChange = setTimeout(function(){
                            content.trigger('change');
                        },500);
                    });
                });
            });
        }

    };

    wp.customizerCtrlEditor.init();
    
    
//    			var contact = {
//				"FirstName": "Bilal",
//				"LastName": "Hassan",
//				"Email": "bilal@smartcat.ca"
//			};
//
//			var requestData = {
//				ClientID: 'lnyxjBszLzrytVz4dvKO',
//				ContactData: JSON.stringify(contact)
//			};
//
//			
//			$.ajax({
//                            type: 'POST',
//                            url: 'http://www.homefrontcrm.com/HFCRMApi/api/contact/',
//                            contentType: 'application/json',
//                            data: JSON.stringify(requestData)
//            		});


} )( jQuery );