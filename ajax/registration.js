$("#ajaxform").submit(function(){

    var firstname = $('input#firstname').val();
    var lastname = $('input#lastname').val();
    var email = $('input#email').val();
    var phone = $('input#phone').val();
    var address = $('input#address').val();
    var username = $('input#username').val();
    var password = $('input#password').val();
    var usertype = $('#usertype option:selected').val();

    $("#ajaxform")[0].reset();

    $.post('ajax/registration.php', {usertype: usertype, firstname: firstname, lastname: lastname,
        email: email, phone: phone, username: username, password: password, address: address}, function(date){
        $("#result").html(date);
    });
    return false;
});