@if($app->company->avatar != null)
    <img src="{{ url($app->company->avatar->data['thumbUrl']) }}" alt="{{ $app->company->avatar->data['alt'] }}">
@else
    {{ $app->company->title }}
@endif
