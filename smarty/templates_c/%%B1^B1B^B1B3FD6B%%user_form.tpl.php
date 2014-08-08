<?php /* Smarty version 2.6.26, created on 2014-07-20 22:08:46
         compiled from user_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'user_form.tpl', 13, false),)), $this); ?>

<form class="form-horizontal" method="POST" action="" onsubmit="return false;" name="formUser" >
<input type="hidden" id="user_id_origine" value="<?php echo $this->_tpl_vars['user_form']['user_id']; ?>
">
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['user_identifiant']; ?>
 :</label>
				<div class="controls">
					<?php if ($this->_tpl_vars['user_form']['saved'] == 1): ?>
						<?php echo ((is_array($_tmp=$this->_tpl_vars['user_form']['user_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

						<input id="user_id" type="hidden" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user_form']['user_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
					<?php else: ?>
						<input id="user_id" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user_form']['user_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="10" maxlength="10" />
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['user_groupe']; ?>
 :</label>
				<div class="controls">
					<select id="user_groupe_id">
						<option value="">- - - - - - - - - - -</option>
						<?php $_from = $this->_tpl_vars['groupes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['groupe']):
?>
							<option value="<?php echo $this->_tpl_vars['groupe']['user_groupe_id']; ?>
" <?php if ($this->_tpl_vars['user_form']['user_groupe_id'] == $this->_tpl_vars['groupe']['user_groupe_id']): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['groupe']['nom'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['user_nom']; ?>
 :</label>
				<div class="controls">
					<input id="nom" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user_form']['nom'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="30" maxlength="100" />
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['user_email']; ?>
 :</label>
				<div class="controls">
					<input id="email_user" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user_form']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="40" maxlength="255" />
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['user_login']; ?>
 :</label>
				<div class="controls">
					<input id="login_tmp" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user_form']['login'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="20" maxlength="20" />
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['user_password']; ?>
 :</label>
				<div class="controls">
					<input id="password_tmp" type="password" value="" size="20" maxlength="20" />
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['user_visiblePlanning']; ?>
 :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" id="visible_planningOui" name="visible_planning" value="oui" <?php if (( $this->_tpl_vars['user_form']['saved'] == 0 ) || ( $this->_tpl_vars['user_form']['visible_planning'] == 'oui' )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['oui']; ?>

					</label>
					<label class="radio inline">
						<input type="radio" id="visible_planningNon" name="visible_planning" value="non" <?php if (( $this->_tpl_vars['user_form']['saved'] == 1 ) && ( $this->_tpl_vars['user_form']['visible_planning'] == 'non' )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['non']; ?>

					</label>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['user_couleur']; ?>
 :</label>
				<div class="controls">
					<input id="couleur" type="text" size="7" maxlength="6" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user_form']['couleur'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="20" maxlength="20" onChange="$S('colorbox').background='#'+this.value;" />
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['user_notifications']; ?>
 :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" id="notificationsOui" name="notifications" value="oui" <?php if ($this->_tpl_vars['user_form']['notifications'] == 'oui'): ?>checked="checked"<?php endif; ?>> &nbsp;<?php echo $this->_config[0]['vars']['oui']; ?>

					</label>
					<label class="radio inline">
						<input type="radio" id="notificationsNon" name="notifications" value="non" <?php if ($this->_tpl_vars['user_form']['notifications'] == 'non'): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['non']; ?>

					</label>
				</div>
			</div>
		</div>
		<?php if ($this->_tpl_vars['user_form']['saved'] == 0): ?>
			<div class="span6">
				<div class="control-group">
					<div class="controls" style="margin-left: 0px;">
						<label class="checkbox inline">
							<input type="checkbox" id="envoiMailPwd" name="envoiMailPwd" value="true" />&nbsp;<?php echo $this->_config[0]['vars']['user_mailPwd']; ?>

						</label>
					</div>
				</div>
			</div>
		<?php else: ?>
			<input type="hidden" id="envoiMailPwd" name="envoiMailPwd" value="false" />
		<?php endif; ?>
	</div>
	<hr />
	<div class="row-fluid">
		<div class="span12">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['droits_utilisateurs']; ?>
 :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio"name="users_manage" id="droit1" value="" <?php if (! in_array ( 'users_manage_all' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_aucundroitUser']; ?>

					</label>
					<label class="radio inline">
						<input type="radio"name="users_manage" id="users_manage_all" value="users_manage_all" <?php if (in_array ( 'users_manage_all' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_gererTousUsers']; ?>

					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['droits_projets']; ?>
 :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="projects_manage" id="droit2" value="" <?php if (! in_array ( 'projects_manage_all' , $this->_tpl_vars['user_form']['tabDroits'] ) && ! in_array ( 'projects_manage_own' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_aucunDroitProjets']; ?>

					</label>
					<label class="radio inline">
						<input type="radio" name="projects_manage" id="projects_manage_all" value="projects_manage_all" <?php if (in_array ( 'projects_manage_all' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_gererTousProjets']; ?>

					</label>
					<label class="radio inline">
						<input type="radio" name="projects_manage" id="projects_manage_own" value="projects_manage_own" <?php if (in_array ( 'projects_manage_own' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_uniquementProjProprio']; ?>

					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['droits_groupesProjets']; ?>
 :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="projectgroups_manage" id="droit3" value="" <?php if (! in_array ( 'projectgroups_manage_all' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_groupesProjetsAucun']; ?>

					</label>
					<label class="radio inline">
						<input type="radio" name="projectgroups_manage" id="projectgroups_manage_all" value="projectgroups_manage_all" <?php if (in_array ( 'projectgroups_manage_all' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_gererTousGroupes']; ?>

					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['droits_modifPlanning']; ?>
 :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="planning_modif" id="tasks_readonly" value="tasks_readonly" <?php if (in_array ( 'tasks_readonly' , $this->_tpl_vars['user_form']['tabDroits'] ) || ( ! in_array ( 'tasks_modify_all' , $this->_tpl_vars['user_form']['tabDroits'] ) && ! in_array ( 'tasks_modify_own_project' , $this->_tpl_vars['user_form']['tabDroits'] ) && ! in_array ( 'tasks_modify_own_task' , $this->_tpl_vars['user_form']['tabDroits'] ) )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_planningLectureSeule']; ?>

					</label>
					<label class="radio inline">
						<input type="radio" name="planning_modif" id="tasks_modify_all" value="tasks_modify_all" <?php if (in_array ( 'tasks_modify_all' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_planningTousProjets']; ?>

					</label>
					<label class="radio inline">
						<input type="radio" name="planning_modif" id="tasks_modify_own_project" value="tasks_modify_own_project" <?php if (in_array ( 'tasks_modify_own_project' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_planningProjetsProprio']; ?>

					</label>
				</div>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="planning_modif" id="tasks_modify_own_task" value="tasks_modify_own_task" <?php if (in_array ( 'tasks_modify_own_task' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_planningTachesAssignees']; ?>

					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['droits_vuePlanning']; ?>
 :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="planning_view" id="tasks_view_all_projects" value="tasks_view_all_projects" <?php if (in_array ( 'tasks_view_all_projects' , $this->_tpl_vars['user_form']['tabDroits'] ) || ! in_array ( 'tasks_view_own_projects' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_vueTousProjets']; ?>

					</label>
					<label class="radio inline">
						<input type="radio" name="planning_view" id="tasks_view_team_projects" value="tasks_view_team_projects" <?php if (in_array ( 'tasks_view_team_projects' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_vueProjetsEquipe']; ?>

					</label>
				</div>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="planning_view" id="tasks_view_own_projects" value="tasks_view_own_projects" <?php if (in_array ( 'tasks_view_own_projects' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_vueProjetsAssignes']; ?>

					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="control-group">
				<label class="control-label"><?php echo $this->_config[0]['vars']['droits_parametres']; ?>
 :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="parameters" id="droit5" value="" <?php if (! in_array ( 'parameters_modify' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_aucunParametres']; ?>

					</label>
					<label class="radio inline">
						<input type="radio" name="parameters" id="parameters_modify" value="parameters_all" <?php if (in_array ( 'parameters_all' , $this->_tpl_vars['user_form']['tabDroits'] )): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['droits_parametresAcces']; ?>

					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<input type="button" class="btn btn-primary" style="margin-left: 180px;" value="<?php echo $this->_config[0]['vars']['submit']; ?>
" onClick="xajax_submitFormUser($('user_id').value, $('user_id_origine').value, $('user_groupe_id').value, $('nom').value, $('email_user').value, $('login_tmp').value, $('password_tmp').value, $('visible_planningOui').checked, $('couleur').value, $('notificationsOui').checked, $('envoiMailPwd').checked, new Array(getRadioValue('users_manage'), getRadioValue('projects_manage'), getRadioValue('projectgroups_manage'), getRadioValue('planning_modif'), getRadioValue('planning_view'), getRadioValue('parameters')));" />
		</div>
	</div>
</div>