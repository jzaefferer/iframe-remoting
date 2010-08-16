<?php 
if (!file_exists("urls.txt")) {
	file_put_contents("urls.txt", "http://example.com\n");
}
$urls = file("urls.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (isset($_POST['url'])) {
	array_unshift($urls, $_POST['url']);
	$urls = array_unique($urls);
	file_put_contents("urls.txt", implode("\n", $urls));
	header("Location: ./admin.php");
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<meta charset=utf-8 />
<title>iframe-remoting - nothing loaded, yet</title>
<script type="text/javascript">
	$(function() {
		$("#history").click( function() {
			$("#url").val( $(this).val() );
		});
	});
</script>
<style type="text/css">
	
</style>
</head>
<body>
	<form method="post">
		<fieldset>
			<legend>Enter a url or select from history, then submit.</legend>
			<div>
				<input id="url" name="url" value="<?php echo $urls[0] ?>" />
				<input type="submit" value="(Re)load" />
			</div>
			<div>
				<select id="history" size="<?php echo count($urls) ?>">
				<?php 
					foreach ($urls as $url) {
						echo "<option>" . $url . "</option>";
					}
				?>
				</select>
			</div>
		</fieldset>
	</form>
</body>
</html>