$("#ajaxform").submit(function(){

    var typecode = $('input#typecode').val();
    var name = $('input#name').val();

    $("#ajaxform")[0].reset();

    $.post('ajax/postroomtype.php', {typecode: typecode, name: name}, function(date){
        $("#result").html(date);
    });
    return false;
});