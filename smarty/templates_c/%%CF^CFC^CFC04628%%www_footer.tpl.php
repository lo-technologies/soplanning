<?php /* Smarty version 2.6.26, created on 2014-07-20 22:01:06
         compiled from www_footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'www_footer.tpl', 61, false),)), $this); ?>
				<div class="navbar navbar-fixed-bottom footer">
			<div class="navbar-inner">
				<div class="container text-center">
					<p class="text-info">
						<a target="_blank" href="http://www.soplanning.org">www.soplanning.org</a>
						<span class="noprint">&nbsp;-&nbsp;</span>
						<a href="mailto:support@soplanning.org" class="noprint">Support</a>
						<span class="noprint">&nbsp;-&nbsp;</span>
						<a target="_blank" href="http://www.soplanning.org/en/donate.php" class="noprint">Donate</a>
						<span class="noprint">&nbsp;-&nbsp;</span>
						<a href="#divFormSupport" role="button" data-toggle="modal" class="noprint"><?php echo $this->_config[0]['vars']['formContact_titre']; ?>
</a>
					</p>
				</div>
			</div>
		</div>

		<div id="pwdReminderModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3><?php echo $this->_config[0]['vars']['rappelPwdTitre']; ?>
</h3>
			</div>
			<div class="modal-body">
				<input type="text" id="rappel_pwd" placeholder="<?php echo $this->_config[0]['vars']['rappelPwdVotreEmail']; ?>
" class="input-xlarge">
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" id="changePwd"><?php echo $this->_config[0]['vars']['submit']; ?>
</button>
			</div>
		</div>

		<div class="modal hide" id="divFormSupport" tabindex="-1">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3><?php echo $this->_config[0]['vars']['formContact_titre']; ?>
</h3>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<input type="hidden" id="form_contact_version" value="<?php echo $this->_tpl_vars['infoVersion']; ?>
" style="width:100px">
					<div class="control-group">
						<label class="control-label"><?php echo $this->_config[0]['vars']['formContact_email']; ?>
 :</label>
						<div class="controls">
							<input type="text" id="form_contact_email" value="<?php if (isset ( $this->_tpl_vars['user'] ) && $this->_tpl_vars['user']['email'] != ''): ?><?php echo $this->_tpl_vars['user']['email']; ?>
<?php endif; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><?php echo $this->_config[0]['vars']['formContact_commentaire']; ?>
 :</label>
						<div class="controls">
							<textarea id="form_contact_commentaire" style="width:300px;height:60px;"></textarea>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<label class="checkbox inline">
								<input type="checkbox" id="form_contact_abo" value="1" checked="checked">&nbsp;<?php echo $this->_config[0]['vars']['formContact_newsletter']; ?>

							</label>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"></label>
						<div class="controls">
							<input type="button" class="btn btn-primary" onClick="if(confirm('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['confirm'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
'))xajax_submitFormContact($(form_contact_version).value, $(form_contact_email).value, $(form_contact_commentaire).value, $(form_contact_abo).checked);" value="<?php echo $this->_config[0]['vars']['formContact_envoyer']; ?>
" />
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="modal hide" id="myModal" tabindex="-1">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3></h3>
			</div>
			<div class="modal-body">
			</div>
		</div>

		<div class="modal hide" id="alertModal" tabindex="-1">
			<div class="modal-body">
			</div>
		</div>

		<div class="modal hide modalBig" id="myBigModal" tabindex="-1">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3></h3>
			</div>
			<div class="modal-body">
			</div>
		</div>

		<div class="modal hide modalMiddle" id="myMiddleModal" tabindex="-1">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3></h3>
			</div>
			<div class="modal-body">
			</div>
		</div>

		<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.js"></script>
		<script language="javascript">
						addEvent(window, 'load', initAll);
			<?php echo '
			jQuery(function() {
				jQuery( ".modal" ).draggable({
					cursor: "move",
					handle: "h3"
				});
			});
			'; ?>

		</script>
	</body>
</html>