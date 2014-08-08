function masquerSousMenu(obj) {
	// si on est sur un menu déroulant, ne pas perdre le focus
	if (document.activeElement.type == 'select-one') {
		return;
	}
	var o = document.getElementById(obj);
	o.style.display = 'none';
	SousMenuOpened = false;
}

function afficherSousMenu (obj, objClic) {
	if (SousMenuOpened && obj != SousMenuOpened) {
		masquerSousMenu(SousMenuOpened);
		SousMenuOpened = false;
	} else if (SousMenuOpened) {
		return;
	}
	var o2 = document.getElementById(objClic);
	var o = document.getElementById(obj);
	o.style.display = 'block';

	o.style.left = getPosition(o2, 'offsetLeft');
	//alert(document.body.clientHeight);
	//alert(document.body.scrollTop);
	//alert(o.offsetHeight);
	//alert(getPosition(o2, 'offsetTop'));
	//alert(o.offsetHeight);
	//alert(document.body.scrollTop);
	//alert(parseInt(o.offsetHeight) < parseInt(getPosition(o2, 'offsetTop')));

	// si le menu sort de l'écran, on l'affiche vers le haut
	if ((getPosition(o2, 'offsetTop') + o.offsetHeight > document.body.clientHeight + document.body.scrollTop) && (o.offsetHeight < getPosition(o2, 'offsetTop') - document.body.scrollTop)) {
		o.style.top = getPosition(o2, 'offsetTop') - o.offsetHeight +10 + 'px';
	} else {
		o.style.top = getPosition(o2, 'offsetTop') + 'px';
	}
	if (getPosition(o2, 'offsetLeft') + o.offsetWidth > document.body.clientWidth + document.body.scrollLeft && (o.offsetWidth < getPosition(o2, 'offsetLeft') - document.body.scrollLeft)) {
		o.style.left = getPosition(o2, 'offsetLeft') - o.offsetWidth +15 + 'px';
	} else {
		o.style.left = getPosition(o2, 'offsetLeft') + 'px';
	}
	SousMenuOpened = obj;
}

var timerMasquerSousMenu = null;
var SousMenuOpened = false;
function masquerSousMenuDelai(obj) {
	timerMasquerSousMenu = setTimeout("masquerSousMenu('" + obj + "')",500);
}
function AnnuleMasquerSousMenu(obj) {
	if (timerMasquerSousMenu){
		clearTimeout(timerMasquerSousMenu);
	}
}
