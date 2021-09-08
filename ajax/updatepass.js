$("#ajaxform").submit(function(){

    var oldpass = $('input#currentpw').val();
    var newpass = $('input#newpass').val();
    var confirmpass = $('input#confirmpass').val();
    var username = $('input#username').val();

    $("#ajaxform")[0].reset();

    $.post('ajax/passwordpost.php', {username: username, oldpass: oldpass, newpass: newpass, confirmpass: confirmpass}, function(date){
        $("#result").html(date);
    });
    return false;
});