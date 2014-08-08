{* Smarty *}
<form class="form-horizontal" method="POST" action="" target="_blank" onsubmit="return false;">
	<div class="control-group">
		<label class="control-label">{#feries_date#} :</label>
		<div class="controls">
			<input type="text" id="date_ferie" size="11" maxlength="10" value="{$ferie.date_ferie|sqldate2userdate}" style="width:80px" class="datepicker" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#feries_libelle#} :</label>
		<div class="controls">
			<input id="libelle" size="30" maxlength="50" type="text" value="{$ferie.libelle}" />
		</div>
	</div>
	<input type="button" class="btn btn-primary" value="{#submit#|escape:"html"}" style="margin-left: 400px;" onclick="xajax_submitFormFerie($('date_ferie').value, $('libelle').value);"/>
</form>