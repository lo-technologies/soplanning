<?php

require_once (BASE . '/../includes/xajax.inc');

$xajax = new xajax(BASE . '/process/xajax_server.php');
$xajax->setCharEncoding('ISO-8859-1');
$xajax->decodeUTF8InputOn();
$xajax->errorHandlerOn();
$xajax->waitCursorOff();
//$xajax->statusMessagesOn();
//$xajax->debugOn();
$xajax->setLogFile(BASE . '/../xajax_errors.log');

$xajax->registerFunction('ajoutProjet');
$xajax->registerFunction('modifProjet');
$xajax->registerFunction('checkProjetId');
$xajax->registerFunction('ajoutPeriode');
$xajax->registerFunction('modifPeriode');
$xajax->registerFunction('submitFormPeriode');
$xajax->registerFunction('moveCasePeriode');
$xajax->registerFunction('filtreProjet');
$xajax->registerFunction('checkAvailableVersion');
$xajax->registerFunction('choixPDF');
$xajax->registerFunction('modifUser');
$xajax->registerFunction('submitFormUser');
$xajax->registerFunction('supprimerUser');
$xajax->registerFunction('modifProfil');
$xajax->registerFunction('submitFormProfil');
$xajax->registerFunction('changerPwd');
$xajax->registerFunction('nouveauPwd');
$xajax->registerFunction('supprimerPeriode');
$xajax->registerFunction('modifFerie');
$xajax->registerFunction('submitFormFerie');
$xajax->registerFunction('supprimerFerie');
$xajax->registerFunction('choixIcal');
$xajax->registerFunction('modifUserGroupe');
$xajax->registerFunction('submitFormUserGroupe');
$xajax->registerFunction('supprimerUserGroupe');
$xajax->registerFunction('autocompleteTitreTache');
$xajax->registerFunction('submitFormContact');

?>