<?php /* Smarty version 2.6.26, created on 2014-07-20 22:08:42
         compiled from periode_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'sqldate2userdate', 'periode_form.tpl', 68, false),array('modifier', 'sprintf', 'periode_form.tpl', 98, false),array('modifier', 'escape', 'periode_form.tpl', 107, false),array('modifier', 'sqltime2usertime', 'periode_form.tpl', 108, false),array('modifier', 'usertime2sqltime', 'periode_form.tpl', 108, false),array('modifier', 'strpos', 'periode_form.tpl', 190, false),)), $this); ?>
<form class="form-horizontal" method="POST" action="" target="_blank">
	<input type="hidden" id="periode_id" name="periode_id" value="<?php echo $this->_tpl_vars['periode']['periode_id']; ?>
" />
	<input type="hidden" id="saved" name="saved" value="<?php echo $this->_tpl_vars['periode']['saved']; ?>
" />
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="control-group span6">
				<label class="control-label"><?php echo $this->_config[0]['vars']['winPeriode_projet']; ?>
 :</label>
				<div class="controls">
					<select name="projet_id" id="projet_id" class="input-large" tabindex="1">
						<option></option>
						<?php $_from = $this->_tpl_vars['listeProjets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['projet']):
?>
							<option value="<?php echo $this->_tpl_vars['projet']['projet_id']; ?>
" <?php if ($this->_tpl_vars['periode']['projet_id'] == $this->_tpl_vars['projet']['projet_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['projet']['nom']; ?>
 (<?php echo $this->_tpl_vars['projet']['projet_id']; ?>
) <?php if ($this->_tpl_vars['projet']['livraison'] != ''): ?> - S<?php echo $this->_tpl_vars['projet']['livraison']; ?>
<?php endif; ?></option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</div>
			</div>
			<div class="control-group span6">
				<label class="control-label" style="width: 70px;"><?php echo $this->_config[0]['vars']['winPeriode_user']; ?>
 :</label>
				<div class="controls" style="margin-left: 90px;">
					<select name="user_id" id="user_id" class="input-large select2" tabindex="2">
						<?php $_from = $this->_tpl_vars['listeUsers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userTmp']):
?>
							<option value="<?php echo $this->_tpl_vars['userTmp']['user_id']; ?>
" <?php if ($this->_tpl_vars['periode']['user_id'] == $this->_tpl_vars['userTmp']['user_id']): ?>selected="selected"<?php endif; ?> <?php if (isset ( $this->_tpl_vars['user_id_choisi'] ) && $this->_tpl_vars['user_id_choisi'] == $this->_tpl_vars['userTmp']['user_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['userTmp']['nom']; ?>
 - <?php echo $this->_tpl_vars['userTmp']['user_id']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</div>
			</div>
		</div>
		<?php if (isset ( $this->_tpl_vars['estFilleOuParente'] )): ?>
			<div class="row-fluid">
				<div class="control-group span12">
					<label class="control-label"></label>
					<div class="controls">
						<label class="checkbox inline"><input type="checkbox" checked="checked" id="appliquerATous" value="1">	<?php echo $this->_config[0]['vars']['winPeriode_appliquerATous']; ?>
</label>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="row-fluid">
			<div class="control-group span6">
				<label class="control-label"><?php echo $this->_config[0]['vars']['winPeriode_user3']; ?>
 :</label>
				<div class="controls">
					<select name="user_id3" id="user_id3" class="input-large select2">
						<option></option>
						<?php $_from = $this->_tpl_vars['listeUsers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userTmp']):
?>
							<option value="<?php echo $this->_tpl_vars['userTmp']['user_id']; ?>
"><?php echo $this->_tpl_vars['userTmp']['nom']; ?>
 - <?php echo $this->_tpl_vars['userTmp']['user_id']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</div>
			</div>
			<div class="control-group span6">
				<label class="control-label" style="width: 70px;"><?php echo $this->_config[0]['vars']['winPeriode_user2']; ?>
 :</label>
				<div class="controls" style="margin-left: 90px;">
					<select name="user_id2" id="user_id2" class="input-large select2">
						<option></option>
						<?php $_from = $this->_tpl_vars['listeUsers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userTmp']):
?>
							<option value="<?php echo $this->_tpl_vars['userTmp']['user_id']; ?>
"><?php echo $this->_tpl_vars['userTmp']['nom']; ?>
 - <?php echo $this->_tpl_vars['userTmp']['user_id']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</div>
			</div>
		</div>
		<hr />
		<div class="row-fluid">
			<div class="control-group span12">
				<label class="control-label"><?php echo $this->_config[0]['vars']['winPeriode_debut']; ?>
 :</label>
				<div class="controls">
					<input type="text" name="date_debut" id="date_debut" size="11" maxlength="10" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['periode']['date_debut'])) ? $this->_run_mod_handler('sqldate2userdate', true, $_tmp) : sqldate2userdate($_tmp)); ?>
" style="width:80px" class="datepicker" tabindex="4" />
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="control-group span7">
				<label class="control-label"><?php echo $this->_config[0]['vars']['winPeriode_fin']; ?>
 :</label>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="radioChoixFin" id="radioChoixFinDate" value="" <?php if ($this->_tpl_vars['periode']['duree_details'] == ""): ?>checked="checked"<?php endif; ?> onChange="$('divFinChoixDate').style.display='block';$('divFinChoixDuree').style.display='none';" tabindex="5" />&nbsp;<?php echo $this->_config[0]['vars']['winPeriode_finChoixDate']; ?>

					</label>
					<label class="radio inline">
						<input type="radio" name="radioChoixFin" id="radioChoixFinDuree" value="" <?php if ($this->_tpl_vars['periode']['duree_details'] != ""): ?>checked="checked"<?php endif; ?> onChange="$('divFinChoixDuree').style.display='block';$('divFinChoixDate').style.display='none';" tabindex="6" />&nbsp;<?php echo $this->_config[0]['vars']['winPeriode_finChoixDuree']; ?>

					</label>
				</div>
			</div>
		</div>
		<div class="row-fluid">
						<div class="control-group span12" id="divFinChoixDate" <?php if ($this->_tpl_vars['periode']['duree_details'] != ""): ?>style="display:none;"<?php endif; ?>>
				<div class="controls">
					<input type="text" name="date_fin" id="date_fin" size="11" maxlength="10" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['periode']['date_fin'])) ? $this->_run_mod_handler('sqldate2userdate', true, $_tmp) : sqldate2userdate($_tmp)); ?>
" onFocus="remplirDateFinPeriode();videChampsFinTache(this.id);" style="width:80px" class="datepicker" onChange="videChampsFinTache(this.id);"  tabindex="7" />
					<?php if ($this->_tpl_vars['periode']['periode_id'] == 0): ?>
						&nbsp;<?php echo $this->_config[0]['vars']['winPeriode_ouNBJours']; ?>
 :
						<input type="text" name="nb_jours" id="nb_jours" size="1" maxlength="2" style="width:30px" onChange="videChampsFinTache(this.id);" tabindex="10" />
						<input type="hidden" id="conserver_duree" value="" />
					<?php else: ?>
						<input type="hidden" id="nb_jours" value="" />
					<?php endif; ?>
					<?php if ($this->_tpl_vars['periode']['periode_id'] != 0 && $this->_tpl_vars['periode']['date_fin'] != ""): ?>
						<label class="checkbox inline" style="padding-top: 0px;"><input type="checkbox" id="conserver_duree" name="conserver_duree" value="1" onClick="toggle2('bloc_date_fin');" tabindex="11" /><?php echo ((is_array($_tmp=$this->_config[0]['vars']['winPeriode_conserverDuree'])) ? $this->_run_mod_handler('sprintf', true, $_tmp, $this->_tpl_vars['nbJours']) : sprintf($_tmp, $this->_tpl_vars['nbJours'])); ?>
</label>
					<?php else: ?>
						<input type="hidden" id="conserver_duree" value="" />
					<?php endif; ?>
				</div>
			</div>
						<div class="control-group span12" id="divFinChoixDuree" <?php if ($this->_tpl_vars['periode']['duree_details'] == ''): ?>style="display:none;"<?php endif; ?>>
				<div class="controls">
					<?php echo $this->_config[0]['vars']['winPeriode_ouNBHeures']; ?>
 <a onmouseover="return coolTip('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['winPeriode_FormatDuree'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', WIDTH, 200)"  onmouseout="nd()" href="javascript:unedfined;"><i class="icon-question-sign"></i></a> :
					<input type="text" name="duree" id="duree" size="3" maxlength="5" value="<?php if ($this->_tpl_vars['periode']['duree_details'] == 'duree'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['periode']['duree'])) ? $this->_run_mod_handler('sqltime2usertime', true, $_tmp) : sqltime2usertime($_tmp)); ?>
<?php endif; ?>" style="width:36px" onFocus="if(this.value == '')this.value='<?php echo ((is_array($_tmp=@CONFIG_DURATION_DAY)) ? $this->_run_mod_handler('usertime2sqltime', true, $_tmp, 'short') : usertime2sqltime($_tmp, 'short')); ?>
';" onChange="videChampsFinTache(this.id);" tabindex="12" />
					<?php echo $this->_config[0]['vars']['winPeriode_heureDebut']; ?>
 <a onmouseover="return coolTip('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['winPeriode_FormatDuree'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', WIDTH, 200)"  onmouseout="nd()" href="javascript:unedfined;"><i class="icon-question-sign"></i></a> :
					<input type="text" id="heure_debut" id="heure_debut" size="3" maxlength="5" value="<?php if (isset ( $this->_tpl_vars['periode']['duree_details_heure_debut'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['periode']['duree_details_heure_debut'])) ? $this->_run_mod_handler('sqltime2usertime', true, $_tmp) : sqltime2usertime($_tmp)); ?>
<?php endif; ?>" style="width:36px" onChange="videChampsFinTache(this.id);" tabindex="13" />
					<?php echo $this->_config[0]['vars']['winPeriode_heureFin']; ?>
 <a onmouseover="return coolTip('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['winPeriode_FormatDuree'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', WIDTH, 200)"  onmouseout="nd()" href="javascript:unedfined;"><i class="icon-question-sign"></i></a> : <input type="text" id="heure_fin" size="3" maxlength="5" value="<?php if (isset ( $this->_tpl_vars['periode']['duree_details_heure_fin'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['periode']['duree_details_heure_fin'])) ? $this->_run_mod_handler('sqltime2usertime', true, $_tmp) : sqltime2usertime($_tmp)); ?>
<?php endif; ?>" style="width:36px" onChange="videChampsFinTache(this.id);" tabindex="14" />
					<br />
					<label class="checkbox inline"><input type="checkbox" id="matin" onChange="videChampsFinTache(this.id);" <?php if ($this->_tpl_vars['periode']['duree_details'] == 'AM'): ?>checked="checked"<?php endif; ?> tabindex="15"><?php echo $this->_config[0]['vars']['winPeriode_matin']; ?>
 (<?php echo @CONFIG_DURATION_AM; ?>
<?php echo $this->_config[0]['vars']['tab_h']; ?>
)</label>
					<label class="checkbox inline"><input type="checkbox" id="apresmidi" onChange="videChampsFinTache(this.id);" <?php if ($this->_tpl_vars['periode']['duree_details'] == 'PM'): ?>checked="checked"<?php endif; ?> tabindex="16"><?php echo $this->_config[0]['vars']['winPeriode_apresmidi']; ?>
 (<?php echo @CONFIG_DURATION_PM; ?>
<?php echo $this->_config[0]['vars']['tab_h']; ?>
)</label>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<?php if ($this->_tpl_vars['periode']['periode_id'] == 0): ?>
				<div class="control-group span12">
					<input type="hidden" id="appliquerATous" value="0">
					<label class="control-label"><?php echo $this->_config[0]['vars']['winPeriode_repeter']; ?>
 :</label>
					<div class="controls">
						<select name="repetition" id="repetition" onChange="<?php echo 'if(this.value!=\'\'){$(\'divDateFinRepetition\').style.display=\'inline\';}else{$(\'divDateFinRepetition\').style.display=\'none\';}'; ?>
" class="input-large select2" tabindex="17">
							<option></option>
							<option value="jour"><?php echo $this->_config[0]['vars']['winPeriode_repeter_jour']; ?>
</option>
							<option value="semaine"><?php echo $this->_config[0]['vars']['winPeriode_repeter_semaine']; ?>
</option>
							<option value="mois"><?php echo $this->_config[0]['vars']['winPeriode_repeter_mois']; ?>
</option>
						</select>
						<span id="divDateFinRepetition" style="display:none;">
							&nbsp;&nbsp;&nbsp;
							<?php echo $this->_config[0]['vars']['winPeriode_repeter_jusque']; ?>

							<input type="text" id="dateFinRepetition" value="" size="11" maxlength="10" style="width:80px" class="datepicker" onFocus="remplirDateRepetition();" tabindex="18">
						</span>
					</div>
				</div>
			<?php elseif (isset ( $this->_tpl_vars['estFilleOuParente'] )): ?>
				<div class="control-group span12">
					<input type="hidden" id="repetition" value="">
					<input type="hidden" id="dateFinRepetition" value="">
					<label class="control-label"></label>
					<div class="controls">
						<b><?php echo $this->_config[0]['vars']['winPeriode_recurrente']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['prochaineOccurence'])) ? $this->_run_mod_handler('sqldate2userdate', true, $_tmp) : sqldate2userdate($_tmp)); ?>
</b>
					</div>
				</div>
			<?php else: ?>
				<input type="hidden" id="appliquerATous" value="0">
				<input type="hidden" id="repetition" value="">
				<input type="hidden" id="dateFinRepetition" value="">
			<?php endif; ?>
		</div>
		<hr/>
		<div class="row-fluid">
			<div class="control-group span6">
				<label class="control-label"><?php echo $this->_config[0]['vars']['winPeriode_statut']; ?>
 :</label>
				<div class="controls">
					<select name="statut_tache" id="statut_tache" class="input-large select2"  tabindex="19">
						<option value="a_faire" <?php if ($this->_tpl_vars['periode']['statut_tache'] == 'a_faire'): ?>selected="selected"<?php endif; ?>><?php echo $this->_config[0]['vars']['winPeriode_statut_a_faire']; ?>
</option>
						<option value="en_cours" <?php if ($this->_tpl_vars['periode']['statut_tache'] == 'en_cours'): ?>selected="selected"<?php endif; ?>><?php echo $this->_config[0]['vars']['winPeriode_statut_en_cours']; ?>
</option>
						<option value="fait" <?php if ($this->_tpl_vars['periode']['statut_tache'] == 'fait'): ?>selected="selected"<?php endif; ?>><?php echo $this->_config[0]['vars']['winPeriode_statut_fait']; ?>
</option>
						<option value="abandon" <?php if ($this->_tpl_vars['periode']['statut_tache'] == 'abandon'): ?>selected="selected"<?php endif; ?>><?php echo $this->_config[0]['vars']['winPeriode_statut_abandon']; ?>
</option>
					</select>
				</div>
			</div>
			<div class="control-group span6">
				<label class="control-label" style="width: 70px;"><?php echo $this->_config[0]['vars']['winPeriode_livrable']; ?>
 :</label>
				<div class="controls" style="margin-left: 90px;">
					<select name="livrable" id="livrable" class="input-large select2" tabindex="20">
						<option value="oui" <?php if ($this->_tpl_vars['periode']['livrable'] == 'oui'): ?>selected="selected"<?php endif; ?>><?php echo $this->_config[0]['vars']['oui']; ?>
</option>
						<option value="non" <?php if ($this->_tpl_vars['periode']['livrable'] == 'non'): ?>selected="selected"<?php endif; ?>><?php echo $this->_config[0]['vars']['non']; ?>
</option>
					</select>
				</div>
			</div>
		</div>
		<hr />
		<div class="row-fluid">
			<div class="control-group span12">
				<label class="control-label"><?php echo $this->_config[0]['vars']['winPeriode_titre']; ?>
 :</label>
				<div class="controls">
					<input type="text" name="titre" id="titre" size="40" maxlength="2000" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['periode']['titre'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onFocus="xajax_autocompleteTitreTache($('projet_id').value);" class="input-xxlarge" tabindex="21" />
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="control-group span12">
				<label class="control-label"><?php echo $this->_config[0]['vars']['winPeriode_lien']; ?>
 :</label>
				<div class="controls">
					<input type="text" name="lien" id="lien" size="40" maxlength="2000" value="<?php echo $this->_tpl_vars['periode']['lien']; ?>
" class="input-xxlarge"  tabindex="22" />
					<?php if ($this->_tpl_vars['periode']['lien'] != ""): ?>
						<a class="btn btn-small" type="submit" style="padding-top:4px;" id="btnGotoLien" rel="tooltip" title="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['winPeriode_gotoLien'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" href="<?php if (((is_array($_tmp=$this->_tpl_vars['periode']['lien'])) ? $this->_run_mod_handler('strpos', true, $_tmp, 'http') : strpos($_tmp, 'http')) !== 0 && ((is_array($_tmp=$this->_tpl_vars['periode']['lien'])) ? $this->_run_mod_handler('strpos', true, $_tmp, "\\") : strpos($_tmp, "\\")) !== 0): ?>http://<?php endif; ?><?php echo $this->_tpl_vars['periode']['lien']; ?>
" target="_blank"><i class="icon-share"></i></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="control-group span12">
				<label class="control-label"><?php echo $this->_config[0]['vars']['winPeriode_commentaires']; ?>
 :</label>
				<div class="controls">
					<textarea style="height:45px;" id="notes" name="notes" class="input-xxlarge" tabindex="23"><?php echo ((is_array($_tmp=$this->_tpl_vars['periode']['notes_xajax'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</textarea>
				</div>
			</div>
		</div>
	</div>

	<?php if (! in_array ( 'tasks_readonly' , $this->_tpl_vars['user']['tabDroits'] )): ?>
		<div class="btn-group pull-right" style="margin-right: 170px;">
			<input id="butSubmitPeriode" type="button" class="btn btn-primary" tabindex="24" value="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['winPeriode_valider'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" onClick="$('divPatienter').style.display='inline';this.disabled=true;xajax_submitFormPeriode('<?php echo $this->_tpl_vars['periode']['periode_id']; ?>
', $(projet_id).value, $(user_id).value, $(date_debut).value, $(conserver_duree).checked, $(date_fin).value, $(nb_jours).value, $(duree).value, $(heure_debut).value, $(heure_fin).value, $(matin).checked, $(apresmidi).checked, $(repetition).value, $(dateFinRepetition).value, $(appliquerATous).checked, $(statut_tache).value, $(livrable).value, $(titre).value, $(notes).value, $(lien).value, $(user_id2).value, $(user_id3).value);" />
			<?php if ($this->_tpl_vars['periode']['periode_id'] != 0): ?>
				<input type="button" class="btn" onClick="if(confirm('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['winPeriode_dupliquer'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
 ?'))xajax_ajoutPeriode('', '', <?php echo $this->_tpl_vars['periode']['periode_id']; ?>
);" value="<?php echo $this->_config[0]['vars']['winPeriode_dupliquer']; ?>
" />
				<input type="button" class="btn btn-warning" onClick="if(confirm('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['winPeriode_confirmSuppr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
'))xajax_supprimerPeriode(<?php echo $this->_tpl_vars['periode']['periode_id']; ?>
, false);" value="<?php echo $this->_config[0]['vars']['winPeriode_supprimer']; ?>
" />
				<?php if (isset ( $this->_tpl_vars['estFilleOuParente'] )): ?>
					<input type="button" class="btn" onClick="if(confirm('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['winPeriode_confirmSupprRepetition'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
'))xajax_supprimerPeriode(<?php echo $this->_tpl_vars['periode']['periode_id']; ?>
, true);" value="<?php echo $this->_config[0]['vars']['winPeriode_supprimer_repetition']; ?>
" />
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<span id="divPatienter" style="display:none;color:#ff0000;font-weight:bold;"><img src="assets/img/pictos/loading16.gif" width="16" height="16" border="0" /></span>
	<?php endif; ?>
</form>