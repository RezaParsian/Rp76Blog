$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $("select").select2();

    setTimeout(function () {
        $("select").trigger("change")
    }, 200);
});

$(function () {
    table1 = $('.dtTable').DataTable({
        responsive: true,
        language: {
            "sEmptyTable": "هیچ داده ای در جدول وجود ندارد",
            "sInfo": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
            "sInfoEmpty": "نمایش 0 تا 0 از 0 رکورد",
            "sInfoFiltered": "(فیلتر شده از _MAX_ رکورد)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "نمایش _MENU_ رکورد",
            "sLoadingRecords": "در حال بارگزاری...",
            "sProcessing": "در حال پردازش...",
            "sSearch": "جستجو:",
            "sZeroRecords": "رکوردی با این مشخصات پیدا نشد",
            "oPaginate": {
                "sFirst": "ابتدا",
                "sLast": "انتها",
                "sNext": "بعدی",
                "sPrevious": "قبلی"
            },
            "oAria": {
                "sSortAscending": ": فعال سازی نمایش به صورت صعودی",
                "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
            }
        }
    });
    $('select[aria-controls=\'DataTables_Table_0\']').addClass("form-control mx-2");
    $("select[aria-controls='DataTables_Table_0']").parent().addClass("form-inline");
    $('input[aria-controls=\'DataTables_Table_0\']').addClass("form-control mx-2");
    $("input[aria-controls='DataTables_Table_0']").parent().addClass("form-inline");
    table1.order([0, "desc"]).draw();
});
