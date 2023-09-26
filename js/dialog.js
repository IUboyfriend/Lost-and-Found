var NoticeID;
var dialog_html_str;
function handleClick(ID) {
    NoticeID=ID;
    dialog_html_str =
    '<div class="dialog_close_btn" onclick="closeDialog()">X</div>' +
    '<div class="dialog_title" style="font-size:25px;font-weight:900">Response</div>' +
    '<div class="dialog_content">' + '<form id="form" action="Response.php" method="post">'+
    '<textarea style="width:80%;height:230px"  name="response" required  ></textarea>'+
    '<input hidden="hidden" type="text" name="NoticeID" value="' + NoticeID + '"></form>'+
    '</div>' +
    '<div class="dialog_btn_group" style="padding: 0px 0px 20px;">' +
    '<div class="btn_confirm" onclick="submitForm()">Confirm</div>' +
    '<div class="btn_cancel" onclick="closeDialog()">Cancel</div>' +
    '</div>' ;

    $("#overlap").show() ;
    $("#dialog_wrapper").show();
    $("#dialog_wrapper").css("height","400px");
    $("#dialog_wrapper").css("width","700px");
    $("#dialog_wrapper").html(dialog_html_str);
}

function closeDialog() {
    $("#overlap").hide();
    $("#dialog_wrapper").hide();
}

function submitForm() {
    $("#form").submit();
    closeDialog();
}