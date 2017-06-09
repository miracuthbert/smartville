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

//checkbox toggle
$('input#check-all').on('change', function () {

    $this = $(this);

    $this.toggleClass('active');

    var $target = $this.attr('data-target');
    $this.hasClass('active') ? $('input.' + $target).prop('checked', true) : $('input.' + $target).prop('checked', false);
});

//generate category feature field
$('#btnNewCatFeature').on('click', function () {

    //catch clicked item
    var $this = $(this);

    //target container
    var $container = $this.attr('data-target');

    //input holder
    var $holder;
    $holder = '<div class="form-group">';
    $holder += '<div class="row">';
    $holder += '<div class="col-sm-6">';
    $holder += '<div class="form-group">';
    $holder += '<input name="feature[]" class="form-control cat-feature" placeholder="feature name" required/>';
    $holder += '</div>';
    $holder += '</div>';
    $holder += '<div class="col-sm-4">';
    $holder += '<div class="form-group">';
    $holder += '<select name="feature_value[]" class="form-control">';
    $holder += '<option>Select expected value</option>';
    $holder += '<option>Text</option>';
    $holder += '<option>Number</option>';
    $holder += '<option>File</option>';
    $holder += '</select>';
    $holder += '</div>';
    $holder += '</div>';
    $holder += '<div class="col-sm-2">';
    $holder += '<div class="form-group">';
    $holder += '<button type="button" class="btn btn-warning btn-sm btnRmvCatFeature">';
    $holder += '<span class="visible-xs-inline">Remove</span> ';
    $holder += '<i class="fa fa-times"></i>';
    $holder += '</button>';
    $holder += '</div>';
    $holder += '</div>';
    // $holder += '';
    $holder += '</div>';
    $holder += '</div>';

    //append to container
    $('div' + $container).append($holder);

});

//remove category field
$(document).on('click', '.btnRmvCatFeature', function () {

    //catch clicked item
    var $this = $(this);

    //remove selected feature
    $this.parent().parent().parent().parent().remove();

});

//toggle parent category select
$(document).on('change', 'input[name="level"]', function () {

    var $level = $(this).val();

    //hide wrapper div
    if ($level == 1)
        $('div#cat-parent-wrapper').slideUp();
    else
    //show wrapper div
        $('div#cat-parent-wrapper').slideDown();

});