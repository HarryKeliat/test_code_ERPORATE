function isi_otomatis(){
  var otomatis = $("#otomatis").val();
    $.ajax({
    url: '../ajax_isiotomatis.php',
    data:"otomatis="+otomatis ,
    })
    .success(function (data) {
    var json = data,
    obj = JSON.parse(json);
    $('#name').val(obj.name);
    $('#price').val(obj.price);

    });
}