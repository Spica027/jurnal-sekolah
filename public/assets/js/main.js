$(function () {
    $('.item-swipe').swipeTo({
        minSwipe: 100,
        angle: 10,
        wrapScroll: 'body',
        binder: true,
        swipeStart: function () {
            console.log('start');
        },
        swipeMove: function () {
            console.log('move');
        },
        swipeEnd: function () {
            console.log('end');
        },
    });
    getIe();
})

var el = document.getElementById('longpress');

el.addEventListener('long-press', function (e) {
    $("#modalfade").modal({
        show: false
    });

    $("#modalfade").modal('show');

});

$(document).ready(function () {
    //group add limit
    var maxGroup = 10;

    //add more fields group
    $(".addMore").click(function () {
        if ($('body').find('.fieldGroup').length < maxGroup) {
            var fieldHTML = '<div class="form-group col-sm-12 fieldGroup">' + $(".fieldGroupCopy").html() + '</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        } else {
            alert('Maximum ' + maxGroup + ' groups are allowed.');
        }
    });

    //remove fields group
    $("body").on("click", ".remove", function () {
        $(this).parents(".fieldGroup").remove();
    });
});

const printBtn = document.querySelector("#printModal");
const printMdl = document.querySelector("modalx");

printBtn.addEventListener("click", () => {
    printMdl.modal("show");
});
