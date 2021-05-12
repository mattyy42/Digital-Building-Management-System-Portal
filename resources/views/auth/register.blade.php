@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fname">First Name:</label>
                        <div class="col-sm-10">          
                           <input type="text" class="form-control" id="first_name" placeholder="Enter Name" name="first_name">
                           <span class="text-danger">{{ $errors->first('first_name') }}</span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-sm-2" for="last_name">Last Name:</label>
                        <div class="col-sm-10">          
                           <input type="text" class="form-control" id="last_name" placeholder="Enter Name" name="last_name">
                           <span class="text-danger">{{ $errors->first('last_name') }}</span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-sm-3" for="fname">Phone Number:</label>
                        <div class="col-sm-10">          
                           <input type="text" class="form-control" id="phone_number" placeholder="phone number" name="phone_number">
                           <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                        </div>
                     </div>
                     <div class="form-group">
                     <label for="email" class="control-label col-sm-3">{{ __('E-Mail Address') }}</label><div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                     </div>
                    
                    <div class="form-group">
                            <label for="password" class="control-label col-sm-3">{{ __('Password') }}</label>

                            <div class="col-sm-10">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="password-confirm" class="control-label col-sm-3">{{ __('Confirm Password') }}</label>

                            <div class="col-md-10">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
