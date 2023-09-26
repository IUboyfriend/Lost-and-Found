function validate(){
    if($('#UserID').val()==''){
        alert("User ID can not be empty!");
        return false;
    }else if($('#Password').val()==''){
        alert("Password can not be empty!");
        return false;
    }else if($('input:radio[name="role"]:checked').val()==null){
        alert("Choose whether you are a user or an admin!");
        return false;
    }
}