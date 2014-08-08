{* Smarty *}
<form class="form-horizontal" method="POST" action="" target="_blank" onsubmit="return false;">
	<div class="control-group">
		<label class="control-label">{#user_groupe#} :</label>
		<div class="controls">
			<input id="nom" type="text" value="{$groupe.nom|escape:"html"}" size="50" maxlength="150" />
		</div>
	</div>
	<input type="button" class="btn btn-primary" value="{#submit#|escape:"html"}" style="margin-left: 180px;" onclick="xajax_submitFormUserGroupe('{$groupe.user_groupe_id|escape}', $('nom').value);"/>
</form>