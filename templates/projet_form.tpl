{* Smarty *}
<form class="form-horizontal" method="POST" action="process/projet.php" onsubmit="return JSformProjet();">
	<input type="hidden" name="saved" value="{$projet.saved}" />
	<input type="hidden" name="old_projet_id" value="{$projet.projet_id}" />
	<input type="hidden" name="origine" value="{$origine}" />
	<div class="control-group">
		<label class="control-label">{#winProjet_identifiant#} :</label>
		<div class="controls">
			<input name="projet_id" id="projet_id" type="text" size="10" maxlength="10" value="{$projet.projet_id}" onChange="xajax_checkProjetId(this.value, '{$projet.projet_id}');" /> {#winProjet_identifiantCarMax#}
			<span id="divStatutCheckProjetId"></span>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#winProjet_nomProjet#} :</label>
		<div class="controls">
			<input name="nom" id="nom" type="text" size="30" maxlength="30" value="{$projet.nom}" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#winProjet_groupe#} :</label>
		<div class="controls">
			<select name="groupe_id" id="groupe_id">
				<option value="" {if $projet.groupe_id eq ""}selected="selected"{/if}>- - - - - - - - - - - - - - - -</option>
				{foreach from=$groupes item=groupe}
					<option value="{$groupe.groupe_id}" {if $projet.groupe_id eq $groupe.groupe_id}selected="selected"{/if}>{$groupe.nom}</option>
				{/foreach}
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#winProjet_statut#} :</label>
		<div class="controls">
			<select name="statut">
				<option value="a_faire" {if $projet.statut eq "a_faire"}selected="selected"{/if}>{#winProjet_statutAFaire#|escape:"html"}</option>
				<option value="en_cours" {if $projet.statut eq "en_cours"}selected="selected"{/if}>{#winProjet_statutEnCours#|escape:"html"}</option>
				<option value="fait" {if $projet.statut eq "fait"}selected="selected"{/if}>{#winProjet_statutFait#|escape:"html"}</option>
				<option value="abandon" {if $projet.statut eq "abandon"}selected="selected"{/if}>{#winProjet_statutAbandon#|escape:"html"}</option>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#winProjet_charge#} :</label>
		<div class="controls">
			<input name="charge" id="charge" type="text" size="5" maxlength="5" value="{$projet.charge}" style="width:30px;" /> {#winProjet_chargeJours#}
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#winProjet_livraison#} :</label>
		<div class="controls">
			<input type="text" class="datepicker" name="livraison" id="livraison" size="11" maxlength="10" value="{$projet.livraison|sqldate2userdate}" style="width:70px;" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#winProjet_couleur#} :</label>
		<div class="controls">
			{if $smarty.const.CONFIG_PROJECT_COLORS_POSSIBLE neq ""}
				<select name="couleur">
					{foreach from=","|explode:$smarty.const.CONFIG_PROJECT_COLORS_POSSIBLE item=couleurTmp}
						<option value="{$couleurTmp}" style="background-color:{$couleurTmp}" {if $couleurTmp eq "#"|cat:$projet.couleur}selected="selected"{/if}>{$couleurTmp}</option>
					{/foreach}
				</select>
				<span style="width:50px;background-color:{$projet.couleur}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			{else}
				<input name="couleur" id="couleur" size="7" maxlength="6" type="text" value="{if $projet.couleur eq ''}ffffff{else}{$projet.couleur}{/if}" onChange="$S('colorbox').background='#'+this.value;" /> {#winProjet_couleurMaxCar#}
			{/if}
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#winProjet_createur#} :</label>
		<div class="controls">
			{if in_array("projects_manage_all", $user.tabDroits)}
				<select name="createur_id">
					{foreach from=$usersOwner item=owner}
						<option value="{$owner.user_id}" {if $createur.user_id eq $owner.user_id || ($createur.user_id eq "" && $owner.user_id eq $user.user_id)}selected="selected"{/if}>{$owner.nom}</option>
					{/foreach}
				</select>
			{else}
				{$createur.nom}
				<input type="hidden" name="createur_id" value="{$createur.user_id}">
			{/if}
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#winProjet_commentaires#} :</label>
		<div class="controls">
			<input name="iteration" size="30" maxlength="255" type="text" value="{$projet.iteration}" /> {#winProjet_commentairesFacultatif#}
		</div>
	</div>
	<input type="submit" value="{#winProjet_valider#|escape:"html"}" class="btn btn-primary" style="margin-left: 180px;" />
</form>