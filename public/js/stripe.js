Stripe.setPublishableKey('pk_test_Alx02GeaSWrvThSjGo03Ulbk');

//form
var $form = $('form#stripeSubscription');
var $submit = $form.find('button');
var $submitInitialText = $submit.text();

$form.submit(function (event) {
    //hide error alert
    $('#charge-error').addClass('hidden');

    //disable submit button
    $submit.prop('disabled', true).text('Just a moment...');

    Stripe.card.createToken({
        number: $('#card-number').val(),
        cvc: $('#card-cvc').val(),
        exp_month: $('#card-expiry-month').val(),
        exp_year: $('#card-expiry-year').val(),
        name: $('#card-name').val(),
    }, stripeResponseHandler);
    return false;
});

function stripeResponseHandler(status, response) {
    if (response.error) {
        //show error
        $('#charge-error').removeClass('hidden');
        $('#charge-error').text('response.error.message');

        //enable submit button
        $submit.prop('disabled', false).text($submitInitialText);
    } else { //token created

        //get token id
        var token = response.id;
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));

        //submit the form
        $form.get(0).submit();
    }
}