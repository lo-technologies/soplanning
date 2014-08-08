{* Smarty *}
<form class="form-horizontal" method="get" action="export_pdf.php" target="_blank">
	<div class="control-group">
		<label class="control-label">{#PDFExport_orientation#} :</label>
		<div class="controls">
			<select name="pdf_orientation" id="orientation">
				<option value="paysage" {if $pdf_orientation eq "paysage"}selected="selected"{/if}>{#PDFExport_orientation_paysage#}</option>
				<option value="portrait" {if $pdf_orientation eq "portrait"}selected="selected"{/if}>{#PDFExport_orientation_portrait#}</option>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">{#PDFExport_format#} :</label>
		<div class="controls">
			<select name="pdf_format" id="format">
				<option value="A4" {if $pdf_format eq "A4"}selected="selected"{/if}>A4</option>
				<option value="A3" {if $pdf_format eq "A3"}selected="selected"{/if}>A3</option>
				<option value="A2" {if $pdf_format eq "A2"}selected="selected"{/if}>A2</option>
				<option value="A1" {if $pdf_format eq "A1"}selected="selected"{/if}>A1</option>
				<option value="A0" {if $pdf_format eq "A0"}selected="selected"{/if}>A0</option>
			</select>
		</div>
	</div>
	<input type="submit" class="btn btn-primary" value="{#winPeriode_valider#|escape:"html"}" style="margin-left: 400px;" />
</form>