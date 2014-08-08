{* Smarty *}
{include file="www_header.tpl"}

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="soplanning-box">
				<div class="btn-group">
					{if in_array("projectgroups_manage_all", $user.tabDroits)}
						<a href="groupe_list.php" class="btn btn-small"><img src="assets/img/pictos/groupes.png" border="0" style="height: 16px;"/> {#menuListeGroupes#}</a>
					{/if}
					<a href="javascript:xajax_ajoutProjet('projets');undefined;" class="btn btn-small"><img src="assets/img/pictos/addprojet.png" border="0" style="height: 16px;"/> {#menuAjouterProjet#}</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="soplanning-box margin-top-10">
				<form action="projets.php" method="GET" class="form-inline">
					<label>{#projet_liste_afficherProjets#} :</label>
					<div class="btn-group" data-toggle="buttons-radio">
						<button type="button" class="btn btn-small{if $filtrageProjet eq 'tous'} active{/if}" onclick="top.location='?filtrageProjet=tous';">{#projet_liste_afficherProjetsTous#}</button>
						<button type="button" class="btn btn-small{if $filtrageProjet neq 'tous'} active{/if}" onclick="top.location='?filtrageProjet=date';">{#projet_liste_afficherProjetsParDate#}</button>
					</div>
					{if $filtrageProjet neq "tous"}
						<label style="margin-left:20px;">
							{#formNbMois#}:
						</label>
						<div class="input-append">
							<input name="nb_mois" type="text" size="2" value="{$nbMois}" class="input-mini" style="width:20px;" />
							<button class="btn btn-small" type="submit"><i class="icon-share-alt"></i></button>
						</div>
						<label>
							{#formDebut#}:
						</label>
						<div class="input-append">
							<input name="date_debut_affiche" id="date_debut_affiche" style="width:80px;" type="text" value="{$dateDebut}" class="input-mini datepicker" />
							<button class="btn btn-small" type="submit"><i class="icon-share-alt"></i></button>
						</div>
						<script>{literal}addEvent(window, 'load', function(){jQuery("#date_debut_affiche").datepicker()});{/literal}</script>
						<label>
							{#formInfoDateFin#} : {$dateFin}
						</label>
					{/if}
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="soplanning-box margin-top-10">
				<form action="" method="GET" class="form-inline">
					<label class="checkbox inline">{#projet_liste_afficherProjets#} :</label>
					<label class="checkbox inline">
						<input type="checkbox" name="statut[]" id="a_faire" value="a_faire" {if in_array('a_faire', $listeStatuts)}checked="checked"{/if}>{#projet_liste_statutAfaire#}
					</label>
					<label class="checkbox inline">
						<input type="checkbox" name="statut[]" id="en_cours" value="en_cours" {if in_array('en_cours', $listeStatuts)}checked="checked"{/if}>{#projet_liste_statutEnCours#}
					</label>
					<label class="checkbox inline">
						<input type="checkbox" name="statut[]" id="fait" value="fait" {if in_array('fait', $listeStatuts)}checked="checked"{/if}>{#projet_liste_statutFait#}
					</label>
					<label class="checkbox inline">
						<input type="checkbox" name="statut[]" id="abandon" value="abandon" {if in_array('abandon', $listeStatuts)}checked="checked"{/if}>{#projet_liste_statutAbandon#}
					</label>
					<input type="submit" value="{#formAfficher#|escape:"html"}" class="btn btn-small" style="margin-left: 10px;"/>

					<div class="btn-group" style="margin-left:70px">
						<div class="input-append">
							<input type="text" style="width:150px;" name="rechercheProjet" value="{$rechercheProjet|default:""}" />
							<input type="submit" value="{#projet_liste_chercher#}" class="btn {if $rechercheProjet neq ""}btn-danger{/if}" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="soplanning-box margin-top-10">
				<table class="table table-striped">
					<tr style="font-weight:bold;">
						<td colspan="2" align="center">
							{if $order eq "nom"}
								{if $by eq "asc"}
									<a href="?order=nom&by=desc">{#projet_liste_projet#}</a>&nbsp;<img src="{$BASE}/assets/img/pictos/asc_order.png" border="0" alt="" />
								{else}
									<a href="?order=nom&by=asc">{#projet_liste_projet#}</a>&nbsp;<img src="{$BASE}/assets/img/pictos/desc_order.png" border="0" alt="" />
								{/if}
							{else}
								<a href="?order=nom&by={$by}">{#projet_liste_projet#}</a>
							{/if}
						</td>
						<td align="center">
							{if $order eq "nom_createur"}
								{if $by eq "asc"}
									<a href="?order=nom_createur&by=desc">{#projet_liste_createur#}</a>&nbsp;<img src="{$BASE}/assets/img/pictos/asc_order.png" border="0" alt="" />
								{else}
									<a href="?order=nom_createur&by=asc">{#projet_liste_createur#}</a>&nbsp;<img src="{$BASE}/assets/img/pictos/desc_order.png" border="0" alt="" />
								{/if}
							{else}
								<a href="?order=nom_createur&by={$by}">{#projet_liste_createur#}</a>
							{/if}
						</td>
						<td align="center" nowrap="nowrap">
							{if $order eq "charge"}
								{if $by eq "asc"}
									<a href="?order=charge&by=desc">{#projet_liste_charge#}</a>&nbsp;<img src="{$BASE}/assets/img/pictos/asc_order.png" border="0" alt="" />
								{else}
									<a href="?order=charge&by=asc">{#projet_liste_charge#}</a>&nbsp;<img src="{$BASE}/assets/img/pictos/desc_order.png" border="0" alt="" />
								{/if}
							{else}
								<a href="?order=charge&by={$by}">{#projet_liste_charge#}</a>
							{/if}
						</td>
						<td align="center">
							{#projet_liste_livraison#}
						</td>
						<td align="center">
							{#projet_liste_commentaires#}
						</td>
					</tr>
					<tr>
						<td colspan="6" style="font-size:14px; background-color:#ECE9D8;"><b>{#projet_liste_sansGroupes#}</b></td>
					</tr>
					{assign var=groupeCourant value=""}
					{foreach from=$projets item=projet}
						{if $projet.groupe_id neq $groupeCourant}
							<td colspan="6" style="font-size:14px; background-color:#ECE9D8;"><b>{$projet.nom_groupe|xss_protect}</b></td>
						{/if}
						{if $projet.statut eq "a_faire"}
							{assign var=couleurLigne value="#ffffff"}
						{elseif $projet.statut eq "en_cours"}
							{assign var=couleurLigne value="#B0FB04"}
						{elseif $projet.statut eq "fait"}
							{assign var=couleurLigne value="#FFBE7D"}
						{elseif $projet.statut eq "abandon"}
							{assign var=couleurLigne value="#9D9D9D"}
						{/if}
						<tr style="background-color:{$couleurLigne};" onMouseOver="javascript:this.style.backgroundColor='#EEEEEE'" onMouseOut="javascript:this.style.backgroundColor='{$couleurLigne}'">
							<td width="25" style="font-size:8px;background-color:#{$projet.couleur};color:{"#"|cat:$projet.couleur|buttonFontColor}">{$projet.projet_id}</td>
							<td>
								{if in_array("projects_manage_all", $user.tabDroits) || (in_array("projects_manage_own", $user.tabDroits) && $projet.createur_id eq $user.user_id)}
									<a onClick="javascript:xajax_modifProjet('{$projet.projet_id}', 'projets');undefined;" style="cursor:pointer;"><img src="{$BASE}/assets/img/pictos/edit.gif" border="0" width="16" height="16" alt="Modifier" align="absbottom" /></a>
									&nbsp;
									<a href="{$BASE}/process/projet.php?projet_id={$projet.projet_id}&action=delete&origine=projets" onClick="javascript:return confirm('{#projet_liste_confirmSuppr#|escape:"javascript"}')"><img src="{$BASE}/assets/img/pictos/delete.gif" border="0" width="16" height="16" alt="supprimer"  align="absbottom" /></a>
								{/if}
								&nbsp;
								{$projet.nom|xss_protect}
							</td>
							<td>
								{$projet.nom_createur|xss_protect}
							</td>
							<td width="80" align="center">{$projet.charge}</td>
							<td width="80" align="center">
								{if $projet.livraison neq '' && $projet.livraison neq '0000-00-00'}
									<a href="planning.php?livraison={$projet.livraison}">{$projet.livraison|sqldate2userdate}</a>
								{/if}
							</td>
							<td>{$projet.iteration|xss_protect}</td>
						</tr>
						{assign var=groupeCourant value=$projet.groupe_id}
					{/foreach}
				</table>
			</div>
		</div>
	</div>
</div>

{include file="www_footer.tpl"}