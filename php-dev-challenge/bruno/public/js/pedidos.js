jQuery(document).ready(function() {
	var produtos;
	
	$.get("/produtos?ajax=true",function(data, status) {
        if(status == 'success')
        {
            produtos = JSON.parse(data);
            $('input#produto').typeahead({
		        source: produtos,
		        itemSelected:function(item,value,text){
		            $.each(produtos, function( index, item ) {
		                if(item.id == value)
		                {
		                    $("#produtos-table").append(
		                    	"<tr>"+
		                    		"<td>"+item.sku+"</td>"+
		                    		"<td>"+item.name+"</td>"+
		                    		"<td>"+item.preco+"</td>"+
		                    	"</tr>"
	                    	);        
		                    var total = $("#total").val();
		                    if(total != "")
		                    {
		                    	total = parseFloat(total);
		                    }
	                    	$("#total").val( total + parseFloat(item.preco));
		                	$("#produto").val('');

		                	var produtosIds = $("#produtos").val();
		                	if(produtosIds != '') {
		                		$("#produtos").val($("#produtos").val()+','+item.id);
		                	} else {
		                		$("#produtos").val(item.id);
		                	}
		                }
		            });
		        }
		    });   

		    console.log($('input#produto'));
        }
    });

});
