@extends('layouts.master')

@section('title')
{{ __('sentence.Edit User') }}
@endsection

@section('content')


    <div class="row justify-content-center">
                  
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Edit User') }}</h6>
                </div>
                <div class="card-body">
                 <form method="post" action="{{ route('user.store_edit') }}">
                    <div class="form-group row">
                      <label for="Name" class="col-sm-3 col-form-label">{{ __('sentence.Full Name') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="Name" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        {{ csrf_field() }}
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Email" class="col-sm-3 col-form-label">{{ __('sentence.Email Adress') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" id="Email" name="email" value="{{ $user->email }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="Password" class="col-sm-3 col-form-label">{{ __('sentence.Password') }}</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="Password" name="password">
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="Phone" class="col-sm-3 col-form-label">{{ __('sentence.Phone') }}</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="Phone" name="phone" value="{{ @$user->Patient->phone }}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Gender" class="col-sm-3 col-form-label">{{ __('sentence.Gender') }}</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="gender" id="Gender">
                          <option value="{{ @$user->Patient->gender }}" selected="selected">{{ @$user->Patient->gender }}</option>
                          <option value="Male">{{ __('sentence.Male') }}</option>
                          <option value="Female">{{ __('sentence.Female') }}</option>
                        </select>
                      </div>
                    </div>
       
                    <div class="form-group row">
                      <label for="role" class="col-sm-3 col-form-label">{{ __('sentence.Role') }}</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="role" id="role">
                                            <option value="">{{ __('sentence.Select Role') }}</option>
                                            @forelse($roles as $role)
                                              <option value="{{ $role }}" @if($role ==  @$user->getRoleNames()[0]) selected @endif>{{ ucfirst($role) }}</option>
                                            @empty

                                            @endforelse
                          </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary">{{ __('sentence.Save') }}</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            
        </div>

    </div>

@endsection

@section('header')

@endsection

@section('footer')

@endsection
