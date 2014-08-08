<?php /* Smarty version 2.6.26, created on 2014-07-21 16:18:40
         compiled from choix_pdf.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'choix_pdf.tpl', 24, false),)), $this); ?>
<form class="form-horizontal" method="get" action="export_pdf.php" target="_blank">
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['PDFExport_orientation']; ?>
 :</label>
		<div class="controls">
			<select name="pdf_orientation" id="orientation">
				<option value="paysage" <?php if ($this->_tpl_vars['pdf_orientation'] == 'paysage'): ?>selected="selected"<?php endif; ?>><?php echo $this->_config[0]['vars']['PDFExport_orientation_paysage']; ?>
</option>
				<option value="portrait" <?php if ($this->_tpl_vars['pdf_orientation'] == 'portrait'): ?>selected="selected"<?php endif; ?>><?php echo $this->_config[0]['vars']['PDFExport_orientation_portrait']; ?>
</option>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['PDFExport_format']; ?>
 :</label>
		<div class="controls">
			<select name="pdf_format" id="format">
				<option value="A4" <?php if ($this->_tpl_vars['pdf_format'] == 'A4'): ?>selected="selected"<?php endif; ?>>A4</option>
				<option value="A3" <?php if ($this->_tpl_vars['pdf_format'] == 'A3'): ?>selected="selected"<?php endif; ?>>A3</option>
				<option value="A2" <?php if ($this->_tpl_vars['pdf_format'] == 'A2'): ?>selected="selected"<?php endif; ?>>A2</option>
				<option value="A1" <?php if ($this->_tpl_vars['pdf_format'] == 'A1'): ?>selected="selected"<?php endif; ?>>A1</option>
				<option value="A0" <?php if ($this->_tpl_vars['pdf_format'] == 'A0'): ?>selected="selected"<?php endif; ?>>A0</option>
			</select>
		</div>
	</div>
	<input type="submit" class="btn btn-primary" value="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['winPeriode_valider'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" style="margin-left: 400px;" />
</form>