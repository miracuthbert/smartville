$(document).ready(function () {
    $('a#replyToggle').on('click', function (e) {

        //stop default
        e.preventDefault();

        //show form
        $('form#replyEmail').slideDown();
    });
});