$(function(){	
	 $( "#tujuan" ).autocomplete({
      minLength: 0,
       source: function( request, response ) {
                $.ajax({
                    url: url_json,
                    dataType: "json",
					type: "POST",
                    data: {term: request.term},
                    success: function(data) {
                                response($.map(data, function(item) {
                                return {
									id: item.id,
                                    user_name: item.user_name,
                                    user_fullname: item.user_fullname,
									user_dept: item.user_dept
                                    };
                            }));
                        }
                    });
                },
      focus: function( event, ui ) {
        $( "#tujuan" ).val( ui.item.user_fullname );
        return false;
      },
      select: function( event, ui ) {
        $( "#tujuan" ).val( ui.item.user_fullname );
        $( "#id_tujuan" ).val( ui.item.id );
        return false;
      },
	   open: function() {
        $( this ).addClass( "ui-autocomplete-loading" );
      },
      close: function() {
        $( this ).removeClass( "ui-autocomplete-loading" );
      }
    
    })
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.user_name + " - " + item.user_dept + "<br>" + item.user_fullname + "</a>" )
        .appendTo( ul );
    };
  });