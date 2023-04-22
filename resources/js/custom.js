window.verify = function (element) {
    Swal.fire({
        title: 'آیا از حذف این ایتم مطمئن هستید؟',
        showCancelButton: true,
        input: "text",
        cancelButtonText: "خیر",
        confirmButtonText: `بله`,
    }).then((result) => {
        if (result.isConfirmed && result.value === "confirm") {
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
};

$(() => {
    $("#night").click(function () {
        $("body").addClass('dark');
        $("#day").show();
        $(this).hide();
    });

    $("#day").click(function () {
        $("body").removeClass('dark');
        $("#night").show();
        $(this).hide();
    });
});
