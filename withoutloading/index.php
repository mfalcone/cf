<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="jquery-1.6.4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {

			$('#post_button').click(function() {
				text = $('#post_text').val();
				text2 = $('#secparam').val();
				var jason = {
					'text':text,
					'text2':text2
				}
				$.ajax({
					type: "POST",
					cache: false,
					url: "save.php",
					data: "data="+JSON.stringify(jason),
					success: function(data) {
						alert(data);
					}
				});
			});
		});
	</script>
</head>

<body>
Enter text to save<br />
<form id="myform">
	<textarea id="post_text" name="juan" style="display: block; clear: both; height: 200px;"></textarea>
	<input type="text" name="text2" id="secparam" />
	<input name="" type="button" value="Save" id="post_button" />
</form>
</body>
</html>
