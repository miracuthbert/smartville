$(document).ready(function () {
    $alertdismiss = '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span></button>';

    $('.stores-sidebar').affix({
        offset: {
            top: 100,
            bottom: function () {
                return (this.bottom = $('.footer').outerHeight(true))
            }
        }
    });

    // $('[a.disabled]').preventDefault();
    // $('li > a.disabled').preventDefault();

    /**
     * Date Selector
     */
    $(document).on('click focus keyUp keyDown', '.date-selector', function () {
        $(this).datepicker({
            'minDate': '-5Y',
            'dateFormat': 'yy-mm-dd',
            'defaultDate': 0,
            'gotoCurrent': true,
        });
    });

    /**
     * Time Selector
     */
    // $('.time-selector').datepicker();

    /**
     * Tooltip
     */
    $('[data-toggle="tooltip"]').tooltip();

    /**
     * Popover
     */
    $(function () { $('[data-toggle="popover"]').popover() });

    /**
     * Off canvas sidebar
     */
    $(document).ready(function () {
        $('[data-toggle="offcanvas"]').click(function () {
            $('.row-offcanvas').toggleClass('active')
        });
    });

//    $('body').scrollspy({ target: '#nav-profile' });

    $(document).on('click', '#nav-profile li a', function (e) {
        $link = $(this).attr('data-target');

        //remove active class
        $('#nav-profile li a.active').removeClass('active');

        //add active to clicked link
        $(this).addClass('active');

        $('html, body').animate({
            scrollTop: $('#' + $link).offset().top
        }, 1000);
        e.preventDefault();
    });

    /**
     * Input field reset
     */
    $(document).on('click', '.btnReset', function () {
        $this = $(this);

        //remove 'field-reset' from all elements
        $('.field-reset').removeClass('field-reset');

        //parent
        $this.parent().parent().addClass('field-reset');

        //clear field
        $('.field-reset input').val("");
    });

    /**
     * On Terms Accepted
     */
    $(document).on('change', '#terms', function () {
        $this = $(this);

        //toggle class
        $this.toggleClass('accepted');

        //check if this is checked
        if ($this.hasClass('accepted'))
            $('#btnCreateApp').prop('disabled', false);
        else
            $('#btnCreateApp').prop('disabled', true);
    });

    /**
     * On Change Multiple Tenancy
     */
    $('input[name="multiple_tenancy"]').on('change', function () {

        //catch selector
        $this = $(this);

        //check and change 'input#tenants' property disabled
        if ($this.val() == 1)
            $('input#tenants[name="tenants"]').prop('disabled', false);
        else
            $('input#tenants[name="tenants"]').prop('disabled', true);

    });

    /**
     * On Change old price
     */
    $('select#oldPrices').on('change', function () {
        $this = $(this);

        //get selected price
        $oldPrice = $this.val();

        //check if numeric and assign
        if ($this.val() >= 0) {
            $('input#price[name="price"]').val($oldPrice);
        }
    });

    /**
     * Add Feature Generate
     */
    $(document).on('click', '#btnFeatureGen', function () {
        //catch click
        $this = $(this);

        //markup
        $output = '<div class="row">';
        $output += '<div class="col-md-3">';
        $output += '<div class="form-group">';
        $output += '<label>Feature:</label>';
        $output += '<input type="text" name="feature[]" class="form-control _add_feature">';
        $output += '</div>';
        $output += '</div>';
        $output += '<div class="col-md-6">';
        $output += '<div class="form-group">';
        $output += '<label>Details:</label>';
        $output += '<input type="text" name="details[]" class="form-control _add_details">';
        $output += '</div>';
        $output += '</div>';
        $output += '<div class="col-md-2">';
        $output += '<div class="form-group">';
        $output += '<label>No.:</label>';
        $output += '<input type="text" name="value[]" class="form-control _add_value">';
        $output += '</div>';
        $output += '</div>';
        $output += '<div class="col-md-1">';
        $output += '<label class="hidden-xs"><span class="text-warning">Remove</span></label>';
        $output += '<button type="button" name="btnFeatureGen" class="btn btn-warning btnRemoveFeature" ';
        $output += 'data-toggle="tooltip" title="Remove feature">';
        $output += '<span class="fa fa-remove"></span>';
        $output += '</button>';
        $output += '</div>';
        $output += '<hr>';
        $output += '</div>';


        // $output += '';

        //add markup
        $($this).before($output);

    });

    /**
     * Remove Generated Feature
     */
    $(document).on('click', '.btnRemoveFeature', function () {
        //catch click
        $this = $(this);

        //transverse to top parent
        $this.parent().parent().empty().slideUp();
    });

    /**
     * Edit Property Feature
     */
    $(document).on('click', '.btnEditPropertyFeature', function () {
        $this = $(this);

        //hide alert
        $('form#feature-edit div#feature-alert').alert('close')

        //remove 'active' class from all blockquotes
        $('#features-body blockquote').removeClass('active');

        //assign 'active' class to current blockquote
        $this.parent().parent().parent().addClass('active');

        //get feature data
        $id = $('#features-body blockquote.active input._id').val();
        $feat = $('#features-body blockquote.active input._feat').val();
        $details = $('#features-body blockquote.active input._details').val();
        $value = $('#features-body blockquote.active input._value').val();

        //assign values
        $('input#_fid').val($id);
        $('input#_feature').val($feat);
        $('textarea#_details').val($details);
        $('input#_value').val($value);
    });

    /**
     * Edit App Feature
     */
    $(document).on('click', '.btnFeatureEdit', function () {
        $this = $(this);

        //hide alert
        $('form#feature-edit div#feature-alert').alert('close')

        //remove 'active' class from all blockquotes
        $('#app-features blockquote').removeClass('active');

        //assign 'active' class to current blockquote
        $this.parent().parent().parent().addClass('active');

        //get feature data
        $id = $('#app-features blockquote.active input._id').val();
        $feat = $('#app-features blockquote.active input._feat').val();
        $details = $('#app-features blockquote.active input._details').val();

        //assign values
        $('input#_fid').val($id);
        $('input#_feature').val($feat);
        $('textarea#_details').val($details);
    });

    /**
     * Add App Feature
     */
    $(document).on('click', '#btnFeatureAdd', function () {
        $this = $(this);

        $app = $('input#_app').val();
        $feature = $('input#feature').val();
        $details = $('textarea#feature_details').val();

        $.ajax({
            url: $urlFeatureStore,
            type: "POST",
            data: {
                'app': $app,
                'feature': $feature,
                'details': $details,
                '_token': $token,
            },
            'beforeSend': function () {
                //hide alert
                $('div#feature-alert').alert('close')

                $('form#feature-add').prepend('<div id="feature-alert"></div>');
                $('div#feature-alert').empty();
                $('div#feature-alert').removeClass('alert');
                $('div#feature-alert').removeClass('alert-success');
                $('div#feature-alert').removeClass('alert-danger');

                $this.prop('disabled', true);
            },
            'success': function (response) {
                //enable button
                $this.prop('disabled', false);

                //append alert dismiss
                // $('div#feature-alert').append($alertdismiss);

                //check if status is 1
                if (response.status == 1) {
                    $('input.newdata').val('');
                    $('textarea.newdata').val('');

                    $('div#feature-alert').addClass('alert');
                    $('div#feature-alert').addClass('alert-success').html($alertdismiss + response.message);

                    //generate output
                    $output = '<blockquote>';
                    $output += '<input type="hidden" name="_fId" class="_id" value="' + response.feature.id + '">';
                    $output += '<input type="hidden" name="_feat" class="_feat" value="' + $feature + '">';
                    $output += '<input type="hidden" name="_details" class="_details" value="' + $details + '">';
                    $output += '<div class="clearfix">';
                    $output += '<strong class="pull-left feature-heading">' + $feature + '</strong>';
                    $output += '<div class="btn-group-xs pull-right">';
                    $output += '<button type="button" class="btn btn-primary btnFeatureEdit" ';
                    $output += 'data-toggle="modal" data-target="#featureEdit" title="edit feature">';
                    $output += '<span class="fa fa-edit"></span>';
                    $output += '</button>';
                    $output += '</div>';
                    $output += '</div>';
                    $output += '<footer>';
                    $output += 'Added <cite>' + response.added + '</cite>';
                    $output += '</footer>';
                    $output += '</blockquote>';

                    // $('#app-features blockquote:first').before($output);

                    $('#app-features').prepend($output);
                }
                else {
                    $('div#feature-alert').addClass('alert');
                    $('div#feature-alert').addClass('alert-danger').html($alertdismiss + response.message);
                }
            }
        });

    });

    /**
     * Update App Feature
     */
    $(document).on('click', '#btnFeatureUpdate', function () {
        $this = $(this);

        //get new values
        $id = $('input#_fid').val();
        $feature = $('input#_feature').val();
        $details = $('textarea#_details').val();

        $.ajax({
            url: $urlFeatureUpdate,
            type: "POST",
            data: {
                'id': $id,
                'feature': $feature,
                'details': $details,
                '_token': $token,
            },
            'beforeSend': function () {
                $('form#feature-edit').prepend('<div id="feature-alert"></div>');
                $('form#feature-edit div#feature-alert').empty();
                $('form#feature-edit div#feature-alert').removeClass('alert');
                $('form#feature-edit div#feature-alert').removeClass('alert-success');
                $('form#feature-edit div#feature-alert').removeClass('alert-danger');

                $this.prop('disabled', true);
            },
            'success': function (response) {
                //enable button
                $this.prop('disabled', false);

                //append alert dismiss
                // $('div#feature-alert').append($alertdismiss);

                //check if status is 1
                if (response.status == 1) {
                    $('input.newdata').val('');
                    $('textarea.newdata').val('');

                    $('form#feature-edit div#feature-alert').addClass('alert');
                    $('form#feature-edit div#feature-alert').addClass('alert-success').html($alertdismiss + response.message);

                    //assign new values
                    $('#app-features blockquote.active .feature-heading').html($feature);
                    $('#app-features blockquote.active footer cite').html(response.added);

                    $('#app-features blockquote.active input._id').val($id);
                    $('#app-features blockquote.active input._feat').val($feature);
                    $('#app-features blockquote.active input._details').val($details);

                    //hide modal
                    $('#featureEdit').modal('hide');

                    //hide alert
                    $('form#feature-edit div#feature-alert').alert('close')

                }
                else {
                    $('form#feature-edit div#feature-alert').addClass('alert');
                    $('form#feature-edit div#feature-alert').addClass('alert-danger').html($alertdismiss + response.message);
                }
            }
        });

    });

    /**
     * Update Property Feature
     */
    $(document).on('click', '#btnUpdatePropertyFeature', function () {
        $this = $(this);

        //get new values
        $id = $('input#_fid').val();
        $feature = $('input#_feature').val();
        $details = $('textarea#_details').val();
        $value = $('input#_value').val();

        $.ajax({
            url: $urlFeatureUpdate,
            type: "POST",
            data: {
                'id': $id,
                'feature': $feature,
                'details': $details,
                'value': $value,
                '_token': $token,
            },
            'beforeSend': function () {
                $('form#feature-edit').prepend('<div id="feature-alert"></div>');
                // $('form#feature-edit div#feature-alert').empty();
                // $('form#feature-edit div#feature-alert').removeClass('alert');
                // $('form#feature-edit div#feature-alert').removeClass('alert-success');
                // $('form#feature-edit div#feature-alert').removeClass('alert-danger');

                $this.prop('disabled', true);
            },
            'success': function (response) {
                //enable button
                $this.prop('disabled', false);

                //append alert dismiss
                // $('div#feature-alert').append($alertdismiss);

                //check if status is 1
                if (response.status == 1) {
                    $('input.newdata').val('');
                    $('textarea.newdata').val('');

                    $('form#feature-edit div#feature-alert').addClass('alert');
                    $('form#feature-edit div#feature-alert').addClass('alert-success').html($alertdismiss + response.message);

                    //assign new values
                    $('#features-body blockquote.active .feature-heading').html($feature);

                    $badge = '<span class="badge">' + $value + '</span>';

                    $('#features-body blockquote.active input._id').val($id);
                    $('#features-body blockquote.active input._feat').val($feature);
                    $('#features-body blockquote.active input._details').val($details);
                    $('#features-body blockquote.active strong.feature-heading span.badge').empty();
                    $('#features-body blockquote.active strong.feature-heading').append($badge);
                    $('#features-body blockquote.active p._feature_details').html($details);

                    //hide modal
                    $('#featureEdit').modal('hide');

                    //hide alert
                    $('form#feature-edit div#feature-alert').alert('close')

                }
                else {
                    $('form#feature-edit div#feature-alert').addClass('alert');
                    $('form#feature-edit div#feature-alert').addClass('alert-danger').html($alertdismiss + response.message);
                }
            }
        });

    });

    /**
     * On Group Change
     */
    $(document).on('change', 'select#group', function () {
        $this = $(this);

        //group
        $('select#property').html('<option>Select a group first</option>');

        //id
        $id = $this.val();

        $.ajax({
            method: 'POST',
            url: $urlGroupProperties,
            data: {id: $id, app: $app, _token: $token},
            dataType: 'json',
            cache: false,
            'beforeSend': function () {
                //disable select#property
                $('select#property').prop('disabled', true);
                $('select#property').html('<option>Please wait...</option>');
            },
        }).done(function (data) {
            //enable select#property
            $('select#property').prop('disabled', false);

            //reset select#property
            $('select#property').html('<option>Select a property</option>');

            //loop results
            $.each(data.properties, function (i, item) {
                $('select#property').append('<option value="' + item.id + '">' + item.title + '</option>');
            });
        }).error(function (error) {
            //flag error
            console.log(error);
            return error;
        });
    });

    /**
     * On Change Tenant Status
     */
    $(document).on('change', 'input.tenant-status', function () {

        $this = $(this);        //catch selector

        if ($this.val() == 0) {
            $('div#moveOut').slideDown();
        } else {
            $('div#moveOut').slideUp();
        }

    });

    /**
     * -------------------------------------------------------------------------
     * Rent Js And Ajax Methods
     * -------------------------------------------------------------------------
     */

    /**
     * Date Selector '.rent_from'
     */
    $(document).on('focus', 'input.rent_from', function () {
        $this = $(this);

        //remove active
        $('div.invoice.active-rent input.rent_from.active-selector').removeClass('active-selector');
        $('div.invoice.active-rent input.rent_duration.active-selector').removeClass('active-selector');
        $('div.invoice').removeClass('active-rent');

        //parent
        $this.addClass('active-selector');
        $this.parent().parent().parent().parent().addClass('active-rent');

        if ($this.parent().parent().parent().parent().hasClass('active-rent')) {
            $this.datepicker({
                'minDate': '-5Y',
                'dateFormat': 'yy-mm-dd',
            });

            $this.on('change', function () {
                //date
                $date = $this.val();

                //duration
                $duration = $('div.invoice.active-rent input.rent_duration').val();

                //field
                $field = $('div.invoice.active-rent input.rent_date_to');

                //get parsed
                $parsed = $dateGenerator($date, $duration, $field);
            });
        }
    });

    /**
     * Date Selector '.rent_due'
     */
    $(document).on('focus', 'input.rent_due', function () {
        $this = $(this);

        //remove active
        $('div.invoice.active-rent input.rent_due.active-selector').removeClass('active-selector');
        $('div.invoice').removeClass('active-rent');

        //parent
        $this.addClass('active-selector');
        $this.parent().parent().parent().parent().addClass('active-rent');

        if ($this.hasClass('active-selector')) {
            $this.datepicker({
                'minDate': '-5Y',
                'dateFormat': 'yy-mm-dd',
            });
        }
    });

    /**
     * Date Selector '.rent_duration'
     */
    $(document).on('focus', 'input.rent_duration', function () {
        $this = $(this);

        //remove active
        $('div.invoice.active-rent input.rent_from.active-selector').removeClass('active-selector');
        $('div.invoice.active-rent input.rent_duration.active-selector').removeClass('active-selector');
        $('div.invoice').removeClass('active-rent');

        //$this, $this->rent_from, parent
        $this.addClass('active-selector');
        $('div.invoice.active-rent input.rent_from').addClass('active-selector');
        $this.parent().parent().parent().parent().addClass('active-rent');

        if ($this.parent().parent().parent().parent().hasClass('active-rent')) {
            $this.on('change keydown keyup', function () {
                //date
                $date = $('div.invoice.active-rent input.rent_from').val();

                //duration
                $duration = $this.val();

                //rent
                $price = $('div.invoice.active-rent input.amount').val();

                $total = $duration * $price;

                //total
                $('div.invoice.active-rent input.rent_total').val($total);

                //field
                $field = $('div.invoice.active-rent input.rent_date_to');

                //get parsed
                $parsed = $dateGenerator($date, $duration, $field);
            });
        }
    });

    /**
     * Date Generator
     * @param $date
     * @param $duration
     * @param $field
     */
    $dateGenerator = function ($date, $duration, $field) {
        $response = $.ajax({
            method: 'POST',
            url: $urlDateGenerator,
            data: {date: $date, duration: $duration, _token: $token},
            dataType: 'json',
            cache: false,
            'beforeSend': function () {
                //disable select#property
            },
        }).done(function (data) {
            if (data.status == 1) {
                $field.val(data.date)
            }
        }).error(function (error) {
            //flag error
            console.log(error);
            return error;
        });
    };

    /**
     * On Rent Group Change
     */
    $(document).on('change', 'select#rent_group', function () {
        $this = $(this);

        $this.parent().parent().parent().parent().addClass('active-rent');

        //group
        $('select#property').html('<option>Select a group first</option>');

        //id
        $id = $this.val();

        $.ajax({
            method: 'POST',
            url: $urlGroupRentProperties,
            data: {id: $id, app: $app, _token: $token},
            dataType: 'json',
            cache: false,
            'beforeSend': function () {
                //disable select#property
                $('select#property').prop('disabled', true);
                $('select#property').html('<option>Please wait...</option>');
            },
        }).done(function (data) {
            //enable select#property
            $('select#property').prop('disabled', false);

            //reset select#property
            $('select#property').html('<option>Select a property</option>');

            //loop results
            $.each(data.properties, function (i, item) {
                $('select#property').append('<option value="' + item.id + '">' + item.title + '</option>');
            });
        }).error(function (error) {
            //flag error
            console.log(error);
            return error;
        });
    });

    /**
     * On Rent Property Change
     */
    $(document).on('change', 'select#property', function () {
        $this = $(this);

        $this.parent().parent().parent().parent().addClass('active-rent');

        //id
        $id = $this.val();

        $.ajax({
            method: 'POST',
            url: $urlRentProperty,
            data: {id: $id, app: $app, _token: $token},
            dataType: 'json',
            cache: false,
            'beforeSend': function () {
                //disable select#rent_property
                $this.prop('disabled', true);
            },
        }).done(function (data) {
            //enable select#rent_property
            $this.prop('disabled', false);

            //price
            $price = data.property.price;

            //rent
            $('div.active-rent input#amount').val($price);

            //duration
            $duration = $('div.active-rent input.rent-duration').val();

            $total = $duration * $price;

            //total
            $('div.active-rent input.rent_total').val($total);

        }).error(function (error) {
            //flag error
            console.log(error);
            return error;
        });
    });

    /**
     * -------------------------------------------------------------------------
     * Billing Invoice Methods
     * -------------------------------------------------------------------------
     */

    /**
     * Date Selector '.rent_from'
     */
    $(document).on('focus', 'input.bill_from', function () {
        $this = $(this);

        //remove active
        $('div.invoice.active-bill input.bill_from.active-selector').removeClass('active-selector');
        $('div.invoice.active-bill input.bill_duration.active-selector').removeClass('active-selector');
        $('div.invoice').removeClass('active-bill');

        //pabill
        $this.addClass('active-selector');
        $this.parent().parent().parent().parent().addClass('active-bill');

        if ($this.parent().parent().parent().parent().hasClass('active-bill')) {
            $this.datepicker({
                'minDate': '-5Y',
                'dateFormat': 'yy-mm-dd',
            });

            $this.on('change', function () {
                //date
                $date = $this.val();

                //duration
                $duration = $('div.invoice.active-bill input.bill_duration').val();

                //field
                $field = $('div.invoice.active-bill input.bill_date_to');

                //get parsed
                $parsed = $dateGenerator($date, $duration, $field);
            });
        }
    });

    /**
     * Bill Unit '.previous_reading'
     */
    $(document).on('focus change keydown keyup keypress', 'input.previous_reading', function () {
        $this = $(this);

        //remove active
        $('div.invoice.active-bill input.bill_from.active-selector').removeClass('active-selector');
        $('div.invoice.active-bill input.bill_duration.active-selector').removeClass('active-selector');
        $('div.invoice').removeClass('active-bill');

        //$this, $this->previous_reading, parent
        $this.addClass('active-selector');
        $('div.invoice.active-bill input.previous_reading').addClass('active-selector');
        $this.parent().parent().parent().parent().parent().addClass('active-bill');

        if ($this.parent().parent().parent().parent().parent().hasClass('active-bill')) {
            //current
            $current = $('div.invoice.active-bill input.current_reading').val();

            //previous
            $previous = $this.val();

            //units
            $units = ($current - $previous);

            //rent
            $price = $('div.invoice.active-bill input.amount').val();

            $total = $units * $price;

            //total
            $('div.invoice.active-bill input.bill_total').val($total);

        }
    });

    /**
     * Bill Unit '.current_reading'
     */
    $(document).on('focus change keydown keyup keypress', 'input.current_reading', function () {
        $this = $(this);

        //remove active
        $('div.invoice.active-bill input.bill_from.active-selector').removeClass('active-selector');
        $('div.invoice.active-bill input.bill_duration.active-selector').removeClass('active-selector');
        $('div.invoice').removeClass('active-bill');

        //$this, $this->previous_reading, parent
        $this.addClass('active-selector');
        $('div.invoice.active-bill input.current_reading').addClass('active-selector');
        $this.parent().parent().parent().parent().parent().addClass('active-bill');

        if ($this.parent().parent().parent().parent().parent().hasClass('active-bill')) {
            //previous
            $previous = $('div.invoice.active-bill input.previous_reading').val();

            //current
            $current = $this.val();

            //units
            $units = ($current - $previous);

            //rent
            $price = $('div.invoice.active-bill input.amount').val();

            $total = $units * $price;

            //total
            $('div.invoice.active-bill input.bill_total').val($total);

        }
    });

    /**
     * Group property selector
     * .check-group
     * .check-group-{group-id}
     */
    $(document).on('change', '.check-group', function () {
        $this = $(this);

        //get group id
        $id = $this.attr('id');

        //toggle class 'active'
        $this.toggleClass('active');

        //check if check
        if ($this.hasClass('active'))
            $('.check-group-' + $id).prop('checked', true);
        else
            $('.check-group-' + $id).prop('checked', false);
    });

    /**
     * ------------------------------------------------------------------------------
     * Sunbscription methods
     * ------------------------------------------------------------------------------
     */
    //plan details
    $(document).on('click', '#btnSubsCalculate', function () {
        var $id;

        $this = $(this);

        //properties
        $props = $('input#plan-properties').val();

        if ($props > 0) {

            //message
            $this.parent().next('span.help-block').html('Please wait...loading');

            //hide all and remove active class
            // $('div#planDetails .plan-wrapper').slideUp();
            // $('div#planDetails .plan-wrapper').removeClass('active');

            //filter
            /*$('input[name=_properties]').filter(function () {
             if ($props <= $(this).attr('min') && $(this).attr('max') >= $props) {

             //min
             $min = $(this).attr('min');

             //max
             $max = $(this).attr('max');

             console.log('min: ' + $min + ' max: ' + $max + ' props: ' + $props);

             //assign active class
             $(this).parent().addClass('active');

             //get plan id
             $id = $(this).val();

             //assign plan id
             $('input#plan').val($id);

             //calculate total
             //price
             $price = $('.plan-wrapper.active input.price').val();

             //total
             $total = ($price * $props);

             //assign total
             $('.plan-wrapper.active span.amount').html($total);

             //clear
             $this.parent().next('span.help-block').empty();

             //slide down plan wrapper
             $('div#' + $('input#plan').val()).slideDown();
             }
             });*/

            setTimeout(function () {
                $.ajax({
                    method: 'POST',
                    url: $planUrl,
                    data: {properties: $props, _token: $token},
                    dataType: 'json',
                    cache: false,
                    'beforeSend': function () {
                        //disable input
                        $('input#plan-properties').prop('disabled', true);

                        $('#btnSubscribe').prop('disabled', true);

                        $this.prop('disabled', true);

                        $('div#amount-wrapper').slideUp();
                    },
                }).done(function (data) {
                    if (data.status == 1) {
                        //assign plan id
                        $plan = data.plan.id;

                        $('input#plan').val($plan);

                        $('#btnSubscribe').prop('disabled', false);

                        //calculate total
                        //price
                        $price = data.plan.price;

                        //total
                        // $total = ($price * $props);
                        $total = data.totalAmount;

                        //assign values
                        $('#plan-wrapper input#price').val($price);

                        $('#plan-wrapper .heading').html(data.plan.title);
                        $('#plan-wrapper .summary').html(data.plan.summary);
                        $('#plan-wrapper span.minimum').html(data.plan.minimum);
                        $('#plan-wrapper span.limit').html(data.plan.limit);

                        //slide down plan wrapper
                        $('#amount-wrapper input.price').val(data.plan.price);
                        $('#amount-wrapper input.duration').val(data.plan.duration_type);
                        $('#amount-wrapper .amount').html($total);
                        $('#amount-wrapper .duration').html(data.plan.duration_type);
                        $('div#amount-wrapper').slideDown();

                        //clear
                        $this.parent().next('span.help-block').addClass('text-info').html('You can now proceed to payment');
                    } else {
                        $this.parent().next('span.help-block').html(data.message);
                        $('div#amount-wrapper').slideUp();
                    }

                }).error(function (error) {
                    //flag error
                    console.log(error);
                    return error;
                });

                //enable
                $this.prop('disabled', false);
                $('input#plan-properties').prop('disabled', false);

            }, 500);
        }
    });

    /**
     * General Methods
     */
    //Bulk Select
    $(document).on('change', '.select-box-all', function () {
        //get selector
        $this = $(this);

        //toggle active
        $this.toggleClass('active');

        //check if $this checked
        if ($this.hasClass('active'))
            $('.select-box').prop('checked', true).addClass('active');
        else
            $('.select-box').prop('checked', false).removeClass('active');
    });

    //Bulk Delete
    // $(document).on('click', '#btnBulkDelete', function(e) {
    //    //get selector
    //     $this = $(this);
    //
    //     //get selected records
    //     $_id = $('.select-box.active').attr('id');
    //
    //     //send request
    //     $.ajax({
    //         method: 'GET',
    //         url: $this.attr('href'),
    //         data: {id: $_id, app: $app, _token: $token},
    //         dataType: 'json',
    //         cache: false,
    //         'beforeSend': function () {
    //         },
    //     }).done(function (data) {
    //         //
    //     }).error(function (error) {
    //         //flag error
    //         console.log(error);
    //         return error;
    //     });
    //
    //     e.preventDefault();
    // });
});