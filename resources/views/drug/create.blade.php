@extends('layouts.master')

@section('title')
    {{ __('sentence.Add Drug') }}
@endsection

@section('content')

    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>
    {{-- Upload product.csv Open --}}
    <div class="row">
        <div class="col">
            <div class="alert alert-warning">
                Il est important de savoir que vous devez utiliser des produits provenant de l'application de gestion des
                stocks pour créer un nouveau soin. Vous pouvez
                <br>
                <a href="#" id="importCSVLink" data-toggle="modal" data-target="#importCSVModal"><b>Importez le fichier
                        "product.csv"</b></a> pour commencer.
                <br><b>Note:</b> ce fichier se télécharge sur la liste des produits de l'application de gestion de stock.
            </div>
        </div>
    </div>

    <!-- Modal for CSV Import -->
    <div class="modal fade" id="importCSVModal" tabindex="-1" role="dialog" aria-labelledby="importCSVModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header btn-success">
                    <h5 class="modal-title " id="importCSVModalLabel">Importer la dernière version <b>"product.csv"</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data" action="{{ route('process.csv') }}">
                    @csrf
                    <div class="modal-body">
                        <!-- Input field for CSV file upload -->
                        <div class="form-group">
                            <label for="csvFile">Sélectionner le fichier CSV :</label>
                            <input type="file" name="csvFile" id="csvFile" accept=".csv">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary" id="importCSVButton">Importer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Upload product.csv End --}}

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Add Drug') }}</h6>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('drug.store') }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('sentence.Trade Name') }} <font color="red">*</font>
                            </label>
                            <input type="text" class="form-control" name="trade_name" id="TradeName"
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
                        <button type="submit" class="btn btn-success">{{ __('sentence.Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Display Products using csv data Section --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.Product list') }}</h6>
                </div>
                <div class="col-3">
                    <a href="http://192.168.1.176:3000/product" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i>
                        {{ __('sentence.Add a product') }}</a>
                </div>
                <div class="col-3">
                    <a href="#" class="btn btn-primary btn-sm float-right" id="importCSVLink" data-toggle="modal"
                        data-target="#importCSVModal">
                        <i class="fa fa-edit"></i>
                        {{ __('sentence.update product list') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th class="sortable" data-col="id">ID
                                <i class="fas fa-sort-up sortable-icon"></i>
                                <i class="fas fa-sort-down sortable-icon"></i>
                            </th>
                            <th class="sortable" data-col="sku">SKU
                                <i class="fas fa-sort-up sortable-icon"></i>
                                <i class="fas fa-sort-down sortable-icon"></i>
                            </th>
                            <th class="sortable" data-col="name">Name
                                <i class="fas fa-sort-up sortable-icon"></i>
                                <i class="fas fa-sort-down sortable-icon"></i>
                            </th>
                            <th class="sortable" data-col="product_category">Product Category
                                <i class="fas fa-sort-up sortable-icon"></i>
                                <i class="fas fa-sort-down sortable-icon"></i>
                            </th>
                            <th class="sortable" data-col="updated_at">Updated At
                                <i class="fas fa-sort-up sortable-icon"></i>
                                <i class="fas fa-sort-down sortable-icon"></i>
                            </th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($products) > 0)
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product['id'] }}</td>
                                    <td>{{ $product['sku'] }}</td>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['product_category'] }}</td>
                                    <td>{{ $product['updated_at'] }}</td>
                                    <td>
                                        @if (!empty($product['imageUrl']))
                                            <img src="{{ $product['imageUrl'] }}" alt="Unable to reach backend"
                                                style="max-width: 50px; max-height: 50px">
                                        @else
                                            "Le produit n'a pas d'image"
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">No data available.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- End Display Products Section --}}
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
    <script>
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
    </script>
@endsection
