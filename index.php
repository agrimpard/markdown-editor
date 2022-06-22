<?php

	// init
	$file_path = './README.md';
	$app_markdown = '';
	$svg_save = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-arrow-down-fill" viewBox="0 0 16 16"><path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5z"/></svg>';


	// write markdown file
	if( isset($_POST['w']) ) {
		if( is_file($file_path) ) {
			file_put_contents( $file_path , $_POST['c'] );
		}
	}

	// open markdown file
	if( is_file($file_path) ) {
		$app_markdown = file_get_contents($file_path);
		$app_html = '
			'.( strlen($app_markdown)>0 ? '<div class="markdown-form-bt"><button type="button" class="btn btn-success" title="Click to save file">'.$svg_save.' Save</button></div>' : '' ).'
			<div class="col-6 p-0">
				<textarea class="editor markdown-source">'.$app_markdown.'</textarea>
			</div>
			<form method="post" class="markdown-form col-6 p-0">
				<input type="hidden" name="w" value="do">
				<textarea name="c" class="markdown-copy"></textarea>
			</div>
		';
	} else {
		$app_html = '<div class="alert alert-warning text-center"><b>Can\'t find the markdown file</b>, edit index.php <i>$file_path</i> variable with your markdown file path.</div>';
	}

?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Markdown Editor</title>
		<link rel="icon" href="tpl/favicon.png" type="image/png">
		<link href="tpl/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="tpl/app.css" rel="stylesheet">
		<script src="tpl/jquery.js"></script>
		<script src="tpl/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="tpl/app.js?1"></script>
	</head>
	<body class="app-markdown">
		<div class="container-fluid">
			<div class="row app-editor">
				<?PHP echo $app_html; ?>
			</div>
		</div>
	</body>
</html>