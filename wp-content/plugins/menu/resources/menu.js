jQuery(document).ready(function() {
	jQuery('#menu-items').sortable({items:'tr',stop:modifyAddRemoveLinkDisplay,handle:'span.drag-handle'});
	
	modifyAddRemoveLinkDisplay();
	
	jQuery('tr.menu-item a.add').live('click',function(event) {
		event.preventDefault();
		var $this = jQuery(this);
		var $item = $this.parents('tr.menu-item');
		var $new = $item.clone();
		$new.find('input').val('');
		$item.after($new);
		$new.find('input:first').focus();
		$new.find('a.remove').css('display','block');
		$this.css('display','none');
	});
	jQuery('tr.menu-item a.remove').live('click',function(event) {
		event.preventDefault();
		var $this = jQuery(this);
		var $item = $this.parents('tr.menu-item');
		var $prev = $item.prev('tr.menu-item');
		$prev.find('input:first').focus();
		$prev.find('a.add').css('display','block');
		$item.remove();
	});
});

function modifyAddRemoveLinkDisplay() {
	jQuery('tr.menu-item a.remove').css('display','block');
	jQuery('tr.menu-item:first a.remove, tr.menu-item a.add').css('display','none');
	jQuery('tr.menu-item:last a.add').css('display','block');
}