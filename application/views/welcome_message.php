<!DOCTYPE html>
<html>
<head>
	<title>form</title>
</head>
<body>

	<?= form_open_multipart('api/example/user_post');?>
		<input type="text" name="first_name"><br>
		<input type="text" name="last_name"><br>
		<input type="text" name="email"><br>
		<input type="text" name="phone"><br>
		<input type="submit" name="submit">
		
	</form>

</body>
</html>