{* Smarty *}

<form class="form-horizontal" method="POST" action="" onsubmit="return false;" name="formUser" >
{* pour tester si compte déjà existant ou pas *}
<input type="hidden" id="user_id_origine" value="{$user_form.user_id}">
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label">{#user_identifiant#} :</label>
				<div class="controls">
					{if $user_form.saved eq 1}
						{$user_form.user_id|escape:"html"}
						<input id="user_id" type="hidden" value="{$user_form.user_id|escape:"html"}" />
					{else}
						<input id="user_id" type="text" value="{$user_form.user_id|escape:"html"}" size="10" maxlength="10" />
					{/if}
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label">{#user_groupe#} :</label>
				<div class="controls">
					<select id="user_groupe_id">
						<option value="">- - - - - - - - - - -</option>
						{foreach from=$groupes item=groupe}
							<option value="{$groupe.user_groupe_id}" {if $user_form.user_groupe_id eq $groupe.user_groupe_id}selected="selected"{/if}>{$groupe.nom|escape}</option>
						{/foreach}
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label">{#user_nom#} :</label>
				<div class="controls">
					<input id="nom" type="text" value="{$user_form.nom|escape:"html"}" size="30" maxlength="100" />
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label">{#user_email#} :</label>
				<div class="controls">
					<input id="email_user" type="text" value="{$user_form.email|escape:"html"}" size="40" maxlength="255" />
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label">{#user_login#} :</label>
				<div class="controls">
					<input id="login_tmp" type="text" value="{$user_form.login|escape:"html"}" size="20" maxlength="20" />
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label">{#user_password#} :</label>
				<div class="controls">
					<input id="password_tmp" type="password" value="" size="20" maxlength="20" />
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label">{#user_visiblePlanning#} :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" id="visible_planningOui" name="visible_planning" value="oui" {if ($user_form.saved eq 0) || ($user_form.visible_planning eq "oui")}checked="checked"{/if}>&nbsp;{#oui#}
					</label>
					<label class="radio inline">
						<input type="radio" id="visible_planningNon" name="visible_planning" value="non" {if ($user_form.saved eq 1) && ($user_form.visible_planning eq "non")}checked="checked"{/if}>&nbsp;{#non#}
					</label>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label">{#user_couleur#} :</label>
				<div class="controls">
					<input id="couleur" type="text" size="7" maxlength="6" value="{$user_form.couleur|escape:"html"}" size="20" maxlength="20" onChange="$S('colorbox').background='#'+this.value;" />
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label">{#user_notifications#} :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" id="notificationsOui" name="notifications" value="oui" {if $user_form.notifications eq "oui"}checked="checked"{/if}> &nbsp;{#oui#}
					</label>
					<label class="radio inline">
						<input type="radio" id="notificationsNon" name="notifications" value="non" {if $user_form.notifications eq "non"}checked="checked"{/if}>&nbsp;{#non#}
					</label>
				</div>
			</div>
		</div>
		{if $user_form.saved eq 0}
			<div class="span6">
				<div class="control-group">
					<div class="controls" style="margin-left: 0px;">
						<label class="checkbox inline">
							<input type="checkbox" id="envoiMailPwd" name="envoiMailPwd" value="true" />&nbsp;{#user_mailPwd#}
						</label>
					</div>
				</div>
			</div>
		{else}
			<input type="hidden" id="envoiMailPwd" name="envoiMailPwd" value="false" />
		{/if}
	</div>
	<hr />
	<div class="row-fluid">
		<div class="span12">
			<div class="control-group">
				<label class="control-label">{#droits_utilisateurs#} :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio"name="users_manage" id="droit1" value="" {if !in_array("users_manage_all", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_aucundroitUser#}
					</label>
					<label class="radio inline">
						<input type="radio"name="users_manage" id="users_manage_all" value="users_manage_all" {if in_array("users_manage_all", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_gererTousUsers#}
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="control-group">
				<label class="control-label">{#droits_projets#} :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="projects_manage" id="droit2" value="" {if !in_array("projects_manage_all", $user_form.tabDroits) && !in_array("projects_manage_own", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_aucunDroitProjets#}
					</label>
					<label class="radio inline">
						<input type="radio" name="projects_manage" id="projects_manage_all" value="projects_manage_all" {if in_array("projects_manage_all", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_gererTousProjets#}
					</label>
					<label class="radio inline">
						<input type="radio" name="projects_manage" id="projects_manage_own" value="projects_manage_own" {if in_array("projects_manage_own", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_uniquementProjProprio#}
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="control-group">
				<label class="control-label">{#droits_groupesProjets#} :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="projectgroups_manage" id="droit3" value="" {if !in_array("projectgroups_manage_all", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_groupesProjetsAucun#}
					</label>
					<label class="radio inline">
						<input type="radio" name="projectgroups_manage" id="projectgroups_manage_all" value="projectgroups_manage_all" {if in_array("projectgroups_manage_all", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_gererTousGroupes#}
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="control-group">
				<label class="control-label">{#droits_modifPlanning#} :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="planning_modif" id="tasks_readonly" value="tasks_readonly" {if in_array("tasks_readonly", $user_form.tabDroits) || (!in_array("tasks_modify_all", $user_form.tabDroits) && !in_array("tasks_modify_own_project", $user_form.tabDroits) && !in_array("tasks_modify_own_task", $user_form.tabDroits))}checked="checked"{/if}>&nbsp;{#droits_planningLectureSeule#}
					</label>
					<label class="radio inline">
						<input type="radio" name="planning_modif" id="tasks_modify_all" value="tasks_modify_all" {if in_array("tasks_modify_all", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_planningTousProjets#}
					</label>
					<label class="radio inline">
						<input type="radio" name="planning_modif" id="tasks_modify_own_project" value="tasks_modify_own_project" {if in_array("tasks_modify_own_project", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_planningProjetsProprio#}
					</label>
				</div>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="planning_modif" id="tasks_modify_own_task" value="tasks_modify_own_task" {if in_array("tasks_modify_own_task", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_planningTachesAssignees#}
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="control-group">
				<label class="control-label">{#droits_vuePlanning#} :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="planning_view" id="tasks_view_all_projects" value="tasks_view_all_projects" {if in_array("tasks_view_all_projects", $user_form.tabDroits) || !in_array("tasks_view_own_projects", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_vueTousProjets#}
					</label>
					<label class="radio inline">
						<input type="radio" name="planning_view" id="tasks_view_team_projects" value="tasks_view_team_projects" {if in_array("tasks_view_team_projects", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_vueProjetsEquipe#}
					</label>
				</div>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="planning_view" id="tasks_view_own_projects" value="tasks_view_own_projects" {if in_array("tasks_view_own_projects", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_vueProjetsAssignes#}
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="control-group">
				<label class="control-label">{#droits_parametres#} :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="parameters" id="droit5" value="" {if !in_array("parameters_modify", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_aucunParametres#}
					</label>
					<label class="radio inline">
						<input type="radio" name="parameters" id="parameters_modify" value="parameters_all" {if in_array("parameters_all", $user_form.tabDroits)}checked="checked"{/if}>&nbsp;{#droits_parametresAcces#}
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<input type="button" class="btn btn-primary" style="margin-left: 180px;" value="{#submit#}" onClick="xajax_submitFormUser($('user_id').value, $('user_id_origine').value, $('user_groupe_id').value, $('nom').value, $('email_user').value, $('login_tmp').value, $('password_tmp').value, $('visible_planningOui').checked, $('couleur').value, $('notificationsOui').checked, $('envoiMailPwd').checked, new Array(getRadioValue('users_manage'), getRadioValue('projects_manage'), getRadioValue('projectgroups_manage'), getRadioValue('planning_modif'), getRadioValue('planning_view'), getRadioValue('parameters')));" />
		</div>
	</div>
</div>