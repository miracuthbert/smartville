$(document).ready(function () {
    $('a#replyToggle').on('click', function (e) {

        //stop default
        e.preventDefault();

        //show form
        $('form#replyEmail').slideDown();
    });
});

//init ckeditor
$('textarea.ckeditor').ckeditor(options);

$('input#check-all').on('change', function () {

    $this = $(this);

    $this.toggleClass('active');

    var $target = $this.attr('data-target');
    $this.hasClass('active') ? $('input.' + $target).prop('checked', true) : $('input.' + $target).prop('checked', false);
})
