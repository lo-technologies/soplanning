<?php /* Smarty version 2.6.26, created on 2014-07-20 22:08:50
         compiled from www_options.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'www_options.tpl', 37, false),array('modifier', 'cat', 'www_options.tpl', 45, false),array('modifier', 'explode', 'www_options.tpl', 59, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "www_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="container">
	<div class="row">
		<div class="span3">
			<ul class="nav nav-list soplanning-box" id="myTab">
				<li class="active">
					<a href="#global"><?php echo $this->_config[0]['vars']['options_configGenerale']; ?>
</a>
				</li>
				<li>
					<a href="#planning"><?php echo $this->_config[0]['vars']['options_planning']; ?>
</a>
				</li>
				<li>
					<a href="#divers"><?php echo $this->_config[0]['vars']['options_divers']; ?>
</a>
				</li>
				<li>
					<a href="#smtp"><?php echo $this->_config[0]['vars']['options_smtp']; ?>
</a>
				</li>
				<li>
					<a href="#testmail"><?php echo $this->_config[0]['vars']['options_envoyerMailTest']; ?>
</a>
				</li>
			</ul>
		</div>
		<div class="span9">
			<div class="soplanning-box">
				<div class="tab-content">
					<div class="tab-pane active" id="global">
						<form action="process/options.php" method="POST" class="form-horizontal formElement">
							<fieldset>
								<legend>
									<?php echo $this->_config[0]['vars']['options_configGenerale']; ?>

								</legend>
								<div class="control-group">
									<label class="control-label" for="inputEmail"><?php echo $this->_config[0]['vars']['options_titre']; ?>
 :</label>
									<div class="controls">
										<input type="text" name="SOPLANNING_TITLE" id="inputEmail" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@CONFIG_SOPLANNING_TITLE)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
">
										&nbsp;<a href="#" onmouseover="return coolTip('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['options_aide_titre'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputEmail"><?php echo $this->_config[0]['vars']['options_url']; ?>
 :</label>
									<div class="controls">
										<input type="text" name="SOPLANNING_URL" id="inputEmail" value="<?php echo @CONFIG_SOPLANNING_URL; ?>
">
										&nbsp;<a href="#" onmouseover="return coolTip('<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_config[0]['vars']['options_aide_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')))) ? $this->_run_mod_handler('cat', true, $_tmp, '<br>') : smarty_modifier_cat($_tmp, '<br>')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['urlSuggeree']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['urlSuggeree'])); ?>
', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<input type="submit" class="btn btn-primary" value="<?php echo $this->_config[0]['vars']['submit']; ?>
" style="margin-left: 392px;"/>
							</fieldset>
						</form>
					</div>
					<div class="tab-pane" id="planning">
						<form action="process/options.php" method="POST" class="form-horizontal formElement">
							<fieldset>
								<legend>
									<?php echo $this->_config[0]['vars']['options_planning']; ?>

								</legend>
								<div class="control-group">
									<label class="control-label" for="inputEmail"><?php $this->assign('jours', ((is_array($_tmp=",")) ? $this->_run_mod_handler('explode', true, $_tmp, @CONFIG_DAYS_INCLUDED) : explode($_tmp, @CONFIG_DAYS_INCLUDED))); ?> <?php echo $this->_config[0]['vars']['options_joursInclus']; ?>
 :</label>
									<div class="controls">
										<label class="checkbox inline">
											<input type="checkbox" name="DAYS_INCLUDED[]" value="1" id="chklundi" <?php if (in_array ( '1' , $this->_tpl_vars['jours'] )): ?>checked="checked"<?php endif; ?>> <?php echo $this->_config[0]['vars']['day_1']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="DAYS_INCLUDED[]" value="2" id="chkmardi" <?php if (in_array ( '2' , $this->_tpl_vars['jours'] )): ?>checked="checked"<?php endif; ?>> <?php echo $this->_config[0]['vars']['day_2']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="DAYS_INCLUDED[]" value="3" id="chkmercredi" <?php if (in_array ( '3' , $this->_tpl_vars['jours'] )): ?>checked="checked"<?php endif; ?>> <?php echo $this->_config[0]['vars']['day_3']; ?>

										</label>
									</div>
									<div class="controls">
										<label class="checkbox inline">
											<input type="checkbox" name="DAYS_INCLUDED[]" value="4" id="chkjeudi" <?php if (in_array ( '4' , $this->_tpl_vars['jours'] )): ?>checked="checked"<?php endif; ?>> <?php echo $this->_config[0]['vars']['day_4']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="DAYS_INCLUDED[]" value="5" id="chkvendredi" <?php if (in_array ( '5' , $this->_tpl_vars['jours'] )): ?>checked="checked"<?php endif; ?>> <?php echo $this->_config[0]['vars']['day_5']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="DAYS_INCLUDED[]" value="6" id="chksamedi" <?php if (in_array ( '6' , $this->_tpl_vars['jours'] )): ?>checked="checked"<?php endif; ?>> <?php echo $this->_config[0]['vars']['day_6']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="DAYS_INCLUDED[]" value="0" id="chkdimanche" <?php if (in_array ( '0' , $this->_tpl_vars['jours'] )): ?>checked="checked"<?php endif; ?>> <?php echo $this->_config[0]['vars']['day_0']; ?>

										</label>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputEmail"><?php $this->assign('heuresAffichees', ((is_array($_tmp=",")) ? $this->_run_mod_handler('explode', true, $_tmp, @CONFIG_HOURS_DISPLAYED) : explode($_tmp, @CONFIG_HOURS_DISPLAYED))); ?> <?php echo $this->_config[0]['vars']['options_heuresIncluses']; ?>
 :</label>
									<div class="controls">
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="0" <?php if (in_array ( '0' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 0<?php echo $this->_config[0]['vars']['tab_h']; ?>
-1<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="1" <?php if (in_array ( '1' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 1<?php echo $this->_config[0]['vars']['tab_h']; ?>
-2<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="2" <?php if (in_array ( '2' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 2<?php echo $this->_config[0]['vars']['tab_h']; ?>
-3<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="3" <?php if (in_array ( '3' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 3<?php echo $this->_config[0]['vars']['tab_h']; ?>
-4<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="4" <?php if (in_array ( '4' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 4<?php echo $this->_config[0]['vars']['tab_h']; ?>
-5<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="5" <?php if (in_array ( '5' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 5<?php echo $this->_config[0]['vars']['tab_h']; ?>
-6<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="6" <?php if (in_array ( '6' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 6<?php echo $this->_config[0]['vars']['tab_h']; ?>
-7<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
									</div>
									<div class="controls">
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="7" <?php if (in_array ( '7' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 7<?php echo $this->_config[0]['vars']['tab_h']; ?>
-8<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="8" <?php if (in_array ( '8' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 8<?php echo $this->_config[0]['vars']['tab_h']; ?>
-9<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="9" <?php if (in_array ( '9' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 9<?php echo $this->_config[0]['vars']['tab_h']; ?>
-10<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="10" <?php if (in_array ( '10' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 10<?php echo $this->_config[0]['vars']['tab_h']; ?>
-11<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="11" <?php if (in_array ( '11' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 11<?php echo $this->_config[0]['vars']['tab_h']; ?>
-12<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="12" <?php if (in_array ( '12' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 12<?php echo $this->_config[0]['vars']['tab_h']; ?>
-13<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
									</div>
									<div class="controls">
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="13" <?php if (in_array ( '13' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 13<?php echo $this->_config[0]['vars']['tab_h']; ?>
-14<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="14" <?php if (in_array ( '14' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 14<?php echo $this->_config[0]['vars']['tab_h']; ?>
-15<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="15" <?php if (in_array ( '15' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 15<?php echo $this->_config[0]['vars']['tab_h']; ?>
-16<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="16" <?php if (in_array ( '16' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 16<?php echo $this->_config[0]['vars']['tab_h']; ?>
-17<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="17" <?php if (in_array ( '17' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 17<?php echo $this->_config[0]['vars']['tab_h']; ?>
-18<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="18" <?php if (in_array ( '18' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 18<?php echo $this->_config[0]['vars']['tab_h']; ?>
-19<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
									</div>
									<div class="controls">
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="19" <?php if (in_array ( '19' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 19<?php echo $this->_config[0]['vars']['tab_h']; ?>
-20<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="20" <?php if (in_array ( '20' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 20<?php echo $this->_config[0]['vars']['tab_h']; ?>
-21<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="21" <?php if (in_array ( '21' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 21<?php echo $this->_config[0]['vars']['tab_h']; ?>
-22<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="22" <?php if (in_array ( '22' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 22<?php echo $this->_config[0]['vars']['tab_h']; ?>
-23<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="23" <?php if (in_array ( '23' , $this->_tpl_vars['heuresAffichees'] )): ?>checked="checked"<?php endif; ?>> 23<?php echo $this->_config[0]['vars']['tab_h']; ?>
-0<?php echo $this->_config[0]['vars']['tab_h']; ?>

										</label>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_dureeDefautJour']; ?>
 :</label>
									<div class="controls">
										<input name="DURATION_DAY" type="text" value="<?php echo @CONFIG_DURATION_DAY; ?>
" class="input-mini" />
										&nbsp;<a href="#" onmouseover="return coolTip('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['options_aide_dureeDefaut'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
										<?php echo $this->_config[0]['vars']['options_dureeDefautMatin']; ?>
 :
										<input name="DURATION_AM" type="text" value="<?php echo @CONFIG_DURATION_AM; ?>
" class="input-mini" />
										&nbsp;<a href="#" onmouseover="return coolTip('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['options_aide_dureeDefaut'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
										<?php echo $this->_config[0]['vars']['options_dureeDefautApresmidi']; ?>
 :
										<input name="DURATION_PM" type="text" value="<?php echo @CONFIG_DURATION_PM; ?>
" class="input-mini" />
										&nbsp;<a href="#" onmouseover="return coolTip('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['options_aide_dureeDefaut'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_nbMoisDefaut']; ?>
 :</label>
									<div class="controls">
										<input name="DEFAULT_NB_MONTHS_DISPLAYED" type="text" value="<?php echo @CONFIG_DEFAULT_NB_MONTHS_DISPLAYED; ?>
" class="input-mini" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_nbjoursDefaut']; ?>
 :</label>
									<div class="controls">
										<input name="DEFAULT_NB_DAYS_DISPLAYED" type="text" value="<?php echo @CONFIG_DEFAULT_NB_DAYS_DISPLAYED; ?>
" class="input-mini" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_nbLignes']; ?>
 :</label>
									<div class="controls">
										<input name="DEFAULT_NB_ROWS_DISPLAYED" type="text" value="<?php echo @CONFIG_DEFAULT_NB_ROWS_DISPLAYED; ?>
" class="input-mini" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_nbJoursPasses']; ?>
 :</label>
									<div class="controls">
										<input name="DEFAULT_NB_PAST_DAYS" type="text" value="<?php echo @CONFIG_DEFAULT_NB_PAST_DAYS; ?>
" class="input-mini" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_raffraichissement']; ?>
 :</label>
									<div class="controls">
										<input name="REFRESH_TIMER" type="text" value="<?php echo @CONFIG_REFRESH_TIMER; ?>
" class="input-mini" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_hauteurLigne']; ?>
 :</label>
									<div class="controls">
										<input name="PLANNING_LINE_HEIGHT" type="text" value="<?php echo @CONFIG_PLANNING_LINE_HEIGHT; ?>
" class="input-mini" />
										&nbsp;<a href="#" onmouseover="return coolTip('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['options_aide_hauteurLigne'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_uneTacheParJour']; ?>
 :</label>
									<div class="controls">
										<select name="PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY" class="input-mini">
											<option value="0" <?php if (@CONFIG_PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY == 0): ?>selected="selected"<?php endif; ?>><?php echo $this->_config[0]['vars']['non']; ?>
</option>
											<option value="1" <?php if (@CONFIG_PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY == 1): ?>selected="selected"<?php endif; ?>><?php echo $this->_config[0]['vars']['oui']; ?>
</option>
										</select>
										&nbsp;<a href="#" onmouseover="return coolTip('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['options_aide_uneTacheParJour'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_repeterHeaderDate']; ?>
 :</label>
									<div class="controls">
										<input name="PLANNING_REPEAT_HEADER" type="text" value="<?php echo @CONFIG_PLANNING_REPEAT_HEADER; ?>
" class="input-mini" />
										&nbsp;<a href="#" onmouseover="return coolTip('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['options_aide_repeterHeaderDate'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<input type="submit" class="btn btn-primary" value="<?php echo $this->_config[0]['vars']['submit']; ?>
" style="margin-left: 392px;"/>
							</fieldset>
						</form>
					</div>
					<div class="tab-pane" id="divers">
						<form action="process/options.php" method="POST" class="form-horizontal formElement">
							<fieldset>
								<legend>
									<?php echo $this->_config[0]['vars']['options_divers']; ?>

								</legend>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_couleursProjets']; ?>
 :</label>
									<div class="controls">
										<input name="PROJECT_COLORS_POSSIBLE" type="text" value="<?php echo @CONFIG_PROJECT_COLORS_POSSIBLE; ?>
" class="input-large" />
										&nbsp;<a href="#" onmouseover="return coolTip('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['options_aide_couleursPossibles'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_lienDefaut']; ?>
 :</label>
									<div class="controls">
										<input name="DEFAULT_PERIOD_LINK" type="text" value="<?php echo @CONFIG_DEFAULT_PERIOD_LINK; ?>
" class="input-large" />
										&nbsp;<a href="#" onmouseover="return coolTip('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['options_aide_LinkPeriod'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_urlRedirection']; ?>
 :</label>
									<div class="controls">
										<input name="LOGOUT_REDIRECT" type="text" value="<?php echo @CONFIG_LOGOUT_REDIRECT; ?>
" class="input-large" />
										&nbsp;<a href="#" onmouseover="return coolTip('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['options_aide_redirect'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<input type="submit" class="btn btn-primary" value="<?php echo $this->_config[0]['vars']['submit']; ?>
" style="margin-left: 392px;"/>
							</fieldset>
						</form>
					</div>
					<div class="tab-pane" id="smtp">
						<form action="process/options.php" method="POST" class="form-horizontal formElement">
							<fieldset>
								<legend>
									<?php echo $this->_config[0]['vars']['options_smtp']; ?>

								</legend>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_smtp_host']; ?>
 :</label>
									<div class="controls">
										<input name="SMTP_HOST" type="text" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@CONFIG_SMTP_HOST)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" class="input-large" />
										<?php echo $this->_config[0]['vars']['options_smtp_port']; ?>
 :
										<input name="SMTP_PORT" type="text" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@CONFIG_SMTP_PORT)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" class="input-mini" />
										&nbsp;<a href="#" onmouseover="return coolTip('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['options_aide_smtp'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_smtp_secure']; ?>
</label>
									<div class="controls">
										<select id="" name="SMTP_SECURE" class="input-large">
											<option value="" <?php if (@CONFIG_SMTP_SECURE == ""): ?>selected="selected"<?php endif; ?>><?php echo $this->_config[0]['vars']['options_smtp_nonSecurise']; ?>
</option>
											<option value="ssl" <?php if (@CONFIG_SMTP_SECURE == 'ssl'): ?>selected="selected"<?php endif; ?>>SSL</option>
											<option value="tls" <?php if (@CONFIG_SMTP_SECURE == 'tls'): ?>selected="selected"<?php endif; ?>>TLS</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_smtp_from']; ?>
 :</label>
									<div class="controls">
										<input name="SMTP_FROM" type="text" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@CONFIG_SMTP_FROM)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" class="input-large" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_smtp_login']; ?>
 :</label>
									<div class="controls">
										<input name="SMTP_LOGIN" type="text" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@CONFIG_SMTP_LOGIN)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" class="input-large" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_smtp_password']; ?>
 :</label>
									<div class="controls">
										<input name="SMTP_PASSWORD" type="password" size="30" value="<?php if (@CONFIG_SMTP_LOGIN != ""): ?>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<?php endif; ?>" class="input-large"/>
									</div>
								</div>
								<input type="submit" class="btn btn-primary" value="<?php echo $this->_config[0]['vars']['submit']; ?>
" style="margin-left: 392px;"/>
							</fieldset>
						</form>
					</div>
					<div class="tab-pane" id="testmail">
						<form action="process/options.php" method="POST" class="form-horizontal formElement">
							<fieldset>
								<legend>
									<?php echo $this->_config[0]['vars']['options_envoyerMailTest']; ?>

								</legend>
								<div class="control-group">
									<label class="control-label"><?php echo $this->_config[0]['vars']['options_envoyerMailTest_destinataire']; ?>
 :</label>
									<div class="controls">
										<input name="mailTestDestinataire" type="text" class="input-xlarge" />
									</div>
								</div>
								<input type="submit" class="btn btn-primary" value="<?php echo $this->_config[0]['vars']['submit']; ?>
" style="margin-left: 392px;" <?php if (@CONFIG_SMTP_HOST == '' || @CONFIG_SMTP_PORT == '' || @CONFIG_SMTP_FROM == ''): ?>disabled="disabled"<?php endif; ?>/>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
<?php echo '
	jQuery(document).ready(function(){
		jQuery("a[data-toggle=popover]")
			.popover()
			.click(function(e) {
		  	e.preventDefault()
		});
	});

	jQuery(\'#myTab a\').click(function (e) {
		e.preventDefault();
		jQuery(this).tab(\'show\');
	})
'; ?>

</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "www_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>