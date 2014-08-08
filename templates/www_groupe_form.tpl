{* Smarty *}
{include file="www_header.tpl"}

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="soplanning-box">
				<div class="btn-group">
					<a href="{$BASE}/projets.php" class="btn btn-small" ><img src="assets/img/pictos/projets.png" border="0" width="18"> {#menuListeProjets#}</a>
					<a href="{$BASE}/groupe_list.php" class="btn btn-small"><img src="assets/img/pictos/groupes.png" border="0" width="18"> {#menuListeGroupes#}</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="soplanning-box margin-top-10">
				{if isset($error_fields)}
					<div class="alert alert-error">
						<h5>{#groupe_erreurChamps#} :</h5>
						<ul>
							{foreach from=$error_fields item=field}
								<li>{$field}</li>
							{/foreach}
						</ul>
					</div>
				{/if}
				<form action="{$BASE}/process/groupe_save.php" method="POST" class="form-horizontal formElement">
					<input type="hidden" name="saved" value="{$groupe.saved}" />
					<input type="hidden" name="groupe_id" value="{$groupe.groupe_id}" />
					<div class="control-group">
						<label class="control-label" for="inputEmail">{#groupe_nom#} :</label>
						<div class="input-append">
							<input name="nom" type="text" value="{$groupe.nom|escape:"html"}" size="30" maxlength="100" />
							<input type="submit" value="{#groupe_valider#|escape:"html"}" class="btn btn-small" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



{include file="www_footer.tpl"}