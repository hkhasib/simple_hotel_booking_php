$("#ajaxform").submit(function(){

    var username = $('input#deluser').val();

    //$("#ajaxform")[0].reset();

    $.post('ajax/deleteuser.php', {username: username}, function(date){
        $("#result").html(date);
    });
    return false;
});