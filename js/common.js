/*
Auto center window script- Eric King (http://redrival.com/eak/index.shtml)
Permission granted to Dynamic Drive to feature script in archive
For full source, usage terms, and 100's more DHTML scripts, visit http://dynamicdrive.com
*/

var win = null;
function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
}

/* Modified to support Opera */

function bookmarksite(title,url){

if (window.sidebar) // firefox

	window.sidebar.addPanel(title, url, "");

else if(window.opera && window.print){ // opera

	var elem = document.createElement('a');

	elem.setAttribute('href',url);

	elem.setAttribute('title',title);

	elem.setAttribute('rel','sidebar');

	elem.click();

}

else if(document.all)// ie

	window.external.AddFavorite(url, title);

}
/*popup windows*/
       function newWindow(mypage,myname,w,h,features) {
  if(screen.width){
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  }else{winl = 0;wint =0;}
  if (winl < 0) winl = 0;
  if (wint < 0) wint = 0;
  var settings = 'height=' + h + ',';
  settings += 'width=' + w + ',';
  settings += 'top=' + wint + ',';
  settings += 'left=' + winl + ',';
  settings += features;
  win = window.open(mypage,myname,settings);
  win.window.focus();
}
/* popup form*/
function popupform(myform, windowname)
{
if (! window.focus)return true;
window.open('', windowname, 'height=400,width=600,scrollbars=yes');
myform.target=windowname;
return true;
}
/*hide error ie*/
  <!--
function stopError() {
      return true;
}
window.onerror = stopError;
// -->