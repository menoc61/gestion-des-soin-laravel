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
                            <label for="exampleInputEmail1">{{ __('sentence.Trade Name') }}<font color="red">*</font>
                            </label>
                            <input type="hidden" value="{{ $drug->id }}" name="drug_id">
                            <input type="text" class="form-control" value="{{ $drug->trade_name }}" name="trade_name" id="TradeName"
                                aria-describedby="TradeName">
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
                            <label for="exampleInputPassword1">{{ __('sentence.Note') }}</label>
                            <input type="text" class="form-control" name="note" id="Note"
                                placeholder="Description...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{ __('sentence.Amount') }}</label>
                            <input type="text" class="form-control" name="amountDrug"
                                placeholder="Montant...">
                        </div>
                        <button type="submit" class="btn btn-success">{{ __('sentence.Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <style>
        .sortable-icon {
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-multiselect.css') }}">
    <script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
        $('#GenericName').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            filterPlaceholder: 'Recherche un Hôte...',
            buttonContainer: '<div class="btn-group w-100" />'
        });
    </script>
    {{-- <script>
        // JavaScript to handle sorting
        $(document).ready(function() {
            $(".sortable-icon").click(function() {
                // Get the index of the clicked th within its parent tr
                const column = $(this).closest('th').index();
                const order = $(this).hasClass('fa-sort-up') ? 1 : -1;

                const sortedRows = [...document.querySelectorAll('tbody tr')];
                sortedRows.sort((a, b) => {
                    const aValue = a.querySelectorAll('td')[column].textContent.trim();
                    const bValue = b.querySelectorAll('td')[column].textContent.trim();
                    return order * (aValue.localeCompare(bValue));
                });

                const tableBody = document.querySelector('tbody');
                tableBody.innerHTML = '';
                sortedRows.forEach(row => tableBody.appendChild(row));
            });
        });
    </script> --}}
@endsection
