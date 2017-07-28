/**
 * Created by Cuthbert Mirambo on 6/26/2017.
 *
 * Holds Custom Scripts For Hostel App
 */
/**
 * Add Feature Generate
 */
$(document).on('click', '#btnPropertyFeatureGen', function () {
    //catch click
    var $this = $(this);

    //markup
    var $output = '<fieldset class="form-group">';
    $output += '<div class="row">';
    $output += '<div class="col-sm-3">';
    $output += '<div class="md-form">';
    $output += '<label class="form-control-label">Feature</label>';
    $output += '<input type="text" name="feature[]" class="form-control underlined _add_feature">';
    $output += '</div>';
    $output += '</div>';
    $output += '<div class="col-md-5">';
    $output += '<div class="md-form">';
    $output += '<label class="form-control-label">Feature Details</label>';
    $output += '<input type="text" name="details[]" class="form-control underlined _add_details" maxlength="255">';
    $output += '</div>';
    $output += '</div>';
    $output += '<div class="col-md-2">';
    $output += '<div class="md-form">';
    $output += '<label class="form-control-label">#</label>';
    $output += '<input type="text" name="value[]" class="form-control underlined _add_value">';
    $output += '</div>';
    $output += '</div>';
    $output += '<div class="col-md-2">';
    $output += '<button type="button" name="btnFeatureGen" class="btn btn-warning btn-sm btnPropertyRemoveFeature pull-right"';
    $output += ' data-toggle="tooltip" title="Remove feature">';
    $output += 'Remove ';
    $output += '<span class="fa fa-remove"></span>';
    $output += '</button>';
    $output += '</div>';
    $output += '</div>';
    $output += '</fielset>';


    // $output += '';

    //add markup
    $($this).before($output);

});

/**
 * Remove Generated Feature
 */
$(document).on('click', '.btnPropertyRemoveFeature', function () {
    //catch click
    var $this = $(this);

    //transverse to top parent
    $this.parent().parent().remove();
});

/**
 * On Change Multiple Tenancy
 */
$('input[name="multiple_tenants"]').on('change', function () {

    //catch selector
    $this = $(this);

    //check and change 'input#tenants' property disabled
    if ($this.val() == 1)
        $('input#tenants[name="tenants"]').prop('disabled', false);
    else
        $('input#tenants[name="tenants"]').prop('disabled', true);

});

