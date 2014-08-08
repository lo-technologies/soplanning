		{* Smarty *}
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
						<a href="#divFormSupport" role="button" data-toggle="modal" class="noprint">{#formContact_titre#}</a>
					</p>
				</div>
			</div>
		</div>

		<div id="pwdReminderModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>{#rappelPwdTitre#}</h3>
			</div>
			<div class="modal-body">
				<input type="text" id="rappel_pwd" placeholder="{#rappelPwdVotreEmail#}" class="input-xlarge">
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" id="changePwd">{#submit#}</button>
			</div>
		</div>

		<div class="modal hide" id="divFormSupport" tabindex="-1">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>{#formContact_titre#}</h3>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<input type="hidden" id="form_contact_version" value="{$infoVersion}" style="width:100px">
					<div class="control-group">
						<label class="control-label">{#formContact_email#} :</label>
						<div class="controls">
							<input type="text" id="form_contact_email" value="{if isset($user) && $user.email neq ''}{$user.email}{/if}">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">{#formContact_commentaire#} :</label>
						<div class="controls">
							<textarea id="form_contact_commentaire" style="width:300px;height:60px;"></textarea>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<label class="checkbox inline">
								<input type="checkbox" id="form_contact_abo" value="1" checked="checked">&nbsp;{#formContact_newsletter#}
							</label>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"></label>
						<div class="controls">
							<input type="button" class="btn btn-primary" onClick="if(confirm('{#confirm#|escape:"javascript"}'))xajax_submitFormContact($(form_contact_version).value, $(form_contact_email).value, $(form_contact_commentaire).value, $(form_contact_abo).checked);" value="{#formContact_envoyer#}" />
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
			{* initialisation de toutes les fonctions importantes *}
			addEvent(window, 'load', initAll);
			{literal}
			jQuery(function() {
				jQuery( ".modal" ).draggable({
					cursor: "move",
					handle: "h3"
				});
			});
			{/literal}
		</script>
	</body>
</html>