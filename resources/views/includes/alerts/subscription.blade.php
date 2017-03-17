@if(!$app->subscribed)
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="clearfix">
            You have no active subscription.
            <a href="{{ route('estate.subscription.add', ['id' => $app->id]) }}" class="alert-link">Subscribe now!</a>
            to access more features.
        </div>
    </div>
@endif