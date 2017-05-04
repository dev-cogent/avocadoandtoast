function autocompletesearch() {
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#usersearch').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'http://cogenttools.com/autofillsearch/ajax_refreshsearch.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#user_listsearch').show();
				$('#user_listsearch').html(data);
			}
		});
	} else {
		$('#user_listsearch').hide();
	}
}
 
// set_item : this function will be executed when we select an item
function set_itemsearch(item) {
	// change input value
	$('#usersearch').val(item); 
	// hide proposition list
	$('#user_listsearch').hide();
}