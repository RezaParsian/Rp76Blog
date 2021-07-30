$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $("select").select2();

    setTimeout(function (){
        $("select").trigger("change")
    },200);
});
