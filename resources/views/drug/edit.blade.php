@extends('layouts.master')

@section('title')
    {{ __('sentence.Edit Drug') }}
@endsection

@section('content')
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Edit Drug') }} "{{ $drug->trade_name }}"
                    </h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('drug.store_edit') }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trade Name *</label>
                            <input type="text" class="form-control" name="trade_name" id="TradeName"
                                aria-describedby="TradeName" value="{{ $drug->trade_name }}">
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{ __('sentence.Generic Name') }}<font color="red">*
                                </font></label>
                            <select name="generic_name[]" multiple id="GenericName" class="form-control">
                                @foreach ($products as $product)
                                    <option value="{{ $product['name'] }}">{{ $product['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Note</label>
                            <input type="text" class="form-control" name="note" id="Note"
                                placeholder="aucun description...">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('sentence.Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript"
        src="https://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
        $('#GenericName').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            filterPlaceholder: 'Recherche un Hôte...',
            buttonContainer: '<div class="btn-group w-100" />'
        });
    </script>
@endsection
