@extends('layouts.master')

@section('title')
{{ __('sentence.Create role') }}
@endsection

@section('content')


    <div class="row justify-content-center">                  

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Create role') }}</h6>
                </div>
                <div class="card-body">
                 <form method="post" action="{{ route('role.store') }}">
                    <div class="form-group row">
                      <label for="Name" class="col-sm-3 col-form-label">{{ __('sentence.Name') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="Name" name="name" >
                        <input type="hidden" class="form-control" name="role_id">
                        {{ csrf_field() }}
                      </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                      <label for="Email" class="col-sm-3 col-form-label">{{ __('sentence.Permissions') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <select id="example-multiple-selected" multiple="multiple" name="permissions[]">
                          @forelse($permissions as $permission)
                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
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
<link rel="stylesheet" type="text/css" href="https://davidstutz.github.io/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">
@endsection

@section('footer')
<script type="text/javascript" src="https://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
<!-- Initialize the plugin: -->
<script type="text/javascript">
    $('#example-multiple-selected').multiselect();
</script>
@endsection
