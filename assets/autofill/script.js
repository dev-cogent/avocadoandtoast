

	// set_item : this function will be executed when we select an item
	function set_itemsearch(item) {
		// change input value
		$('.filter-input').val(item); 
		// hide proposition list
		$('#content').hide();
	}

	function hello(){
		var min_length = 0; // min caracters to display the autocomplete
		var keyword = $('.filter-input').val();
		if (keyword.length >= min_length) {
			$.ajax({
				url: '/assets/autofill/ajax_refresh.php',
				type: 'POST',
				data: {keyword:keyword},
				success:function(data){
					$('#content').show();
					$('#content').html(data);
				}
			});
		} else {
			$('#content').hide();
		}
	}