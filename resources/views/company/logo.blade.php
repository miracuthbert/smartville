@extends('layouts.company.master')

@section('title')
    {{$company->title }} | Change Logo
@endsection

@section('content')

    <div class="section-pad"></div>

    <div class="row">
        <div class="col-md-12">
            <nav id="breadcrumb">
                <ul class="breadcrumb">
                    <li>{{ config('app.name') }}</li>
                    <li>Company</li>
                    <li>Profile</li>
                    <li class="active">Logo</li>
                </ul>
            </nav><!-- / #breadcrumb -->
        </div><!-- / .col-md-12 -->
    </div><!-- / .row -->

    @include('company.partials._menu')

    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('company.logo.store') }}"
                  enctype="multipart/form-data" id="profileImageForm" autocomplete="off">

                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                <input type="hidden" name="_company" id="_company" value="{{ $company->id }}">

                <input type="hidden" name="_role" id="_role" value="3">

                <input type="hidden" name="type" value="profile">

                <input type="hidden" name="data-alt" value="{{ $company->id }} profile image">

                <div class="section-pad">
                    <label for="profile-image" class="control-label">Choose a photo to upload</label>
                    <div class="form-group input-group">
                        <input type="file" name="image" class="form-control"
                               id="profile-image" required>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary">
                                Upload
                                <i class="fa fa-upload"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form><!-- / #profileImageForm -->
        </div><!-- / .col-md-12 -->
    </div><!-- / .row -->

    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-image"></i> Company Logos</h3>
            <p class="text-muted">Logos you upload will appear here.</p>
            <hr>

            <div class="row">
                @if(count($avatars) > 0)
                    @foreach($avatars as $avatar)
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <div class="thumbnail">
                                <img src="{{ url($avatar->data['url']) }}" alt="{{ $avatar->data['alt'] }}"/>
                                <div class="caption">
                                    <p class="tags">
                                        <strong>Tags:</strong> {{ $avatar->data['tag'] }}
                                    </p>
                                    <p class="dates">
                                        <strong>Added:</strong> {{ $avatar->created_at->diffForHumans() }}
                                    </p>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('company.logo.change', ['id' =>$avatar->id]) }}" role="button"
                                           class="btn btn-primary {{ $avatar->status == 1 ? 'disabled' : '' }}">
                                            <i class="fa fa-upload"></i> Set as logo
                                        </a>
                                        <a href="{{ route('company.logo.delete', ['id' =>$avatar->id]) }}" role="button"
                                           class="btn btn-danger {{ $avatar->status == 1 ? 'disabled' : '' }}">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <p class="text-muted">You have no logos uploaded yet.</p>
                    </div>
                @endif
            </div><!-- / .row -->
        </div><!-- /.col-lg-12 -->
    </div><!-- / .row -->

@endsection