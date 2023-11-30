$(function() {
    $('select[name="section"]').change(function() {
        var section = $('select[name="section"] option:selected').attr("class");
        console.log(section);
        var count = $('select[name="menu[]"]').children().length;
        console.log(count);

        for(a=0; a<count; a++) {
            var menu = $('select[name="menu[]"] option:eq('+a+')');

            if(menu.attr("class") === section) {
                menu.show();
            } else {
                menu.hide();
            }
        }
    });
});
  