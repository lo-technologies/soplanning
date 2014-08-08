{* Smarty *}

<form class="form-horizontal">
	<div class="control-group">
		<label class="control-label">{#icalExport_url#} :</label>
		<div class="controls">
			<input type="text" size="60" value="{$lienIcal}" readonly>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#icalExport_download#} :</label>
		<div class="controls">
			<a href="export_ical.php"><img src="assets/img/pictos/download.png" width="20" height="20" border="0" /></a>
		</div>
	</div>
</form>