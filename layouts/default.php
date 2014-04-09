<?php
/**
 * @var string $content
 * @var array $options
 */
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="language" content="ru"/>
	<style type="text/css">
		body {
			color: black;
			background: white;
			line-height: 1.5;
			font-family: "Times New Roman", Times, serif;
			font-size: 12pt;
		}

		p {
			text-align: justify;
			text-indent: 1.5em;
			margin-bottom: 0;
			margin-top: 0;
		}

		@page {
			margin-top: 10mm;
			margin-bottom: 10mm;
			margin-left: 15mm;
			margin-right: 5mm;
		}

		.table {
			border: 2px solid black;
			border-collapse: collapse;
		}

		.page-break {
			display: block;
			page-break-before: always;
		}

		.title {
			page-break-after: avoid;
			text-align: center;
			font-weight: bold;
			margin-top: 10pt;
			margin-bottom: 10pt;
		}

		.center {
			text-align: center;
		}

		.left {
			text-align: left;
		}

		.right {
			text-align: right;
		}

		.top {
			vertical-align: top;
		}
	</style>
</head>
<body>
<div class="container">
	<?php echo $content; ?>
</div>
</body>