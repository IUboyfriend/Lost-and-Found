function getparastr(strname) {
    var hrefstr, pos, parastr, para, tempstr;
    hrefstr = window.location.href;
    pos = hrefstr.indexOf("?");
    parastr = hrefstr.substring(pos + 1);
    para = parastr.split("&");
    tempstr = "";
    for (i = 0; i < para.length; i++) {
        tempstr = para[i];
        pos = tempstr.indexOf("=");
        if (tempstr.substring(0, pos) == strname) {
            return decodeURI(tempstr.substring(pos + 1));
        }
    }
    return "";
}

$(function(){

	toastr.options = {
 'timeOut': '1500', 'showDuration': '300','positionClass': 'toast-top-center' };
	var msg = getparastr("msg");
    var type = getparastr("type");

if(msg != "" && msg != null)
{
    if(type!=""&&type!=null){
        toastr.success(msg);

    }else{
        toastr.error(msg);
    }

}

});
