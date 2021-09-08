$("#ajaxform").submit(function(){

    var roomcode = $('#roomcode option:selected').val();
    var roomnum = $('input#roomnum').val();

    $("#ajaxform")[0].reset();

    $.post('ajax/postroom.php', {roomcode: roomcode, roomnum: roomnum}, function(date){
        $("#result").html(date);
    });
    return false;
});