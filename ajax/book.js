$("#ajaxform").submit(function(){

    var username = $('input#username').val();
    var bookedby = $('input#bookedby').val();
    var roomtype = $('#roomtype option:selected').val();
    var fromdate =$('input#fromdate').val();
    var todate =$('input#todate').val();

    $("#ajaxform")[0].reset();

    $.post('ajax/postbooking.php', {username: username, roomtype: roomtype,
        fromdate: fromdate, todate: todate, bookedby: bookedby}, function(date){
        $("#result").html(date);
    });
    return false;
});