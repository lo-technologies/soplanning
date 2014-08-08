{* Smarty *}
<form class="form-horizontal" method="POST" action="" target="_blank" name="formUser"  onSubmit="return false;">
	<div class="control-group">
		<label class="control-label">{#user_identifiant#} :</label>
		<div class="controls">
			{if $user_form.saved eq 1}
				<input id="user_id" type="text" value="{$user_form.user_id|escape:"html"}" readonly/>
			{else}
				<input id="user_id" type="text" value="{$user_form.user_id|escape:"html"}" size="3" maxlength="3" />
			{/if}
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#user_nom#} :</label>
		<div class="controls">
			<input type="text" value="{$user_form.nom|escape:"html"}" readonly/>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#user_email#} :</label>
		<div class="controls">
			<input id="email_user" type="text" value="{$user_form.email|escape:"html"}" size="40" maxlength="255" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#user_login#} :</label>
		<div class="controls">
			<input type="text" value="{$user_form.nom|escape:"html"}" readonly/>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#user_password#} :</label>
		<div class="controls">
			<input id="password_tmp" type="password" value="" size="20" maxlength="20" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#user_notifications#} :</label>
		<div class="controls">
			<label class="radio inline">
				<input type="radio" id="notificationsOui" name="notifications" value="oui" {if $user_form.notifications eq "oui"}checked="checked"{/if}>&nbsp;{#oui#}
			</label>
			<label class="radio inline">
				<input type="radio" id="notificationsNon" name="notifications" value="non" {if $user_form.notifications eq "non"}checked="checked"{/if} style="margin-left:20px;">&nbsp;{#non#}
			</label>
		</div>
	</div>
	<input type="button" class="btn btn-primary" value="{#submit#}" onClick="xajax_submitFormProfil('{$user_form.user_id|escape}', $('email_user').value, $('password_tmp').value, $('notificationsOui').checked);" style="margin-left: 180px;"/>
</form>