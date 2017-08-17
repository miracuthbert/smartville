@extends('layouts.company.master')

@section('title')
    {{ $company->title }} | Profile
@endsection

@section('content')

    <div class="section-pad"></div>

    <div class="row">
        <div class="col-md-12">
            <nav id="breadcrumb">
                <ul class="breadcrumb">
                    <li>{{ config('app.name') }}</li>
                    <li>Company</li>
                    <li class="active">Profile</li>
                </ul>
            </nav><!-- /#breadcrumb -->
        </div><!-- / .col-md-12 -->
    </div><!-- / .row -->

    @include('company.partials._menu')

    <div class="row">
        <div class="col-md-12">
                <form method="post" action="{{ route('company.update') }}"
                      enctype="application/x-www-form-urlencoded" autocomplete="off">

                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                    <input type="hidden" name="id" id="_app" value="{{ $company->id }}">

                    <input type="hidden" name="_role" id="_role" value="3">

                    <p class="help-block">
                        Fields with an asterisk (<span class="text-danger">*</span>) are required.
                    </p>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('company') ? 'has-error' : '' }}">
                                <label for="company">Company name: <span class="text-danger">*</span></label>
                                <input type="text" name="company" class="form-control" id="company"
                                       value="{{ $company->title }}" required
                                       autofocus>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('country') ? 'has-error' : '' }}">
                                <label for="name">Country: <span class="text-danger">*</span></label>
                                <select name="country" class="form-control" id="country" required>
                                    <option>Pick a country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country }}" {{ $company->country == $country ? 'selected' : '' }}>
                                            {{ $country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('city') ? 'has-error' : '' }}">
                                <label for="name">City:</label>
                                <input type="text" name="city" class="form-control" id="city"
                                       value="{{ $company->city }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('zipcode') ? 'has-error' : '' }}">
                                <label for="name">Zipcode:</label>
                                <input type="text" name="zipcode" class="form-control" id="zipcode"
                                       value="{{ $company->zipcode }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('state') ? 'has-error' : '' }}">
                                <label for="state">State:</label>
                                <input type="text" name="state" class="form-control" id="state"
                                       value="{{ $company->state }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="address">Street (or address):</label>
                                <input type="text" name="address" class="form-control" id="address"
                                       value="{{ $company->address }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('phone') ? 'has-error' : '' }}">
                                <label for="phone">Phone: <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                       value="{{ $company->phone }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">Email: <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" id="email"
                                       value="{{ $company->email }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="clearfix">
                                    <label>Status:
                                        <span class="text-danger">*</span>
                                    </label>
                                </div>

                                <label class="radio-inline">
                                    <input type="radio" name="status" id="disabled"
                                           value="0" {{ $company->status == 0 ? 'checked' : '' }}>Disabled
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" id="active"
                                           value="1" {{ $company->status == 1 ? 'checked' : '' }}>Active
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p class="help-block">
                                    View
                                    <a href="#" title="terms of use" class="btn btn-link btn-xs">
                                        Terms of use
                                    </a>
                                    and
                                    <a href="#" title="privacy policy" class="btn btn-link btn-xs">
                                        Privacy policy
                                    </a>
                                    of this site.
                                    <span class="text-danger">*</span>
                                </p>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg" id="btnUpdateApp">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form><!-- / form -->
        </div><!-- / .col-md-12 -->
    </div><!-- / .row -->

    <div class="section-pad"></div>

@endsection