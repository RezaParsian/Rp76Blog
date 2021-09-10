$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $("select").select2();

    setTimeout(function () {
        $("select").trigger("change")
    }, 200);
});

$(function () {
    jQuery.extend(jQuery.fn.dataTableExt.oSort, {
        "kh-persian-numbers-pre": function (a) {
            function toEnglishNumber(strNum) {
                var pn = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
                var en = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
                var cache = strNum;

                for (var i = 0; i < 10; i++) {
                    var regex_fa = new RegExp(pn[i], 'g');
                    cache = cache.replace(regex_fa, en[i]);
                }

                return cache;
            }

            return parseFloat(toEnglishNumber(a))
        },
        "kh-persian-numbers-asc": function (a, b) {
            return ((a < b) ? -1 : ((a > b) ? 1 : 0))
        },
        "kh-persian-numbers-desc": function (a, b) {
            return ((a < b) ? 1 : ((a > b) ? -1 : 0))
        }
    });

    table1 = $('.dtTable').DataTable({
        responsive: true,
        columnDefs: [
            { type: 'kh-persian-numbers', targets: 0 }
        ],
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


window.verify=function (element) {
    Swal.fire({
        title: 'آیا از حذف این ایتم مطمئن هستید؟',
        showCancelButton: true,
        input: "text",
        cancelButtonText: "خیر",
        confirmButtonText: `بله`,
    }).then((result) => {
        console.log(result)
        if (result.isConfirmed && result.value === "confirm") {
            console.log(1)
            Swal.fire({
                icon: "success",
                showCancelButton: false,
                showConfirmButton: false
            });

            setTimeout(function () {
                $(element).parent().submit();
            }, 700);
        }
        return false;
    })
}
;
