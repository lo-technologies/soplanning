<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="reply-to" content="support@soplanning.org" />
		<meta name="email" content="support@soplanning.org" />
		<meta name="Identifier-URL" content="http://www.soplanning.org" />

		<title>SoPlanning Installation</title>

		<link href="favicon.ico" rel="icon" type="image/x-icon" />

		<link href="../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="../assets/css/styles.css" rel="stylesheet">
		<link href="../assets/css/simplePage.css" rel="stylesheet">
		<link href="../assets/css/utils.css" rel="stylesheet">
		<link href="../assets/plugins/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

		{$xajax}

	</head>

	<body>
		<div class="container">
			<h3 class="text-center">
				<span style="font-size:30px;font-weight:bold;">Simple Online Planning</span>
			</h3>
			<div class="small-container">
				<div class="alert alert-success">
					{#install_installResultOk#}
				</div>
				<ul class="inline flag text-right">
					<li><a tabindex="-1" href="?language=pt" class="tooltipEvent" data-title="Portuguese"><img src="../assets/img/flag/pt.png" alt="Portuguese"/></a></li>
					<li><a tabindex="-1" href="?language=es" class="tooltipEvent" data-title="Spanish"><img src="../assets/img/flag/es.png" alt="Spanish"/></a></li>
					<li><a tabindex="-1" href="?language=de" class="tooltipEvent" data-title="German"><img src="../assets/img/flag/de.png" alt="German"/></a></li>
					<li><a tabindex="-1" href="?language=nl" class="tooltipEvent" data-title="Dutch"><img src="../assets/img/flag/nl.png" alt="Dutch"/></a></li>
					<li><a tabindex="-1" href="?language=it" class="tooltipEvent" data-title="Italian"><img src="../assets/img/flag/it.png" alt="Italian"/></a></li>
					<li><a tabindex="-1" href="?language=fr" class="tooltipEvent" data-title="French"><img src="../assets/img/flag/fr.png" alt="French"/></a></li>
					<li><a tabindex="-1" href="?language=en" class="tooltipEvent" data-title="English"><img src="../assets/img/flag/en.png" alt="English"/></a></li>
				</ul>
				<p class="text-right text-info">
					<small><a href="mailto:support@soplanning.org">{#proposerTrad#}</a></small>
				</p>
				<p class="text-right text-info"><small>{#install_intro#}</small></p>
			</div>
		</div>
		<script src="assets/js/jquery-1.10.1.min.js"></script>
		<script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.js"></script>
	</body>
</html>