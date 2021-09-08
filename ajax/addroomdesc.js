$("#ajaxform").submit(function(){

    var bedcount = $('input#bedcount').val();
    var bedtype = $('#bedtype option:selected').val();
    var roomtype = $('#roomcode option:selected').val();
    var wifi = $('#wifi option:selected').val();
    var pool = $('#pool option:selected').val();
    var bar = $('#bar option:selected').val();
    var spa = $('#spa option:selected').val();
    var parking = $('#parking option:selected').val();
    var gym = $('#gym option:selected').val();

    $("#ajaxform")[0].reset();

    $.post('ajax/postroomdesc.php', {bedcount: bedcount, bedtype: bedtype,
        roomtype: roomtype, wifi: wifi, pool: pool, bar: bar, spa: spa,
        parking: parking, gym: gym}, function(date){
        $("#result").html(date);
    });
    return false;
});