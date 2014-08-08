{* Smarty *}
{include file="www_header.tpl"}

<div class="container-fluid">
	<div class="print">
		{#formDebut#} : {$dateDebut} ==> {#formInfoDateFin#} : {$dateFin}
	</div>
	<div class="row-fluid noprint">
		<div class="span12">
			<div class="soplanning-box" style="margin: 0px 10px;">
				<form action="process/planning.php" method="GET" class="form-inline">
					{if $modeAffichage eq "mois"}
						<label>
							{#formNbMois#} :
						</label>
						<div class="input-append">
							<input name="nb_mois" type="text" size="2" value="{$nbMois}" class="input-mini" style="width:20px;" />
							<button class="btn btn-small" type="submit"><i class="icon-share-alt"></i></button>
						</div>
					{else}
						<label>
							{#formNbJours#} :
						</label>
						<div class="input-append">
							<input name="nb_jours" type="text" size="2" value="{$nbJours}" class="input-mini" style="width:20px;" />
							<button class="btn btn-small" type="submit"><i class="icon-share-alt"></i></button>
						</div>
					{/if}
					<label style="margin-left:20px;">
						{#formDebut#} :
					</label>
					<div class="input-append">
						<input name="date_debut_affiche" id="date_debut_affiche" type="text" value="{$dateDebut}" class="input-mini datepicker" style="width:80px;" />
						<button class="btn btn-small" type="submit"><i class="icon-share-alt"></i></button>
					</div>
					<script>{literal}addEvent(window, 'load', function(){jQuery("#date_debut_affiche").datepicker()});{/literal}</script>
					<label style="margin-left:20px;">
						{#formInfoDateFin#} : {$dateFin}
					</label>
					<div class="btn-group" style="margin-left:20px">
						<a class="btn btn-small" onClick="document.location='process/planning.php?date_debut_affiche={$dateBoutonInferieur}';"><i class="icon-backward"></i> {$dateBoutonInferieur}</a>
						<a class="btn btn-small" onClick="document.location='process/planning.php?date_debut_affiche={$dateBoutonSuperieur}';">{$dateBoutonSuperieur} <i class="icon-forward"></i></a>
					</div>
					{if !in_array("planning_readonly", $user.tabDroits)}
						<label style="margin-left:20px">
							<a class="btn btn-info btn-small" href="javascript:Reloader.stopRefresh();xajax_ajoutPeriode();undefined;">
								{if !$smarty.server.HTTP_USER_AGENT|strstr:"MSIE 8.0"}
									<img src="{$BASE}/assets/img/pictos/addplanning.png" border="0" style="vertical-align:middle;padding-right:4px;">
								{/if}
								{#menuAjouterPeriode#}
							</a>
						</label>
					{/if}
				</form>
			</div>
		</div>
	</div>
	<div class="row-fluid noprint">
		<div class="span12">
			<div class="soplanning-box" style="margin: 10px;">
				<div class="row-fluid">
					{* DIV POUR CHOIX FILTRE USERS *}
					<div class="btn-group">
						<button class="btn {if $filtreUser|@count > 0}btn-danger{/if} dropdown-toggle btn-small" data-toggle="dropdown">{#formChoixUser#}&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
							{if $filtreUser|@count > 0}
			                    <a href="process/planning.php?desactiverFiltreUser=1" class="btn btn-danger btn-small" style="margin-left:10px;">{#formFiltreUserDesactiver#}</a>
							{/if}
							<li><a onClick="event.cancelBubble=true;" href="javascript:filtreUserCocheTous(true);undefined;">{#formFiltreUserCocherTous#}</a></li>
							<li><a onClick="event.cancelBubble=true;" href="javascript:filtreUserCocheTous(false);undefined;">{#formFiltreUserDecocherTous#}</a></li>
							<li class="divider"></li>
							<form action="process/planning.php" method="POST">
							<li>
								<input type="hidden" name="filtreUser" value="1">
								<table onClick="event.cancelBubble=true;" style="margin:10px;">
									<tr>
										<td nowrap="nowrap" valign="top">
											<input type="checkbox" id="gu0" value="1" onClick="filtreCocheUserGroupe('0')" /><label for="gu0" style="display:inline">&nbsp;<b>{#cocheUserSansGroupe#}</b></label>
											{assign var=groupeTemp value=""}

											{math assign=nbColonnes equation="ceil(nbUsers / nbUsersParColonnes)" nbUsers=$listeUsers|@count nbUsersParColonnes=$smarty.const.FILTER_NB_USERS_PER_COLUMN}
											{math assign=maxCol equation="ceil(nbUsers / nbColonnes)" nbUsers=$listeUsers|@count nbColonnes=$nbColonnes}
											{assign var=tmpNbDansColCourante value="0"}
											{foreach from=$listeUsers item=userCourant name=loopUsers}
												{if $tmpNbDansColCourante eq $maxCol}
													{assign var=tmpNbDansColCourante value="0"}
													</td>
													<td nowrap="nowrap" valign="top">
												{else}
													{if $userCourant.user_groupe_id neq $groupeTemp}
														<br /><br />
													{/if}
												{/if}
												{if $userCourant.user_groupe_id neq $groupeTemp}
													<input type="checkbox" id="gu{$userCourant.user_groupe_id}" value="1" onClick="filtreCocheUserGroupe('{$userCourant.user_groupe_id}')" /> <label for="gu{$userCourant.user_groupe_id}" style="display:inline"><b>{$userCourant.groupe_nom}</b></label>
												{/if}
												<br />
												<input type="checkbox" id="user_{$userCourant.user_id}" value="{$userCourant.user_id}" name="user_{$userCourant.user_id}" onClick="checkStatutUserGroupe(this, '{$userCourant.user_groupe_id}')" {if in_array($userCourant.user_id, $filtreUser)}checked="checked"{/if} /> <label for="user_{$userCourant.user_id}" style="display:inline">{$userCourant.nom|escape} ({$userCourant.user_id})</label>
												{assign var=groupeTemp value=$userCourant.user_groupe_id}
												{assign var=tmpNbDansColCourante value=$tmpNbDansColCourante+1}
											{/foreach}
										</td>
									</tr>
								</table>
							</li>
							<li><input type="submit" value="{#submit#}" style="margin-left:10px;" class="btn btn-small" /></li>
							</form>
						</ul>
					</div>
					{* DIV POUR CHOIX FILTRE PROJETS *}
					<div class="btn-group">
						<button class="btn {if $filtreGroupeProjet|@count > 0}btn-danger{/if} dropdown-toggle btn-small" data-toggle="dropdown">{#formChoixProjet#}&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
							{if $listeProjets|@count eq 0}
								<li>&nbsp;&nbsp;{#formFiltreProjetAucunProjet#}</li>
							{else}
								{if $filtreGroupeProjet|@count > 0}
									<a href="process/planning.php?desactiverFiltreGroupeProjet=1" class="btn btn-danger btn-small" style="margin-left:10px;">{#formFiltreProjetDesactiver#}</a>
								{/if}
								<li><a onClick="event.cancelBubble=true;" href="javascript:filtreGroupeProjetCocheTous(true);undefined;">{#formFiltreProjetCocherTous#}</a></li>
								<li><a onClick="event.cancelBubble=true;" href="javascript:filtreGroupeProjetCocheTous(false);undefined;">{#formFiltreProjetDecocherTous#}</a></li>
								<li class="divider"></li>
								<form action="process/planning.php" method="POST">
								<li>
									<input type="hidden" name="filtreGroupeProjet" value="1">
									<table onClick="event.cancelBubble=true;" style="margin:10px;">
										<tr>
											<td nowrap="nowrap" valign="top">
												<input type="checkbox" id="g0" value="1" onClick="filtreCocheGroupe('0')" /><label for="g0" style="display:inline">&nbsp;<b>{#projet_liste_sansGroupes#}</b></label>
												{assign var=groupeTemp value=""}
												{math assign=nbColonnes equation="ceil(nbProjets / nbProjetsParColonnes)" nbProjets=$listeProjets|@count nbProjetsParColonnes=$smarty.const.FILTER_NB_PROJECTS_PER_COLUMN}
												{math assign=maxCol equation="ceil(nbProjets / nbColonnes)" nbProjets=$listeProjets|@count nbColonnes=$nbColonnes}
												{assign var=tmpNbDansColCourante value="0"}
												{foreach from=$listeProjets item=projetCourant name=loopProjets}
													{if $tmpNbDansColCourante eq $maxCol}
														{assign var=tmpNbDansColCourante value="0"}
														</td>
														<td nowrap="nowrap" valign="top">
													{else}
														{if $projetCourant.groupe_id neq $groupeTemp}
															<br /><br />
														{/if}
													{/if}
													{if $projetCourant.groupe_id neq $groupeTemp}
														<input type="checkbox" id="g{$projetCourant.groupe_id}" value="1" onClick="filtreCocheGroupe('{$projetCourant.groupe_id}')" /> <label for="g{$projetCourant.groupe_id}" style="display:inline"><b>{$projetCourant.groupe_nom}</b></label>
													{/if}
													<br />
													<input type="checkbox" id="projet_{$projetCourant.projet_id}" value="{$projetCourant.projet_id}" name="projet_{$projetCourant.projet_id}" onClick="checkStatutGroupe(this, '{$projetCourant.groupe_id}')" {if in_array($projetCourant.projet_id, $filtreGroupeProjet)}checked="checked"{/if} /> <label for="projet_{$projetCourant.projet_id}" style="display:inline">{$projetCourant.nom|escape} ({$projetCourant.projet_id})
													{assign var=groupeTemp value=$projetCourant.groupe_id}</label>
													{assign var=tmpNbDansColCourante value=$tmpNbDansColCourante+1}
												{/foreach}
											</td>
										</tr>
									</table>
								</li>
								<li><input type="submit" value="{#submit#}" style="margin-left:10px;" class="btn" /></li>
								</form>
							{/if}
						</ul>
					</div>
					{* DIV POUR CHOIX FILTRE STATUT TACHES *}
					<div class="btn-group">
						<button class="btn {if $filtreStatutTache|@count > 0}btn-danger{/if} dropdown-toggle btn-small" data-toggle="dropdown">{#formChoixStatutTache#}&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<form action="process/planning.php" method="POST">
							<li>
									<input type="hidden" name="filtreStatutTache" value="1">
									<table onClick="event.cancelBubble=true;" style="margin:10px;">
										<tr>
											<td nowrap="nowrap" valign="top">
												<input type="checkbox" id="a_faire" name="statutsTache[]" value="a_faire" {if in_array('a_faire', $filtreStatutTache)}checked="checked"{/if} /><label for="a_faire" style="display:inline">&nbsp;{#winPeriode_statut_a_faire#}</label><br />
												<input type="checkbox" id="en_cours" name="statutsTache[]" value="en_cours" {if in_array('en_cours', $filtreStatutTache)}checked="checked"{/if} /><label for="en_cours" style="display:inline">&nbsp;{#winPeriode_statut_en_cours#}</label><br />
												<input type="checkbox" id="fait" name="statutsTache[]" value="fait" {if in_array('fait', $filtreStatutTache)}checked="checked"{/if} /><label for="fait" style="display:inline">&nbsp;{#winPeriode_statut_fait#}</label><br />
												<input type="checkbox" id="abandon" name="statutsTache[]" value="abandon" {if in_array('abandon', $filtreStatutTache)}checked="checked"{/if} /><label for="abandon" style="display:inline">&nbsp;{#winPeriode_statut_abandon#}</label>
											</td>
										</tr>
									</table>
							</li>
							<li><input type="submit" value="{#submit#}" style="margin-left:10px;" class="btn" /></li>
							</form>
						</ul>
					</div>
					{* DIV POUR TRI AFFICHAGE *}
					<div class="btn-group">
						<button class="btn dropdown-toggle btn-small" data-toggle="dropdown">{#formTrierPar#}&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
							{if $inverserUsersProjets}
								{foreach from=$triPlanningPossibleProjet item=triTemp}
									{assign var=chaineTmp value="triProjet_"|cat:$triTemp|replace:' ':'_'|replace:',':'_'}
									<li {if $triTemp eq $triPlanning}class="active"{/if}><a href="process/planning.php?triPlanning={$triTemp|urlencode}">{$smarty.config.$chaineTmp}</a></li>
								{/foreach}
							{else}
								{foreach from=$triPlanningPossibleUser item=triTemp}
									{assign var=chaineTmp value="triUser_"|cat:$triTemp|replace:' ':'_'|replace:',':'_'}
									<li {if $triTemp eq $triPlanning}class="active"{/if}><a href="process/planning.php?triPlanning={$triTemp|urlencode}">{$smarty.config.$chaineTmp}</a></li>
								{/foreach}
							{/if}
						</ul>
					</div>
					<div class="btn-group">
						<a href="javascript:window.print();" class="btn btn-small" id="btPrint" rel="tooltip" title="{#printAll#|escape}"><img align="absbottom" border="0" src="assets/img/pictos/printButton.png"></a>
						<a href="export_csv.php" class="btn btn-small" id="btCSVexport" rel="tooltip" title="{#CSVExport#|escape}"><img align="absbottom" border="0" src="assets/img/pictos/CSVIcon.gif"></a>
						<a href="javascript:xajax_choixPDF();undefined;" class="btn btn-small" id="btChoixPDF" rel="tooltip" title="{#PDFExport#|escape}"><img align="absbottom" border="0" src="assets/img/pictos/pdf.png"></a>
						<a href="export_gantt.php" target="_blank" class="btn btn-small" rel="tooltip" title="{#ganttExport#|escape}"><img align="absbottom" border="0" src="assets/img/pictos/gantt.png"></a>
						<a href="export_pdf_calendrier.php" target="_blank" class="btn btn-small" rel="tooltip" title="{#calendarExport#|escape}"><img align="absbottom" border="0" src="assets/img/pictos/calendar.png"></a>
						<a href="javascript:xajax_choixIcal();undefined;" class="btn btn-small" rel="tooltip" title="{#icalExport#|escape}"><img align="absbottom" border="0" src="assets/img/pictos/ical.png"></a>
						{if $affichageLarge eq 0}
							<a href="?affichageLarge=1" class="btn btn-small" rel="tooltip" title="{#affichageReduit#|escape}"><img align="absbottom" border="0" src="assets/img/pictos/scroll.png"></a>
						{else}
							<a href="?affichageLarge=1" class="btn btn-small" rel="tooltip" title="{#affichageReduit#|escape}"><img align="absbottom" border="0" src="assets/img/pictos/scroll.png"></a>
						{/if}
					</div>
					{* DIV POUR RECHERCHE TEXTE *}
					<div class="btn-group">
						<form action="process/planning.php" method="POST" class="form-search">
							<div class="input-append">
								<input type="text" name="filtreTexte" value="{$filtreTexte|escape:"html"}" class="span2 search-query" maxlength="50" rel="tooltip" title="{#formFiltreTexte#|escape}" id="filtreTexte" style="width:80px">
								<button class="btn {if $filtreTexte != ""}btn-danger{/if}" type="submit"><i class="icon-search"></i></button>
								{if $filtreTexte != ""}
									<div class="btn-group">
										<button class="btn dropdown-toggle" data-toggle="dropdown">&nbsp;<span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li><a href="process/planning.php?desactiverFiltreTexte=1">{#formFiltreUserDesactiver#}</a></li>
										</ul>
									</div>
								{/if}
							</div>
						</form>
					</div>
					<div class="btn-group">
						<label>
							{if $modeAffichage eq "mois"}
								<a class="btn btn-info btn-small" href="planning_per_day.php">{#menuPlanningJour#}</a>
							{else}
								<a class="btn btn-info btn-small" href="planning.php">{#menuPlanningMois#}</a>
							{/if}
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
	{* le planning *}
	<div class="row-fluid">
		<div class="span12">
			<div class="soplanning-box" style="margin: 0px 10px;">
				<table id="tabPlanning" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="100" align="right">
							<table id="layerPersonnes" border="0" cellpadding="0" cellspacing="1">
								<tbody id="bodyLayerPersonnes">
									<tr id="loadingLayerPersonnes">
										<td align="center" class="entete" nowrap="nowrap"><br /><br />{#loading#}<br /><br /><br /></td>
									</tr>
								</tbody>
							</table>
						</td>
						<td valign="top">
							<div id="divConteneurPlanning" {if $affichageLarge eq 0}style="width:700px; overflow-x:scroll"{/if}>
								{$htmlTableau}
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="row-fluid noprint">
		<div class="span12">
			<div class="soplanning-box" style="margin: 10px;">
				<div class="row-fluid">
					{* PAGINATION *}
					{if $nbPagesLignes > 1}
						<div class="pagination">
							<ul>
							{section loop=$nbPagesLignes name=loopPages}
								{if $pageLignes eq $smarty.section.loopPages.iteration}
									<li class="active">
										<a href="#">{$smarty.section.loopPages.iteration}</a>
									</li>
									{else}
									<li>
										<a href="{$BASE}/process/planning.php?page_lignes={$smarty.section.loopPages.iteration}">{$smarty.section.loopPages.iteration}</a>
									</li>
									{/if}
									{if !$smarty.section.loopPages.last}

									{/if}
								{/section}
							</ul>
						</div>
					{/if}
					<div class="btn-group">
						<a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">{$nbLignes} {#planning_nbLignes#} <span class="caret"></span></a>
						{assign var=tabPages value=","|explode:$smarty.const.CONFIG_PLANNING_PAGES}
						<ul class="dropdown-menu">
							{foreach from=$tabPages item=valTemp}
							<li>
								<a onClick="top.location='{$BASE}/process/planning.php?nb_lignes='+{$valTemp}"">{$valTemp} {#planning_nbLignes#}</a>
							</li>
							{/foreach}
						</ul>
					</div>
					<div class="btn-group">
						<a class="btn dropdown-toggle btn-small {if $masquerLigneVide eq 1}btn-danger{/if}" data-toggle="dropdown" href="#">{#planning_masquerLignesVides#} <span class="caret"></span></a>
						<ul class="dropdown-menu">
							 {if $masquerLigneVide eq 1}
							<li>
								<a onClick="top.location='process/planning.php?masquerLigneVide=0'">{#planning_masquerLignesVides_non#}</a>
							</li>
							 {else}
							<li>
								<a onClick="top.location='process/planning.php?masquerLigneVide=1'">{#planning_masquerLignesVides_oui#}</a>
							</li>
							{/if}
						</ul>
					</div>
					<div class="btn-group">
						<a class="btn dropdown-toggle btn-small {if $afficherLigneTotal eq 1}btn-danger{/if}" data-toggle="dropdown" href="#">{#planning_afficherLigneTotal#} <span class="caret"></span></a>
						<ul class="dropdown-menu">
							 {if $afficherLigneTotal eq 1}
							<li>
								<a onClick="top.location='process/planning.php?afficherLigneTotal=0'">{#non#}</a>
							</li>
							 {else}
							<li>
								<a onClick="top.location='process/planning.php?afficherLigneTotal=1'">{#oui#}</a>
							</li>
							{/if}
						</ul>
					</div>
					<div class="btn-group">
						<a class="btn dropdown-toggle btn-small" data-toggle="dropdown"  onclick="javascript:toggle2('divProjectTable');" >{#hide_show_table#}</a>
					</div>
					{* PAGINATION *}
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid noprint">
		<div class="soplanning-box" style="margin: 0px 10px;">
			{$htmlRecap}
		</div>
	</div>
</div>


{* GESTION DU DRAG N DROP *}
{literal}
<script language="javascript">
destinationsDrag = new Array();

var origineCaseX;
var origineCaseY;
function modifPeriode(obj, periode_id){
	if(origineCaseX != parseInt(obj.style.left) || origineCaseY != parseInt(obj.style.top)) {
		return false;
	}
	xajax_modifPeriode(periode_id);
}

{/literal}
{$js}
{literal}

</script>
{/literal}
{* FIN GESTION DU DRAG N DROP *}



{* JAVASCRIPT POUR CHOIX FILTRE PROJETS *}
<script language="javascript">
var listeProjets = new Array();
listeProjets[0] = new Array();
{assign var=groupeTemp value=""}
{foreach from=$listeProjets item=projetCourant}
	{if $projetCourant.groupe_id neq $groupeTemp}
		listeProjets[{$projetCourant.groupe_id}] = new Array();
	{/if}
	{if $projetCourant.groupe_id eq ''}
		listeProjets[0].push('{$projetCourant.projet_id}');
	{else}
		listeProjets[{$projetCourant.groupe_id}].push('{$projetCourant.projet_id}');
	{/if}
	{assign var=groupeTemp value=$projetCourant.groupe_id}
{/foreach}

{literal}
// coche ou decoche tous les projets
function filtreGroupeProjetCocheTous(action) {
	for (var groupe in listeProjets) {
		if (!document.getElementById('g' + groupe)) {
			// si pas une case ? cocher existantes, on sort
			continue;
		}
		document.getElementById('g' + groupe).checked = action;
		for (var projet in listeProjets[groupe]) {
			if (!document.getElementById('projet_' + listeProjets[groupe][projet])) {
				// si pas une case ? cocher existantes, on sort
				continue;
			}
			document.getElementById('projet_' + listeProjets[groupe][projet]).checked = action;
		}
	}
}

// coche ou decoche les projets d'un groupe
function filtreCocheGroupe(groupe) {
	var action = document.getElementById('g' + groupe).checked;
	for (var projet in listeProjets[groupe]) {
		if (!document.getElementById('projet_' + listeProjets[groupe][projet])) {
			// si pas une case ? cocher existantes, on sort
			continue;
		}
		document.getElementById('projet_' + listeProjets[groupe][projet]).checked = action;
	}
}

// decoche le groupe si on decoche un projet
function checkStatutGroupe(obj, groupe) {
	if (groupe == '') {
		groupe = '0';
	}
	if (!obj.checked) {
		document.getElementById('g' + groupe).checked = false;
	}
}

{/literal}
</script>
{* FIN JAVASCRIPT POUR CHOIX FILTRE PROJETS *}



{* MENU POUR CHOIX ACTION APRES DRAG AND DROP CASE *}
<script language="javascript">
	var idCaseEnCoursDeplacement = false;
	var idCaseDestination = false;
</script>

<div id="divChoixDragNDrop" style="border: 1px solid #000000;background-color:#ffffff;position:absolute;z-index:100;display:none;padding:10px;" onMouseOut="masquerSousMenuDelai('divChoixDragNDrop');" onMouseOver="AnnuleMasquerSousMenu('divChoixDragNDrop');" onfocus="AnnuleMasquerSousMenu('divChoixDragNDrop')">
	<a href="javascript:windowPatienter();xajax_moveCasePeriode(idCaseEnCoursDeplacement, destination, false);undefined;">{#planning_deplacer#}</a>
	<br /><br />
	<a href="javascript:windowPatienter();xajax_moveCasePeriode(idCaseEnCoursDeplacement, destination, true);undefined;">{#planning_copier#}</a>
	<br /><br />
	<a href="javascript:location.reload();undefined;">{#planning_annuler#}</a>
</div>

{* JAVASCRIPT POUR CHOIX FILTRE USERS *}
<script language="javascript">
var listeUsers = new Array();
listeUsers[0] = new Array();
{assign var=groupeTemp value=""}
{foreach from=$listeUsers item=userCourant}
	{if $userCourant.user_groupe_id neq $groupeTemp}
		listeUsers[{$userCourant.user_groupe_id}] = new Array();
	{/if}
	{if $userCourant.user_groupe_id eq ''}
		listeUsers[0].push('{$userCourant.user_id}');
	{else}
		listeUsers[{$userCourant.user_groupe_id}].push('{$userCourant.user_id}');
	{/if}
	{assign var=groupeTemp value=$userCourant.user_groupe_id}
{/foreach}


{literal}
// coche ou decoche tous les Users
function filtreUserCocheTous(action) {
	for (var groupe in listeUsers) {
		if (!document.getElementById('gu' + groupe)) {
			// si pas une case ? cocher existantes, on sort
			continue;
		}
		document.getElementById('gu' + groupe).checked = action;
		for (var user in listeUsers[groupe]) {
			if (!document.getElementById('user_' + listeUsers[groupe][user])) {
				// si pas une case ? cocher existantes, on sort
				continue;
			}
			document.getElementById('user_' + listeUsers[groupe][user]).checked = action;
		}
	}
}

// coche ou decoche les users d'un groupe
function filtreCocheUserGroupe(groupe) {
	var action = document.getElementById('gu' + groupe).checked;
	for (var user in listeUsers[groupe]) {
		if (!document.getElementById('user_' + listeUsers[groupe][user])) {
			// si pas une case ? cocher existantes, on sort
			continue;
		}
		document.getElementById('user_' + listeUsers[groupe][user]).checked = action;
	}
}

// decoche le groupe si on decoche un user
function checkStatutUserGroupe(obj, groupe) {
	if (groupe == '') {
		groupe = '0';
	}
	if (!obj.checked) {
		document.getElementById('gu' + groupe).checked = false;
	}
}
{/literal}
</script>
{* FIN JAVASCRIPT POUR CHOIX FILTRE USERS *}


{* FONCTION POUR COPIER LE TABLEAU DES PERSONNES *}
<script language="javascript">
{literal}
function copierTableauPersonnes () {
	document.getElementById('loadingLayerPersonnes').style.display = 'none';

	// on adapte le div ? la largeur de la fenetre
	document.getElementById('divConteneurPlanning').style.width = document.body.offsetWidth - 80 - document.getElementById('tdUser_0').offsetWidth + 'px';

	// recopie de la premiere case
	trTemp = document.createElement("tr");
	thTemp = document.createElement("th");
	thTemp.setAttribute('id', 'tdUserCopie_0');
	trTemp.appendChild(thTemp);
	document.getElementById('bodyLayerPersonnes').appendChild(trTemp);
	document.getElementById('tdUserCopie_0').style.height = document.getElementById('tdUser_0').offsetHeight + 'px';
	document.getElementById('tdUserCopie_0').innerHTML = '<a id="lienInverse" href="process/planning.php?inverserUsersProjets={/literal}{if $inverserUsersProjets eq 0}1{else}0{/if}{literal}"><img src="assets/img/pictos/switch.png" border="0" /></a>';

	var table = document.getElementById("tabContenuPlanning");
	numeroCellule = 1;
	for (var i = {/literal}{if $modeAffichage eq "mois"}4{else}2{/if}{literal}, row; row = table.rows[i]; i++) {
		for (var j = 0, col; col = row.cells[j]; j++) {
			if (j == 0) {
				thACopier = col.cloneNode(true);
				thACopier.setAttribute('id', 'tdUserCopie_' + numeroCellule);
				trTemp = document.createElement("tr");
				trTemp.appendChild(thACopier);
				document.getElementById('bodyLayerPersonnes').appendChild(trTemp);
				document.getElementById('tdUserCopie_' + numeroCellule).style.height = col.offsetHeight + 'px';
				numeroCellule++;
				col.style.display = 'none';
			}
		}
	}

	document.getElementById("tdUser_0").style.display = 'none';
}
{/literal}
</script>
{* FONCTION POUR COPIER LE TABLEAU DES PERSONNES *}

<script language="javascript">
{literal}
addEvent(window, 'load', copierTableauPersonnes);

Reloader.init({/literal}{$smarty.const.CONFIG_REFRESH_TIMER}{literal});
{/literal}

{* textes pour erreur dans fichier JS *}
var js_choisirProjet = '{#js_choisirProjet#|escape:"javascript"}';
var js_choisirDateDebut = '{#js_choisirDateDebut#|escape:"javascript"}';
var js_saisirFormatDate = '{#js_saisirFormatDate#|escape:"javascript"}';
var js_dateFinInferieure = '{#js_dateFinInferieure#|escape:"javascript"}';
var js_saisirIDProjet = '{#js_saisirIDProjet#|escape:"javascript"}';
var js_saisirNomProjet = '{#js_saisirNomProjet#|escape:"javascript"}';
var js_saisirCouleur = '{#js_saisirCouleur#|escape:"javascript"}';
var js_saisirCharge = '{#js_saisirCharge#|escape:"javascript"}';
var js_saisirSemaine = '{#js_saisirSemaine#|escape:"javascript"}';
var js_deposerCaseSurDate = '{#js_deposerCaseSurDate#|escape:"javascript"}';
var js_deplacementOk = '{#js_deplacementOk#|escape:"javascript"}';
var js_patienter = '{#js_patienter#|escape:"javascript"}';
</script>

{include file="www_footer.tpl"}