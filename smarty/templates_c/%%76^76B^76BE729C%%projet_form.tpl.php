<?php /* Smarty version 2.6.26, created on 2014-07-21 15:17:14
         compiled from projet_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'projet_form.tpl', 34, false),array('modifier', 'sqldate2userdate', 'projet_form.tpl', 50, false),array('modifier', 'explode', 'projet_form.tpl', 58, false),array('modifier', 'cat', 'projet_form.tpl', 59, false),)), $this); ?>
<form class="form-horizontal" method="POST" action="process/projet.php" onsubmit="return JSformProjet();">
	<input type="hidden" name="saved" value="<?php echo $this->_tpl_vars['projet']['saved']; ?>
" />
	<input type="hidden" name="old_projet_id" value="<?php echo $this->_tpl_vars['projet']['projet_id']; ?>
" />
	<input type="hidden" name="origine" value="<?php echo $this->_tpl_vars['origine']; ?>
" />
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['winProjet_identifiant']; ?>
 :</label>
		<div class="controls">
			<input name="projet_id" id="projet_id" type="text" size="10" maxlength="10" value="<?php echo $this->_tpl_vars['projet']['projet_id']; ?>
" onChange="xajax_checkProjetId(this.value, '<?php echo $this->_tpl_vars['projet']['projet_id']; ?>
');" /> <?php echo $this->_config[0]['vars']['winProjet_identifiantCarMax']; ?>

			<span id="divStatutCheckProjetId"></span>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['winProjet_nomProjet']; ?>
 :</label>
		<div class="controls">
			<input name="nom" id="nom" type="text" size="30" maxlength="30" value="<?php echo $this->_tpl_vars['projet']['nom']; ?>
" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['winProjet_groupe']; ?>
 :</label>
		<div class="controls">
			<select name="groupe_id" id="groupe_id">
				<option value="" <?php if ($this->_tpl_vars['projet']['groupe_id'] == ""): ?>selected="selected"<?php endif; ?>>- - - - - - - - - - - - - - - -</option>
				<?php $_from = $this->_tpl_vars['groupes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['groupe']):
?>
					<option value="<?php echo $this->_tpl_vars['groupe']['groupe_id']; ?>
" <?php if ($this->_tpl_vars['projet']['groupe_id'] == $this->_tpl_vars['groupe']['groupe_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['groupe']['nom']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['winProjet_statut']; ?>
 :</label>
		<div class="controls">
			<select name="statut">
				<option value="a_faire" <?php if ($this->_tpl_vars['projet']['statut'] == 'a_faire'): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_config[0]['vars']['winProjet_statutAFaire'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</option>
				<option value="en_cours" <?php if ($this->_tpl_vars['projet']['statut'] == 'en_cours'): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_config[0]['vars']['winProjet_statutEnCours'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</option>
				<option value="fait" <?php if ($this->_tpl_vars['projet']['statut'] == 'fait'): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_config[0]['vars']['winProjet_statutFait'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</option>
				<option value="abandon" <?php if ($this->_tpl_vars['projet']['statut'] == 'abandon'): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_config[0]['vars']['winProjet_statutAbandon'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</option>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['winProjet_charge']; ?>
 :</label>
		<div class="controls">
			<input name="charge" id="charge" type="text" size="5" maxlength="5" value="<?php echo $this->_tpl_vars['projet']['charge']; ?>
" style="width:30px;" /> <?php echo $this->_config[0]['vars']['winProjet_chargeJours']; ?>

		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['winProjet_livraison']; ?>
 :</label>
		<div class="controls">
			<input type="text" class="datepicker" name="livraison" id="livraison" size="11" maxlength="10" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['projet']['livraison'])) ? $this->_run_mod_handler('sqldate2userdate', true, $_tmp) : sqldate2userdate($_tmp)); ?>
" style="width:70px;" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['winProjet_couleur']; ?>
 :</label>
		<div class="controls">
			<?php if (@CONFIG_PROJECT_COLORS_POSSIBLE != ""): ?>
				<select name="couleur">
					<?php $_from = ((is_array($_tmp=",")) ? $this->_run_mod_handler('explode', true, $_tmp, @CONFIG_PROJECT_COLORS_POSSIBLE) : explode($_tmp, @CONFIG_PROJECT_COLORS_POSSIBLE)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['couleurTmp']):
?>
						<option value="<?php echo $this->_tpl_vars['couleurTmp']; ?>
" style="background-color:<?php echo $this->_tpl_vars['couleurTmp']; ?>
" <?php if ($this->_tpl_vars['couleurTmp'] == ((is_array($_tmp="#")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['projet']['couleur']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['projet']['couleur']))): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['couleurTmp']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
				<span style="width:50px;background-color:<?php echo $this->_tpl_vars['projet']['couleur']; ?>
">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			<?php else: ?>
				<input name="couleur" id="couleur" size="7" maxlength="6" type="text" value="<?php if ($this->_tpl_vars['projet']['couleur'] == ''): ?>ffffff<?php else: ?><?php echo $this->_tpl_vars['projet']['couleur']; ?>
<?php endif; ?>" onChange="$S('colorbox').background='#'+this.value;" /> <?php echo $this->_config[0]['vars']['winProjet_couleurMaxCar']; ?>

			<?php endif; ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['winProjet_createur']; ?>
 :</label>
		<div class="controls">
			<?php if (in_array ( 'projects_manage_all' , $this->_tpl_vars['user']['tabDroits'] )): ?>
				<select name="createur_id">
					<?php $_from = $this->_tpl_vars['usersOwner']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['owner']):
?>
						<option value="<?php echo $this->_tpl_vars['owner']['user_id']; ?>
" <?php if ($this->_tpl_vars['createur']['user_id'] == $this->_tpl_vars['owner']['user_id'] || ( $this->_tpl_vars['createur']['user_id'] == "" && $this->_tpl_vars['owner']['user_id'] == $this->_tpl_vars['user']['user_id'] )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['owner']['nom']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			<?php else: ?>
				<?php echo $this->_tpl_vars['createur']['nom']; ?>

				<input type="hidden" name="createur_id" value="<?php echo $this->_tpl_vars['createur']['user_id']; ?>
">
			<?php endif; ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['winProjet_commentaires']; ?>
 :</label>
		<div class="controls">
			<input name="iteration" size="30" maxlength="255" type="text" value="<?php echo $this->_tpl_vars['projet']['iteration']; ?>
" /> <?php echo $this->_config[0]['vars']['winProjet_commentairesFacultatif']; ?>

		</div>
	</div>
	<input type="submit" value="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['winProjet_valider'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="btn btn-primary" style="margin-left: 180px;" />
</form>