/**
 * @author Deanna Schneider
 */

 function addFormField() {
 	
	var id = document.getElementById("id").value;
	var blogslist = jQuery("#blogid_1").html();
	var rolelist = jQuery("#default_role_1").html();
	
	jQuery("#addRowTable").append("<tr id='" + id + "'><td><select name='blogid_" + id + "' id='blogid_" + id + "'>"  + blogslist + "</select></td><td><select name='default_role_" + id + "'>" + rolelist + "</select></td>&nbsp;&nbsp<a href='#' onClick='removeFormField(\"#row" + id + "\"); return false;'>Remove</a><p>");
	
	jQuery("#blogid_" + id).val('');
	jQuery("#default_role_" + id).val('');
	
	id = (id - 1) + 2;
	document.getElementById("id").value = id;
}

function removeFormField(id) {
	jQuery(id).remove();
}

