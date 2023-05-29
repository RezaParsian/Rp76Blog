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
    let theme = localStorage.getItem('theme');

    $('.night').click(function () {
        localStorage.setItem('theme','night');

        $('html').addClass('dark');

        $('.day').show();
        $(this).hide();
    });

    $('.day').click(function () {
        localStorage.setItem('theme', 'day');

        $('html').removeClass('dark');

        $('.night').show();
        $(this).hide();
    });

    $('#phone_menu_button').click(function () {
        $("#phone_menu").toggle();
    });

    if (theme) {
        $(`.${theme}`).click();
    }

    $('#searchBarButton').click(function () {
        $('#searchBar').toggle(500);
    });

    $('.reactionButton').click(function () {
        const articleId = $(this).data('article');
        const emoji = $(this).data('id');

        $.ajax({
            url: '/api/article/' + articleId,
            method: 'put',
            data: {
                emoji
            },
            success: (res) => {
                Object.entries(res).forEach(([key, value]) => {
                    $(`.counter[data-id='${key}']`).text(value);
                });
            }
        });
    });
});
