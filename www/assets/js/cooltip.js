//\///////
//\ DO NOT REMOVE OR CHANGE THIS NOTICE.
//\ coolTip - Core Module v2.0.2- Copyright Robert E Boughner 2004. All rights reserved.
//\   Initial: February 28, 2003 - Last Revised: May 26, 2012
//\		removed references to NS4 and IE4 and modified so that it is compatible
//\		with browser versions greater than 8.
//\
//\ coolTip is based on Erik Bosrup's overLIB utility (see
//\ http://www.bosrup.com/web/overlib/) except that it uses an object-oriented approach
//\ so that more than one popup at a time can be present on a page, each with their own
//\ set of properties. Users are free to employ this code for personel use on their
//\ web pages as long as this notice is kept in its entirety. Substantial modifications and changes
//\ to the code, or incorporation into commercial packages, requires prior written permission from the
//\ author and must be documented so that any such modifications and/or changes stand out from the
//\ original code.
//\ 
//\ Give credit on sites that use coolTip.
//\ DO NOT REMOVE OR CHANGE THIS NOTICE.
//\  THIS IS A VERY MODIFIED VERSION. DO NOT EDIT OR PUBLISH. GET THE ORIGINAL!
//\///////
var cLoaded=0,pmStart=10000000,pmUpper=10001000,pmCount=pmStart+1,pms=new Array(),pmt='',cInfo=new Info(2.02,0),FREPLACE=0,FBEFORE=1,FAFTER=2,FALTERNATE=3,FCHAIN=4,hookPts=new Array(),postParse=new Array(),cmdLine=new Array(),runTime=new Array(),parentLyrs=new Array(),coreCmds='donothing,sticky,background,noclose,caption,left,right,center,offsetx,offsety,'+
'fgcolor,bgcolor,textcolor,capcolor,closecolor,width,border,cellpad,status,autostatus,'+
'autostatuscap,height,closetext,closeimg,snapx,snapy,relx,rely,fgbackground,bgbackground,'+
'above,below,capicon,textfont,captionfont,closefont,textsize,'+
'captionsize,closesize,timeout,function,delay,hauto,vauto,closeclick,wrap,followmouse,'+
'mouseoff,closetitle,puid,keepctd,multi,capalign,textalign,fgclass,bgclass,textclass,'+
'captionclass,closeclass,divclass';registerCommands(coreCmds);
var cUdf='undefined';function ud(v){return eval('typeof cd_'+v+'==="undefined"');}
function isUdf(v){return typeof v==="undefined";}
function isNull(v){return v===null;}
function isType(v,type){return typeof v===type;}
var coreValues='donothing||sticky|0|background||noclose||caption||left||right|RIGHT|center||offsetx|10|offsety|10|'+
'fgcolor|#CCCCFF|bgcolor|#333399|textcolor|#000000|capcolor|#FFFFFF|closecolor|#FFC200|width|200|border|1|cellpad|2|status||autostatus|0|'+
'autostatuscap||height|-1|closetext|Close|closeimg||snapx|0|snapy|0|relx|null|rely|null|fgbackground||bgbackground||'+
'above||below|BELOW|capicon||textfont|Verdana,Arial,Helvetica|captionfont|Verdana,Arial,Helvetica|closefont|Verdana,Arial,Helvetica|'+
'textsize|11px|captionsize|10px|closesize|9px|timeout|0|function|null|delay|0|hauto|0|vauto|0|closeclick|0|wrap|0|followmouse|1|'+
'mouseoff|0|closetitle|Click to Close|puid||keepctd|0|multi||capalign||textalign||fgclass||bgclass||textclass||'+
'captionclass||closeclass||divclass|';setDefaultVariables(coreValues);if(ud('aboveheight'))var cd_aboveheight=0;if(ud('frame'))var cd_frame=self;if(ud('text'))var cd_text="Default Text";
var cTip=null,po,cZindex,cFrame=self;
var cOp=(navigator.userAgent.toLowerCase().indexOf('opera')>-1&&document.createTextNode),cNs6=(document.getElementById&&navigator.userAgent.indexOf('Gecko')>-1)? true:false,cMx=cMy=-10000,docRoot=(cFrame.document.documentElement)?cFrame.document.documentElement:cFrame.document.body,ctCheckMouseCapture=true;if(window.addEventListener)window.addEventListener("load",ctLoadHandler,false);else if(window.attachEvent)window.attachEvent("onload",ctLoadHandler);if(docRoot.addEventListener)docRoot.addEventListener("mousemove",ctMouseMove,false);else if(docRoot.attachEvent)docRoot.attachEvent("onmousemove",ctMouseMove);
var capExtent;
function cooltip(){return coolTip(arguments);}
function coolTip(){var theDiv,parV,args=(isType(arguments[0],'object'))?arguments[0]:arguments;if(!cLoaded)return true;if(ctCheckMouseCapture)ctMouseCapture();if(cTip&&cTip.id=='ctDiv'&&!hasKeepCtD(args))cClick(cTip.id);cTip=new LayerObject((theDiv=divID(args)),hasCommand(0,args,MULTI)!=-1);po=cTip.pop;setRunTimeVariables(po);parV=parseTokens(cTip,'x',args);cTip=(!isUdf(parV)&&isType(parV,'object'))?parV:cTip;if(typeof cParams !==cUdf&&typeof cParams[theDiv] !==cUdf&&cParams[theDiv].length)parseTokens(cTip,'x',cParams[theDiv]);if(!postParseChecks(cTip,'x',args))return false;if(po.delay==0){return runHook("ctMain",FREPLACE,cTip.id);}else{po.delayid=setTimeout("runHook('ctMain',FREPLACE,'"+cTip.id+"')",po.delay);return false;}}
function nd(id,time){if(cLoaded){var lyr=cTip,po,ID='',args=arguments,num=args.length;switch(num){case 2:
case 1:
if(isType(args[0],'number')){time=args[0];ID=(num==2)?args[1]:null;}else{ID=args[0];time=(num==2)?args[1]:null;}
break;default: ID='ctDiv';}
if(ID)lyr=fetchObjectLyr(ID);if(lyr){po=lyr.pop;hideDelay(time,lyr);if(po){if( po.showingsticky )runHook('setPosition',FCHAIN,po);if( po.removecounter>=1 ){po.showingsticky=0 };if( po.showingsticky==0 ){po.allowmove=po.sticknow=0;if(!isNull(lyr)&&po.timerid==0)runHook("hideObject",FREPLACE,lyr);}else po.removecounter++;}}}
return true;}
function cClick(){if(cLoaded){var lyr,ar,po;if(!arguments.length){lyr=(this &&!/window/i.test(this.toString()))?this:cTip;id=lyr.id;}else{ar=arguments[0];if(isType(ar,'string')){id=ar;lyr=fetchObjectLyr(id);}
else if(isType(ar,'object')){lyr=ar;id=lyr.id;}}
po=lyr.pop;runHook("hideObject",FREPLACE,lyr);if(po&&po.showingsticky)po.showingsticky=po.sticknow=0;}
return false;}
function ctPageDefaults(){var args=(isType(arguments[0],'object')?arguments[0]:arguments),id=divID(args);if(id){var i,k=new Array();if(typeof cParams===cUdf)cParams=new Array();for(i=0;i<args.length;i++){if(isType(args[i],'number')&&args[i]==PUID){i++;continue;}
k.push(args[i]);}
args=k;k=new Array();if(typeof cParams[id] !==cUdf&&cParams[id].length){if(isType(args[0],'string')){if(isType(cParams[id][0],'string'))cParams[id][0]=args[0];else{k[0]=args[0];k=k.concat(cParams[id]);cParams[id]=k;}
args=args.slice(1);}
cParams[id]=cParams[id].concat(args);}else cParams[id]=args;}else parseTokens(null,'cd_',args);}
function ctMain(){
var layerhtml,cls,ar,lyr;if(!arguments.length){lyr=(this&&!/window/i.test(this.toString()))?this:cTip;id=lyr.id;}else{ar=arguments[0];if(isType(ar,'string')){id=ar;lyr=fetchObjectLyr(id);}
else if(isType(ar,'object')){lyr=ar;id=lyr.id;}}
po=lyr.pop;runHook("ctMain",FBEFORE,id);with(po){if(background!=""){
layerhtml=runHook('ctContentBackground',FALTERNATE,lyr,text,background);}else{
if(cap==""&&!sticky){
layerhtml=runHook('ctContentSimple',FALTERNATE,lyr,text);}else{cls=(sticky)?close:'';layerhtml=runHook('ctContentCaption',FALTERNATE,lyr,text,cap,cls);}}
if(sticky){if(timerid>0){clearTimeout(timerid);timerid=0;}
showingsticky=1;removecounter=0;}
if(!runHook("ctCreatePopup",FREPLACE,lyr,layerhtml))return false;
if(autostatus>0){status=text;if(autostatus>1)status=cap;}
allowmove=0;
if(timeout>0){if(timerid>0)clearTimeout(timerid);timerid=setTimeout("cClick('"+lyr.id+"')",timeout);}
runHook("disp",FREPLACE,lyr,status);runHook("ctMain",FAFTER,id);return(cOp&&event&&event.type=='mouseover'&&!status)?'':(status!='');}}
function ctContentSimple(lyr,text){var txt='Problem forming popup!',cObj;cObj=containerStyle(lyr,'set');if(cObj){txt=ctInnerContent(lyr,text);set_background(lyr,"");}
return txt;}
function ctContentCaption(lyr,text,cap,close){var txt='Problem forming popup!',nameId,rpStr,cObj,doClose=(close!="");var closing="";var closeevent="onmouseover";cObj=containerStyle(lyr,'set');if(cObj){with(lyr.pop){if(doClose){if(closeclick==1)closeevent=(closetitle?" title='"+closetitle+"'":"")+" onclick";closing=wrapStr(lyr,0,closesize,'close')+'<a href="javascript:return '+fnRef+'cClick(\''+lyr.id+'\');"'+closeevent+'="return '+fnRef+'cClick(\''+lyr.id+'\');"'+(closeimg?'><img src="'+closeimg+'" />':' style="color: '+closecolor+';">'+close)+'</a>'+wrapStr(lyr,1,closesize,'close');rpStr=closing+'</div>';}
if(capicon!=""){nameId=' hspace="5"'+' align="middle" alt=""';if(typeof dragimg!=cUdf&&dragimg)nameId=' name="'+dragimg+'" id="'+dragimg+'" hspace="5" align="middle" alt="Drag Enabled" title="Drag Enabled"';capicon='<img src="'+capicon+'"'+nameId+' />';}
txt=wrapStr(lyr,0,captionsize,'caption')+(capicon?capicon:(cap?cap:'&nbsp;'))+wrapStr(lyr,1,captionsize,'caption');if(doClose)txt=txt.replace(/<\/div>$/,rpStr);txt+='\n'+ctInnerContent(lyr,text);}
set_background(lyr,"");}
return txt;}
function ctContentBackground(lyr,text,picture){var txt=(text)?text:'';set_background(lyr,picture);return txt;}
function set_background(lyr,pic){if(lyr&&lyr.style){if(pic==""){lyr.style.backgroundImage="none";}else{lyr.style.width=lyr.pop.width+'px';lyr.style.backgroundImage="url("+pic+")";}}}
function ctInnerContent(lyr,theTxt){var txt,po=lyr.pop;txt=wrapStr(lyr,0,po.textsize,'text')+theTxt+wrapStr(lyr,1,po.textsize,'text');return txt;}
function containerStyle(obj,cWhat){var curStyle,oSs,styStr,isIE=/msie/i.test(navigator.userAgent);if(obj&&obj.pop){with(obj.pop){if(cWhat=='set'){if(divclass)obj.className=divclass;else{curStyle=obj.getAttribute('style');if(isType(curStyle,'object')&&isIE)curStyle=obj.style.cssText;styStr='border: '+border+'px solid '+bgcolor+';'+((width)?' width: '+width+'px;':'');
if(curStyle){curStyle=curStyle.replace(/\;*\s*$/,";");curStyle+=styStr;}
else curStyle=styStr;if(isIE)  obj.style.cssText=curStyle;else obj.setAttribute('style',curStyle);}
}else if(cWhat=='rmv'){if(divclass)obj.className='';else{obj.removeAttribute('style');styStr='position: absolute;visibility: hidden;z-index: 1000;';if(isIE)obj.style.cssText=styStr;else obj.setAttribute('style',styStr);}}}
return obj;}else return null;}
function disp(lyr,statustext){
var po=lyr.pop;runHook("disp",FBEFORE,lyr,statustext);with(po){if(allowmove==0)  {runHook("placeLayer",FREPLACE,lyr);runHook("showObject",FREPLACE,lyr);allowmove=(!followmouse)?0:1;}}
runHook("disp",FAFTER,lyr,statustext);if(statustext!="")self.status=statustext;}
function ctCreatePopup(lyr,lyrContent){var po=lyr.pop;
runHook("ctCreatePopup",FBEFORE,lyr,lyrContent);with(po){if(wrap){var wd,ww;layerWrite(lyr,lyrContent);wd=lyr.offsetWidth;if(wd>(ww=windowWidth())){lyrContent=lyrContent.replace(/\s/g,' ');width=ww;wrap=0;}}
layerWrite(lyr,lyrContent);
if(wrap)width=lyr.offsetWidth;}
runHook("ctCreatePopup",FAFTER,lyr,lyrContent);return true;}
function ctMouseMove(e){e=(e)?e:event;if(e.pageX){cMx=e.pageX;cMy=e.pageY;}
else if(e.clientX){cMx=e.clientX+docRoot.scrollLeft;cMy=e.clientY+docRoot.scrollTop;}
positionDiv(cTip);}
function ctMouseCapture(){capExtent=document;var fN,str='',l,k,f,wMv,sS,mseHandler=ctMouseMove;var re=/function\s+(\w*)\(/;wMv=window.onmousemove;if(document.onmousemove ||wMv){if(wMv)capExtent=window
f=capExtent.onmousemove.toString();fN=f.match(re);if(isNull(fN)){str=f+'(e);';}else if(fN[1]=='anonymous'||fN[1]=='ctMouseMove'||(wMv&&fN[1]=='onmousemove')){if(wMv){l=f.indexOf('{')+1;k=f.lastIndexOf('}');sS=f.substring(l,k);if((l=sS.indexOf('('))!=-1){sS=sS.substring(0,l).replace(/^\s+/,'').replace(/\s+$/,'');if(ud(sS))window.onmousemove=null;else str=sS+'(e);';}}
if(!str){ctCheckMouseCapture=false;return;}
}else{if(fN[1])str=fN[1]+'(e);';else{l=f.indexOf('{')+1;k=f.lastIndexOf('}');str=f.substring(l,k);}}
str+='ctMouseMove(e);';mseHandler=new Function('e',str)}
capExtent.onmousemove=mseHandler;}
function parseTokens(cObj,pf,ar){
var v,i,iN,iM,po,iObj=cObj,nClsOpt=false,cDm,md=-1,par=(pf!='cd_');pf=(par)?'po.':pf;if(par)po=cObj.pop,fnMark=(par&&!ar.length?1:0);if(par)po=cObj.pop;for(i=0;i<ar.length;i++){if(md<0){
if(isType(ar[i],'number')&&ar[i]>pmStart&&ar[i]<pmUpper){fnMark=(par?1:0);i--;}else{if(!par)cd_text=unpack(ar[i]);else po.text=unpack(ar[i]);}
md=0;}else{if(ar[i]>=pmCount||ar[i]==DONOTHING||ar[i]==MULTI){continue;}
if(ar[i]==STICKY){if(pf!='cd_')eval(pf+'sticky=1');continue;}
if(ar[i]==BACKGROUND){eval(pf+'background="'+ar[++i]+'"');continue;}
if(ar[i]==NOCLOSE){if(pf!='cd_')nClsOpt=true;continue;}
if(ar[i]==CAPTION){eval(pf+"cap='"+escSglQuote(ar[++i])+"'");continue;}
if(ar[i]==CENTER||ar[i]==LEFT||ar[i]==RIGHT){eval(pf+'hpos='+ar[i]);continue;}
if(ar[i]==OFFSETX){eval(pf+'offsetx='+ar[++i]);continue;}
if(ar[i]==OFFSETY){eval(pf+'offsety='+ar[++i]);continue;}
if(ar[i]==FGCOLOR){eval(pf+'fgcolor="'+ar[++i]+'"');continue;}
if(ar[i]==BGCOLOR){eval(pf+'bgcolor="'+ar[++i]+'"');continue;}
if(ar[i]==TEXTCOLOR){eval(pf+'textcolor="'+ar[++i]+'"');continue;}
if(ar[i]==CAPCOLOR){eval(pf+'capcolor="'+ar[++i]+'"');continue;}
if(ar[i]==CLOSECOLOR){eval(pf+'closecolor="'+ar[++i]+'"');continue;}
if(ar[i]==WIDTH){eval(pf+'width='+ar[++i]);continue;}
if(ar[i]==BORDER){eval(pf+'border='+ar[++i]);continue;}
if(ar[i]==STATUS){eval(pf+"status='"+escSglQuote(ar[++i])+"'");continue;}
if(ar[i]==AUTOSTATUS){eval(pf+'autostatus=('+pf+'autostatus==1)?0:1');continue;}
if(ar[i]==AUTOSTATUSCAP){eval(pf+'autostatus=('+pf+'autostatus==2)?0:2');continue;}
if(ar[i]==HEIGHT){eval(pf+'height='+pf+'aboveheight='+ar[++i]);continue;}
if(ar[i]==CLOSETEXT){eval(pf+"close='"+escSglQuote(ar[++i])+"'");continue;}
if(ar[i]==CLOSEIMG){eval(pf+"closeimg='"+ar[++i]+"'");continue;}
if(ar[i]==SNAPX){eval(pf+'snapx='+ar[++i]);continue;}
if(ar[i]==SNAPY){eval(pf+'snapy='+ar[++i]);continue;}
if(ar[i]==RELX){eval(pf+'relx='+ar[++i]);continue;}
if(ar[i]==RELY){eval(pf+'rely='+ar[++i]);continue;}
if(ar[i]==FGBACKGROUND){eval(pf+'fgbackground="'+ar[++i]+'"');continue;}
if(ar[i]==BGBACKGROUND){eval(pf+'bgbackground="'+ar[++i]+'"');continue;}
if(ar[i]==BELOW||ar[i]==ABOVE){eval(pf+'vpos='+ar[i]);continue;}
if(ar[i]==CAPICON){eval(pf+'capicon="'+ar[++i]+'"');continue;}
if(ar[i]==TEXTFONT){eval(pf+"textfont='"+escSglQuote(ar[++i])+"'");continue;}
if(ar[i]==CAPTIONFONT){eval(pf+"captionfont='"+escSglQuote(ar[++i])+"'");continue;}
if(ar[i]==CLOSEFONT){eval(pf+"closefont='"+escSglQuote(ar[++i])+"'");continue;}
if(ar[i]==TEXTSIZE){cDm=/[%a-z]+$/.test(ar[i+1]);eval(pf+'textsize="'+ar[++i]+'"'+(cDm ?'':'px'));continue;}
if(ar[i]==CAPTIONSIZE){cDm=/[%a-z]+$/.test(ar[i+1]);eval(pf+'captionsize="'+ar[++i]+'"'+(cDm ?'':'px'));continue;}
if(ar[i]==CLOSESIZE){cDm=/[%a-z]+$/.test(ar[i+1]);eval(pf+'closesize="'+ar[++i]+'"'+(cDm ?'':'px'));continue;}
if(ar[i]==TIMEOUT){eval(pf+'timeout='+ar[++i]);continue;}
if(ar[i]==FUNCTION){if(pf=='cd_'){if(!isType(ar[i+1],'number')){v=ar[++i];cd_function=isType(v,'function')?v:null;}}else{fnMark=0;v=null;if(!isType(ar[i+1],'number'))v=ar[++i]; opt_FUNCTION.call(cObj,v);} continue;}
if(ar[i]==DELAY){eval(pf+'delay='+ar[++i]);continue;}
if(ar[i]==HAUTO){eval(pf+'hauto=('+pf+'hauto==0)?1:0');continue;}
if(ar[i]==VAUTO){eval(pf+'vauto=('+pf+'vauto==0)?1:0');continue;}
if(ar[i]==CLOSECLICK){eval(pf+'closeclick=('+pf+'closeclick==0)?1:0');continue;}
if(ar[i]==WRAP){eval(pf+'wrap=('+pf+'wrap==0)?1:0');continue;}
if(ar[i]==FOLLOWMOUSE){eval(pf+'followmouse=('+pf+'followmouse==1)?0:1');continue;}
if(ar[i]==MOUSEOFF){eval(pf+'mouseoff=('+pf+'mouseoff==0)?1:0');v=ar[i+1];if(pf!='cd_'&&eval(pf+'mouseoff')&&isType(v,'number')&&(v<pmStart||v>pmUpper))eval(pf+'delayHide=ar[++i]');continue;}
if(ar[i]==CLOSETITLE){eval(pf+'closetitle="'+ar[++i]+'"');continue;}
if(ar[i]==PUID){if(!isType(ar[i+1],'number')){if(pf=='cd_'){eval(pf+'puid="'+ar[++i]+'"');}} continue;}
if(ar[i]==KEEPCTD){eval(pf+'keepctd=('+pf+'keepctd==0)?1:0');continue;}
if(ar[i]==CAPALIGN){eval(pf+'capalign="'+ar[++i].toLowerCase()+'"');continue;}
if(ar[i]==TEXTALIGN){eval(pf+'textalign="'+ar[++i].toLowerCase()+'"');continue;}
if(ar[i]==CELLPAD){iM=opt_MULTIPLEARGS(++i,ar);i=iM[0];eval(pf+'cellpad="'+iM[1]+'"');continue;}
if(ar[i]==FGCLASS){eval(pf+'fgclass="'+ar[++i]+'"');continue;}
if(ar[i]==BGCLASS){eval(pf+'bgclass="'+ar[++i]+'"');continue;}
if(ar[i]==TEXTCLASS){eval(pf+'textclass="'+ar[++i]+'"');continue;}
if(ar[i]==CAPTIONCLASS){eval(pf+'captionclass="'+ar[++i]+'"');continue;}
if(ar[i]==CLOSECLASS){eval(pf+'closeclass="'+ar[++i]+'"');continue;}
if(ar[i]==DIVCLASS){eval(pf+'divclass="'+ar[++i]+'"');continue;}
iN=parseCmdLine(cObj,pf,i,ar);if(isType(iN,'object')){i=iN[0];iObj=iN[1];}
else i=iN;}}
if(par){var obj=cObj.pop;with(obj){if(fnMark&&Function)text=callFunction(Function);if(wrap){width=0;var tReg=/<[^>]+?>/ig;if(!tReg.test(text))text=text.replace(/\s+/g,'&nbsp;');if(!tReg.test(cap))cap=cap.replace(/\s+/g,'&nbsp;');}
if(sticky&&(mouseoff||nClsOpt))iObj=opt_NOCLOSE.call(iObj,(mouseoff?' ':''));}}
return iObj;}
function layerWrite(lyr,txt){var po=lyr.pop;if(po&&!po.doXml)txt+="\n";if(po&&po.doXml)lyr=resetNodeContents(txt,lyr);else if(!isUdf(lyr.innerHTML)){lyr.innerHTML=''
lyr.innerHTML=txt}}
function showObject(){if(arguments.length){obj=arguments[0];obj=(isType(obj,'string')?fetchObjectLyr(obj): obj);}
else obj=this;runHook("showObject",FBEFORE,obj);obj.style.visibility='visible';obj.hasShown=1;runHook("showObject",FAFTER,obj);}
function hideObject(){if(!arguments.length)obj=this;else obj=arguments[0];runHook("hideObject",FBEFORE,obj);repositionTo(obj,-10000,-10000);var po=obj.pop;var Obj=obj.style;Obj.visibility='hidden';if(po){if(po.timerid>0)clearTimeout(po.timerid);if(po.delayid>0)clearTimeout(po.delayid);po.timerid=0;po.delayid=0;po.hoveringSwitch=false;}
self.status="";if(obj.onmouseout||obj.onmouseover){obj.onmouseout=obj.onmouseover=null;}
runHook("hideObject",FAFTER,obj);containerStyle(obj,'rmv');deletePopup(obj);}
function repositionTo(obj,xL,yL){var Obj=obj.style;Obj.left=xL+'px';Obj.top=yL+'px';}
function cursorOff(obj){var left,top,right,bottom;left=parseInt(obj.style.left);top=parseInt(obj.style.top);right=left+obj.offsetWidth;bottom=top+obj.offsetHeight;return(cMx<left||cMx>right||cMy<top||cMy>bottom);}
function opt_FUNCTION(callme){var cObj=(this&&/DivElement/.test(this.toString()))?this:cTip;var po=cObj.pop;po.text=(callme?(isType(callme,'string')?(/.+\(.*\)/.test(callme)?eval(callme):callme):callme()):(po.Function?callFunction(po.Function):'No Function'));return 0;}
function opt_NOCLOSE(unused){var po,cObj=(this&&/DivElement/.test(this.toString()))?this:cTip;po=cObj.pop;if(!unused)po.close="";cObj.onmouseover=opt_MSEOVR;return cObj;}
function opt_MSEOVR(e){e=(e)?e:event;if(/mouseover/i.test(e.type)){po=this.pop;po.hoveringSwitch=true;if(po.timerid>0){clearTimeout(po.timerid);po.timerid=0;}}}
function opt_MULTIPLEARGS(i,args){var k=i,l,re,str='';for(k=i;k<args.length;k++){if(isType(args[k],'number')&&args[k]>pmStart)break;str+=args[k]+',';}
if(str)str=str.replace(/,$/,'');k--;return [k,str];}
function nbspCleanup(obj){var po=obj.pop;if(po&&po.wrap){po.text=po.text.replace(/&nbsp;/g,' ');po.cap=po.cap.replace(/&nbsp;/g,' ');}}
function escSglQuote(str){return unpack(str).replace(/'/g,"\\'");}
function ctLoadHandler(e){var re=/\w+\(.*\)[;\s]+/g,olre=/coolTip\(|nd\(|cClick\(/,fn,l,i;if(!cLoaded)cLoaded=1;if(window.removeEventListener&&e.eventPhase==3)window.removeEventListener("load",ctLoadHandler,false);else if(window.detachEvent){window.detachEvent("onload",ctLoadHandler);var fN=document.body.getAttribute('onload');if(fN){fN=fN.toString().match(re);if(fN&&fN.length){for(i=0;i<fN.length;i++){if(/anonymous/.test(fN[i]))continue;while((l=fN[i].search(/\)[;\s]+/))!=-1){fn=fN[i].substring(0,l+1);fN[i]=fN[i].substring(l+2);if(olre.test(fn))eval(fn);}}}}}}
function wrapStr(lyr,endWrap,fontSizeStr,whichString){var fontStr,po,theClassStr='',theStyleStr,fontColor,rtnVal;if(endWrap)rtnVal=(whichString=='close')?'</span>':'</div>';else{po=lyr.pop;with(po){switch(whichString){case 'caption':
case 'close':
case 'text':
fontStr=eval('po.'+whichString+'font');fontColor=eval('po.'+((whichString=='caption')? 'cap':whichString)+'color');theStyleStr='font-family: '+quoteMultiNameFonts(fontStr)+(whichString=='close'?'':';color: '+fontColor)+';font-size: '+fontSizeStr+';';if(whichString=='close'){if(closeclass){theClassStr='class="'+closeclass+'"'; theStyleStr=' float: right;';}
else theStyleStr+=' float: right;';}else if(whichString=='caption'){if(bgclass||captionclass){theClassStr='class="'+(bgclass?bgclass:'')+(captionclass?(bgclass?' ':'')+captionclass:'')+'"';  theStyleStr="overflow: hidden;";}
else{theStyleStr+=' overflow: hidden;background-color: '+bgcolor+';';theStyleStr+=(bgbackground)?' background-image: url("'+bgbackground+'");':'';theStyleStr+=(capalign)?' text-align: '+capalign+';':'';}
}else{if(fgclass||textclass){theClassStr='class="'+(fgclass ?fgclass:'')+(textclass?(fgclass?' ' :'')+textclass:'')+'"';theStyleStr='clear: both;overflow: hidden;';}
else{theStyleStr+=(fgcolor)?' background-color: '+fgcolor+';':'';theStyleStr+=(fgbackground)?' background-image: url("'+fgbackground+'");':'';theStyleStr+=(height>0)?' height: '+height+(/[%a-z]+$/i.test(height)?';':'px;'):'';theStyleStr+=(textalign)?' text-align: '+textalign+';':'';theStyleStr+=(/,/.test(cellpad))?setCellPadStr(cellpad):' padding: '+cellpad+'px'+';';theStyleStr='clear: both;overflow: hidden;'+theStyleStr;}}
break;}}
if(!/\;$/.test(theStyleStr))theStyleStr=theStyleStr+';';rtnVal=((whichString=='close')?'<span ':'<div ')+(theClassStr?theClassStr:'style="'+theStyleStr+'"')+'>';}
return rtnVal;}
function quoteMultiNameFonts(theFont){var v,pM=theFont.split(',');for(var i=0;i<pM.length;i++){v=pM[i];v=v.replace(/^\s+/,'').replace(/\s+$/,'');if(/\s/.test(v)&&!/['"]/.test(v)){v="\'"+v+"\'";pM[i]=v;}}
return pM.join();}
function hideDelay(time,lyr){var po=lyr.pop;if(lyr&&po){if(time&&!po.delay){if(po.timerid>0)clearTimeout(po.timerid);po.timerid=setTimeout("cClick('"+lyr.id+"')",(po.timeout=time));}}}
function setCellPadStr(parameter){var Str='',j=0,ary,top,bottom,left,right;Str+='padding: ';ary=parameter.replace(/\s+/g,'').split(',');switch(ary.length){case 1:
if(!ary[0])ary[0]='"'+po.cellpad+'"';break;case 2:
top=bottom=ary[j];left=right=ary[++j];break;case 3:
top=ary[j];left=right=ary[++j];bottom=ary[++j];break;case 4:
top=ary[j];right=ary[++j];bottom=ary[++j];left=ary[++j];break;}
Str+=((ary.length==1)?ary[0]+'px;':top+'px '+right+'px '+bottom+'px '+left+'px;');return Str;}
function divID(args){var theDiv='';for(var i=0;i<args.length;i++){if(!isType(args[i],'number')||args[i]!=PUID)continue;if(isType(args[i+1],'number'))continue;theDiv=args[i+1];break;}
return theDiv;}
function hasKeepCtD(a){if(isType(a,'object'))if(hasCommand(0,a,KEEPCTD)>=0)return(po&&po.keepctd==0)?true:false;return(po&&po.keepctd)?true:false;}
function hasCommand(istrt,args,COMMAND){for(var i=istrt;i<args.length;i++){if(isType(args[i],'number')&&args[i]==COMMAND)return i;}
return-1;}
function setPosition(obj){if(isType(obj,'object'))obj.sticknow=1;return 1;}
function unpack(txt){if(typeof decodeURLComponent !==cUdf)return decodeURIComponent(txt);else return unescape(txt);}
function positionDiv(cObj){var po;if(cObj){positionAllPopups();po=cObj.pop;
if(po.hoveringSwitch&&cursorOff(cObj)){if(po.delayHide)hideDelay(po.delayHide,cObj);else cClick(cObj.id);po.hoveringSwitch=!po.hoveringSwitch;}}}
function positionAllPopups(){var obj,po,l=document.popups;if(!isUdf(l)&&l.length){for(var i=0;i<l.length;i++){obj=l[i];po=obj.pop;if(po.allowmove==1&&!po.sticknow||(po.scroll&&po.showingsticky))placeLayer(obj);}}}
function createDivContainer(id,frm,zVal){id=(id||'ctDiv'),frm=(frm||cFrame),zVal=(zVal||1000);var styStr,divContainer=fetchObjectLyr(id);if(isNull(divContainer)){var body=frm.document.getElementsByTagName("BODY")[0];divContainer=frm.document.createElement("DIV");divContainer.id=id;body.appendChild(divContainer);styStr='position: absolute;visibility: hidden;z-index: '+zVal+';'
divContainer.setAttribute('style',styStr);}
return divContainer;}
function horizontalPlacement(obj,browserWidth,horizontalScrollAmount,widthFix){var placeX,rD=0,ofx,iwidth=browserWidth,winoffset=horizontalScrollAmount;var po=obj.pop;
var parsedWidth=(!isNaN(po.width))?parseInt(po.width):obj.offsetWidth;if(!isNull(po.relx)){
placeX=po.relx<0?winoffset+po.relx+iwidth-parsedWidth-widthFix:winoffset+po.relx;}else{
if(po.hauto==1){ofx=Math.abs(po.offsetx);if((cMx-winoffset)>(iwidth/2)&&cMx-winoffset+(parsedWidth+ofx)>(iwidth-widthFix)){po.hpos=LEFT;rD=1;}else if((cMx-ofx-parsedWidth)<winoffset){po.hpos=RIGHT;rD=1;}
if(rD)po.offsetx=Math.abs(cd_offsetx);}
if(po.hpos==CENTER||po.hpos==RIGHT){placeX=cMx+po.offsetx;if(po.hpos==CENTER)placeX-=(parsedWidth/2);if((placeX+parsedWidth)>(winoffset+iwidth-widthFix))placeX=iwidth+winoffset-parsedWidth-widthFix;if(placeX<winoffset)placeX=winoffset;}
if(po.hpos==LEFT){placeX=cMx-po.offsetx-parsedWidth;if(placeX<winoffset)placeX=winoffset;}
if(po.snapx>1){var snapping=placeX % po.snapx;if(po.hpos==LEFT){placeX=placeX-(po.snapx+snapping);}else{
placeX=placeX+(po.snapx-snapping);}
if(placeX<winoffset)placeX=winoffset;}}
return placeX;}
function verticalPlacement(obj,browserHeight,verticalScrollAmount){var placeY,rD=0,ofy,iheight=browserHeight,scrolloffset=verticalScrollAmount;var po=obj.pop;
var parsedHeight=(!isNaN(po.aboveheight))?parseInt(po.aboveheight):obj.offsetHeight;if(!isNull(po.rely)){
placeY=po.rely<0?scrolloffset+po.rely+iheight-parsedHeight:scrolloffset+po.rely;}else{
if(po.vauto==1){ofy=Math.abs(po.offsety);if((cMy-scrolloffset)>(iheight/2)){if(cMy-scrolloffset+parsedHeight+ofy>iheight){po.vpos=ABOVE;rD=1;}
}else if(cMy-scrolloffset-ofy-parsedHeight<0){po.vpos=BELOW;rD=1;}
if(rD)po.offsety=Math.abs(cd_offsety);}
if(po.vpos==ABOVE){placeY=cMy-(parsedHeight+po.offsety);if(placeY<scrolloffset)placeY=scrolloffset;}else{
placeY=cMy+po.offsety;}
if(po.snapy>1){var snapping=placeY % po.snapy;if(parsedHeight>0&&po.vpos==ABOVE){placeY=placeY-(po.snapy+snapping);}else{placeY=placeY+(po.snapy-snapping);}
if(placeY<scrolloffset)placeY=scrolloffset;}}
return placeY;}
function placeLayer(obj){var placeX,placeY,winoffset,scrolloffset,iwidth,iheight,widthFix=0;if(cFrame.innerWidth)widthFix=20;iwidth=windowWidth();
winoffset=(cFrame.pageXOffset)?cFrame.pageXOffset:docRoot.scrollLeft;placeX=runHook('horizontalPlacement',FCHAIN,obj,iwidth,winoffset,widthFix);if(cFrame.innerHeight)iheight=cFrame.innerHeight;else if(docRoot&&isType(docRoot.clientHeight,'number')&&docRoot.clientHeight)
iheight=docRoot.clientHeight;
scrolloffset=(cFrame.pageYOffset)?cFrame.pageYOffset:docRoot.scrollTop;placeY=runHook('verticalPlacement',FCHAIN,obj,iheight,scrolloffset);
repositionTo(obj,placeX,placeY);}
function windowWidth(){var w;if(cFrame.innerWidth)w=cFrame.innerWidth;else if(docRoot&&isType(docRoot.clientWidth,'number')&&docRoot.clientWidth)
w=docRoot.clientWidth;return w;}
function setRunTimeVariables(obj){if(!isUdf(runTime)&&runTime.length)
for(var k=0;k<runTime.length;k++)runTime[k](obj);}
function parseCmdLine(cObj,pf,i,args){var jN;if(!isUdf(cmdLine)&&cmdLine.length){for(var k=0;k<cmdLine.length;k++){var j=cmdLine[k](cObj,pf,i,args);jN=(isType(j,'object'))?j[0]:j;if(jN>-1){i=j;break;}}}
return i;}
function postParseChecks(cObj,pf,args){var rtnVal=false;if(cObj){rtnVal=true;if(!isUdf(postParse)&&postParse.length){for(var k=0;k<postParse.length;k++){if(postParse[k](cObj,pf,args))continue;rtnVal=false;break;}}}
return rtnVal;}
function setDefaultVariables(xVar){if(xVar&&isType(xVar,'string')){var v,j,k,vN,val=xVar.split('|'),y,a;for(k=0;k<val.length;k++){v=val[k];vN=val[++k];if(v=='caption'){if(ud('cap'))cd_cap=(!vN)?'':'"'+vN+'"';continue;}
if(/autostatuscap|donothing|noclose/.test(v)){continue;}
if(/above|below/.test(v)){if(vN&&ud('vpos'))cd_vpos=eval(vN);continue;}
if(/closetext/.test(v)){if(ud('close'))cd_close=vN;continue;}
if(/border|captionsize|closesize|textsize|width/.test(v)){if(ud(v))eval('cd_'+v+'="'+vN+'"');continue;}
if(/autostatus|function|relx|rely|frame/.test(v)){if(ud(v))eval('cd_'+v+'='+vN);continue;}
if(v=='center'||/left|right/.test(v)){if(vN&&ud('hpos'))cd_hpos=eval(vN);continue;}
if(ud(v))eval('cd_'+v+'='+(!vN||isNaN(vN)?'"'+vN+'"':Number(vN)));}}}
function isFunction(fnRef){var rtn=true;if(isType(fnRef,'object')){for(var i=0;i<fnRef.length;i++){if(isType(fnRef[i],'function'))continue;rtn=false;break;}
}else if(!isType(fnRef,'function'))rtn=false;return rtn;}
function argToString(array,strtInd,argName){var jS=strtInd,aS='',ar=array;argName=(argName?argName:'ar');if(ar.length>jS){for(var k=jS;k<ar.length;k++)aS+=argName+'['+k+'], ';aS=aS.substring(0,aS.length-2);}
return aS;}
function reOrder(hookPt,fnRef,order){var newPt=new Array(),match,i,j;if(!order||isUdf(order)||isType(order,'number'))return hookPt;if(isType(order,'function')){if(isType(fnRef,'object'))newPt=newPt.concat(fnRef);else newPt.push(fnRef);for(i=0;i<hookPt.length;i++){match=false;if(isType(fnRef,'function')&&hookPt[i]==fnRef)continue;else{for(j=0;j<fnRef.length;j++)if(hookPt[i]==fnRef[j]){match=true;break;}}
if(!match)newPt.push(hookPt[i]);}
newPt.push(order);}else if(isType(order,'object')){if(isType(fnRef,'object'))newPt=newPt.concat(fnRef);else newPt.push(fnRef);for(j=0;j<hookPt.length;j++){match=false;if(isType(fnRef,'function')&&hookPt[j]==fnRef)continue;else{for(i=0;i<fnRef.length;i++)if(hookPt[j]==fnRef[i]){match=true;break;}}
if(!match)newPt.push(hookPt[j]);}
hookPt=newPt;newPt.length=0;for(j=0;j<hookPt.length;j++){match=false;for(i=0;i<order.length;i++){if(hookPt[j]==order[i]){match=true;break;}}
if(!match)newPt.push(hookPt[j]);}
newPt=newPt.concat(order);}
hookPt=newPt;return hookPt;}
function callFunction(f){return(isType(f,'function')?f():'No Function');}
function getNextZ(theLyr){var cObj,obj,zVal;if(isUdf(cZindex)){cObj=fetchObjectLyr('ctDiv');cZindex=(cObj)?cObj.style.zIndex:1000;}
zVal=cZindex;if(typeof document.popups==cUdf){document.popups=new Array();document.popups[0]=theLyr;}else{var l=document.popups;if(l.length){obj=l.pop();l.push(obj,theLyr);zVal=parseInt(obj.style.zIndex)+1;}else l.push(theLyr);}
return zVal;}
function isCloseAllLyr(obj){var i,j,pLyr=parentLyrs,rV=0;if(pLyr.length){for(i=0;i<pLyr.length;i++){if(pLyr[i].pop&&pLyr[i].pop.closeall&&obj==pLyr[i]){rV=1;break;}}}
return rV;}
function deletePopup(obj){var l=document.popups;if(l){var tmpArr=new Array(),theRef;for(var i=0;i<l.length;i++){if(l[i]==obj)continue;theRef=l[i].style;if(isCloseAllLyr(obj))theRef.visibility='hidden';else tmpArr.push(l[i]);}
document.popups=tmpArr;}}
function fetchObjectLyr(id){if(isType(id,'object'))return(id);else return cFrame.document.getElementById(id);}
function registerCommands(cmdStr){if(isType(cmdStr,'string')){var pM=cmdStr.split(',');pms=pms.concat(pM);for(var i=0;i< pM.length;i++)
eval(pM[i].toUpperCase()+'='+pmCount++);}}
function registerNoParameterCommands(cmdStr){if(!cmdStr&&!isType(cmdStr,'string'))return;pmt=(!pmt)?cmdStr:pmt+','+cmdStr;}
function registerHook(fnHookTo,fnRef,hookType,optPm){var hookPt;if(fnHookTo=='plgIn'||fnHookTo=='postParse')return;if(isUdf(hookPts[fnHookTo]))hookPts[fnHookTo]=new FunctionReference();hookPt=hookPts[fnHookTo];if(!isNull(hookType)){if(hookType==FREPLACE){hookPt.ovload=fnRef;}else if(hookType==FBEFORE||hookType==FAFTER){hookPt=(hookType==1?hookPt.before:hookPt.after);if(isType(fnRef,'object'))hookPt=hookPt.concat(fnRef);else hookPt.push(fnRef);if(optPm)hookPt=reOrder(hookPt,fnRef,optPm);}else if(hookType==FALTERNATE){hookPt=hookPt.alt;if(isType(fnRef,'object'))hookPt=hookPt.concat(fnRef);else hookPt.push(fnRef);}else if(hookType==FCHAIN){hookPt=hookPt.chain;if(isType(fnRef,'object'))hookPt=hookPt.concat(fnRef);else hookPt.push(fnRef);}}}
function registerRunTimeFunction(fn){if(isFunction(fn)){if(isType(fn,'object'))runTime=runTime.concat(fn);else runTime.push(fn);}}
function registerCmdLineFunction(fn){if(isFunction(fn)){if(isType(fn,'object'))cmdLine=cmdLine.concat(fn);else cmdLine.push(fn);}}
function registerPostParseFunction(fn){if(isFunction(fn)){if(isType(fn,'object'))postParse=postParse.concat(fn);else postParse.push(fn);}}
function runHook(fnHookTo,hookType){var hookPt=hookPts[fnHookTo],k,reslt=null,arS,ar=arguments;arS=argToString(ar,2);if(!isUdf(hookPt)&&(hookType==FBEFORE||hookType==FAFTER)){hookPt=(hookType==1?hookPt.before:hookPt.after);if(hookPt.length)for(k=0;k<hookPt.length;k++)eval('hookPt[k]('+arS+')');}
switch(hookType){case FREPLACE:
if(isUdf(hookPt)||!(hookPt=hookPt.ovload))reslt=eval(fnHookTo+'('+arS+')');else reslt=eval('hookPt('+arS+')');break;case FALTERNATE:
hookPt=hookPt.alt;for(k=hookPt.length;k>0;k--)if((reslt=eval('hookPt[k-1]('+arS+')'))!=void(0))break;break;case FCHAIN:
hookPt=hookPt.chain;for(k=hookPt.length;k>0;k--)if((reslt=eval('hookPt[k-1]('+arS+')'))!=void(0))break;}
return reslt;}
function FunctionReference(){this.ovload=null;this.before=new Array();this.after=new Array();this.alt=new Array();this.chain=new Array();}
function Info(version,prerelease){this.version=version;this.prerelease=prerelease;
this.simpleversion=Math.round(this.version*100);this.major=parseInt(this.simpleversion/100);this.minor=parseInt(this.simpleversion/10)-this.major * 10;this.revision=parseInt(this.simpleversion)-this.major * 100-this.minor * 10;this.meets=meets;}
function meets(reqdVersion){return(!reqdVersion)?false:this.simpleversion>=Math.round(100*parseFloat(reqdVersion));}
function PopObject(lyr){var y,j,k,cmds=coreCmds.split(',');this.text=cd_text;this.cap=cd_cap;this.timerid=0;this.allowmove=0;this.delayid=0;this.closeall=0;this.hoveringSwitch=false;this.fnRef=''
this.showingsticky=0;this.removecounter=0;this.scroll=0;this.sticknow=0;this.doXml=0;this.delayHide=0;this.aboveheight=cd_aboveheight;for(k=0;k<cmds.length;k++){if(cmds[k]=='caption'){continue;}
if(/autostatuscap|donothing|noclose/.test(cmds[k])){continue;}
if(/above|below/.test(cmds[k])){this.vpos=cd_vpos;continue;}
if(/closetext/.test(cmds[k])){this.close=cd_close;continue;}
if(/function/.test(cmds[k])){this.Function=cd_function;continue;}
if(cmds[k]=='center'||/left|right/.test(cmds[k])){this.hpos=cd_hpos;continue;}
eval('this.'+cmds[k]+'=cd_'+cmds[k]);}}
function LayerObject(theDiv,isMultiple,frm){theDiv=(theDiv||'ctDiv');isMultiple=(isMultiple||theDiv!='ctDiv');var lyr;lyr=createDivContainer(theDiv,frm);lyr.hasShown=(isMultiple?1:0);lyr.pop=new PopObject(lyr);lyr.style.zIndex=getNextZ(lyr);return lyr;}
LayerObject.prototype={show: showObject,
hide: hideObject,
close: cClick,
main: ctMain
};
registerHook("ctContentSimple",ctContentSimple,FALTERNATE);registerHook("ctContentCaption",ctContentCaption,FALTERNATE);registerHook("ctContentBackground",ctContentBackground,FALTERNATE);registerHook("hideObject",nbspCleanup,FBEFORE);registerHook("horizontalPlacement",horizontalPlacement,FCHAIN);registerHook("verticalPlacement",verticalPlacement,FCHAIN);registerHook('setPosition',setPosition,FCHAIN);registerNoParameterCommands('sticky,autostatus,autostatuscap,hauto,vauto,closeclick,wrap,followmouse,mouseoff');