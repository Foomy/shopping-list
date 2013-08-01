var ShoppingList = {

	init: function () {
		this.initToggleForm();
		this.initSubmitButton();
		this.initCancelButton();
		this.initDeleteButtons();
	},

	initToggleForm: function () {
		$('.toggleForm').bind('click.hide', function () {
			ShoppingList.toggleForm();
		});
	},

	initSubmitButton: function () {
		$('.is_submit').bind('click.submit', function () {
			ShoppingList.submitForm();
		}); // $('.is_submit').bind()
	},

	initCancelButton: function () {
		$('.is_cancel').bind('click.clear', function () {
			ShoppingList.clearForm();
		});
	},

	initDeleteButtons: function () {
		$('.is_removeItem').bind('click.del', function () {
			var iid = $(this).data('iid');
			ShoppingList.removeItem(iid);
		});
	},

	submitForm: function () {
		$.ajax({
			url: '/index/save/',
			type: 'post',
			data: {
				newEntries: $('.is_addField').val()
			},
			dataType: 'json',
			success: function (response) {
				var values = $('.is_addField').val().split(', ');

				if (! response.error) {
					$(values).each(function () {
						var newId = parseInt($('.is_maxItemId').html(), 10)+1;
						$itemDel = $('<span class="delete is_removeItem" data-iid="'+newId+'">[x]</span>');
						$slItem = $('<span class="item is_item_'+newId+'"></span>');

						$slItem.html(this)
							.append(' ')
							.append($itemDel);

						if ($('.is_shoppingList').html() != '') {
							$('.is_shoppingList').append(', ');
						}
						$('.is_shoppingList').append($slItem);

						$('.is_maxItemId').html(newId);
						$('.is_addField').val('');
					});
				}

			}
		});
	},

	removeItem: function (itemId) {
		console.log(itemId);
		$('.is_item_'+itemId).remove();
		$('.is_shoppingList').html($('.is_shoppingList').html().replace('/, /g', ''));
	},

	toggleForm: function () {
		if ($('.is_addForm').hasClass('hide')) {
			$('.is_addForm').removeClass('hide');
		}
		else {
			$('.is_addForm').addClass('hide');
		}
	},

	clearForm: function () {
		$('.is_addField').val('');
	}

};

$(document).ready(function () {
	ShoppingList.init();
});