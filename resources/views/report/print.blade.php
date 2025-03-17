<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport d'Activité</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body> -->
@extends('layouts.master')

@section('title')
    {{ __('sentence.View Report') }}
@endsection

@section('content')
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        @can('print invoice')
            <button href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm print_prescription"><i
                    class="fas fa-print fa-sm text-white-50"></i> Imprimer</button>
        @endcan
    </div>

    <div class="row justify-content-center" id="stylesheetd">
        <div class="col-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <!-- ROW : Doctor informations -->
                    <div class="col-md-12">
                        <center>
                            <div class="col-md-12">
                           
                            
                                <div class="d-flex w-25 justify-content-center align-items-center">
                                    <img src="{{ asset('img/sai-i-lama-logo.png') }}" width="100">
                                </div>
                            
                           
                            </div>
                        </center>
                        <div class="">
                            <div class="text-center">
                                
                                <b>{{ App\Setting::get_option('system_name') }}</b><br>
                                <b>{{ App\Setting::get_option('address') }}</b><br>
                                <b>{{ App\Setting::get_option('phone') }}</b><br>
                                <b>{{ App\Setting::get_option('hospital_email') }}</b>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="border-top bg-success">

                    </div> --}}

                    <div class="card mt-4">
                        <div class="card-body badge-primary-soft text-center">
                            <h3 class="text-dark">RAPPORT D'ACTIVITE  DU {{ $activityReport->created_at->format('Y-m-d') }} </h3>
                        </div>
                    </div>

                    <div class="col-12 border-top">
                        <p class="mt-4">
                            <h6><b>{{ __('sentence.Date') }} :</b> {{ $activityReport->created_at->format('d M Y H:i') }}<h6>
                            <b>{{ __('sentence.Full Name praticien') }} :</b> {{ $activityReport->doctor->name }}
                        </p>
                    </div>
        
      <div class="row justify-content-center">
          <div class="col">
              <br><br>   
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" style="border-color:rgb(3, 3, 3);">
                   <tr >
                        <td align="center">Noms de l'hôte </td>
                        <td>Soins effectué(s) - Montants</td>
                        <td>Montant Total</td>
                        <td align="center">Prochain Rendez-vous</td>
                        <td>Observation</td>
                        <td>Pourboires</td>
                    </tr>

                   <tr>
                            <td>{{ $activityReport->User->name ?? 'N/A' }}</td>
                            <td class="m-0 font-weight-bold text-primary">
                                   <ul>
                                      @foreach($activityReport->drugs as $drug)
                                        <li>{{ $drug->trade_name }} - {{ $drug->pivot->amountDrug }} FCFA</li>
                                      @endforeach
                                   </ul>
                            </td>
                            <td>{{ $activityReport->drugs->sum('pivot.amountDrug') }}</td>
                            <td width="30%" align="center" class="m-0 font-weight-bold text-primary">
                                    {{ $activityReport->next_rdv }}
                            </td>
                            <td>{{ $activityReport->observation }}</td>
                            <td>{{ $activityReport->pourboire }} FCFA</td>
                    </tr>
                
                  <!-- <p><strong>Patient :</strong> rr</p>
                  <p><strong>Date du prochain RDV :</strong> {{ $activityReport->next_rdv }}</p>
                  <p><strong>Observation :</strong> {{ $activityReport->observation }}</p>
                  <p><strong>Pourboire :</strong> {{ $activityReport->pourboire }} FCFA</p>

                      <h4>Médicaments</h4>
                  <ul>
                       @foreach($activityReport->drugs as $drug)
                          <li>{{ $drug->trade_name }} - {{ $drug->pivot->amountDrug }} FCFA</li>
                       @endforeach
                  </ul> -->
                </table>
             </div>
             <div class="col-12 border-top">
                        <p class="mt-4">
                            <h6><b>Nb :</b> tous les soins effectués doivent être soumis à l'appréciation de l'hôte qui doit apposer sa
                            signature afin d'approuver le montant desdits soins.<h6>
                            
                        </p>
             </div>

        
             <div style="margin-top: 50px; text-align: center;">
                   <div style="display: flex; justify-content: space-between;">
                      <div class="text-underline"><b>Signature de l'hôte</b></div>
                      <div class="text-underline"><b>Signature du praticien</b></div>
                      <div class="text-underline"><b>Visa de la direction</b></div>
                   </div>
             </div>
                        <!-- <button class="btn btn-primary no-print" onclick="window.print()">Imprimer</button> -->
            </div>
      </div>
      <div style="margin-bottom: 250px;"></div>

              <!-- END ROW : Drugs List -->
              <!-- ROW : Footer informations -->
            <div class="row">
              <div class="col">
                  <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
               </div>
               <div class="col">
                  <p class="float-right font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
               </div>
           </div>               
 </div>
    </div>
    </div>
    
</div>

<div id="print_area" style="display: none;" class="print_area">
        <div class="col-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <!-- ROW : Doctor informations -->
                    <div class="col-md-12">
                       <center>
                            <div class="col-md-12">
                           
                            
                                <div class="d-flex w-25 justify-content-center align-items-center">
                                    <img src="{{ asset('img/sai-i-lama-logo.png') }}" width="100">
                                </div>
                            
                           
                            </div>
                        </center>
                        <div class="">
                            <div class="text-center">
                                
                                <b>{{ App\Setting::get_option('system_name') }}</b><br>
                                <b>{{ App\Setting::get_option('address') }}</b><br>
                                <b>{{ App\Setting::get_option('phone') }}</b><br>
                                <b>{{ App\Setting::get_option('hospital_email') }}</b>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="border-top bg-success">

                    </div> --}}

                    <div class="card mt-4">
                        <div class="card-body badge-primary-soft text-center">
                            <h3 class="text-dark">RAPPORT D'ACTIVITE  DU {{ $activityReport->created_at->format('Y-m-d') }} </h3>
                        </div>
                    </div>

                    <div class="col-12 border-top">
                        <p class="mt-4">
                            <h6><b>{{ __('sentence.Date') }} :</b> {{ $activityReport->created_at->format('d M Y H:i') }}<h6>
                            <b>{{ __('sentence.Full Name praticien') }} :</b> {{ $activityReport->doctor->name }}
                        </p>
                    </div>
        
      <div class="row justify-content-center">
          <div class="col">
              <br><br>   
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" style="border-color:rgb(3, 3, 3);">
                   <tr >
                        <td align="center">Noms de l'hôte</td>
                        <td align="center">Soins effectué(s) - Montants</td>
                        <td>Montant Total</td>
                        <td align="center">Prochain Rendez-vous</td>
                        <td>Observation</td>
                        <td>Pourboires</td>
                    </tr>

                   <tr> 
                        
                            <td align="center">
                              @if($activityReport->User)
                                  {{ $activityReport->User->name }}
                              @else
                                   <span class="text-muted">N/A</span>
                              @endif
                                
                            </td>
                       
                            <td class="m-0 font-weight-bold text-primary">
                                   <ul>
                                      @foreach($activityReport->drugs as $drug)
                                        <li>{{ $drug->trade_name }} - {{ $drug->pivot->amountDrug }} FCFA</li>
                                      @endforeach
                                   </ul>
                            </td>
                            <td>{{ $activityReport->drugs->sum('pivot.amountDrug') }}</td>
                            <td width="30%" align="center" class="m-0 font-weight-bold text-primary">
                                    {{ $activityReport->next_rdv }}
                            </td>
                            <td>{{ $activityReport->observation }}</td>
                            <td>{{ $activityReport->pourboire }} FCFA</td>
                    </tr>
                
                  <!-- <p><strong>Patient :</strong> rr</p>
                  <p><strong>Date du prochain RDV :</strong> {{ $activityReport->next_rdv }}</p>
                  <p><strong>Observation :</strong> {{ $activityReport->observation }}</p>
                  <p><strong>Pourboire :</strong> {{ $activityReport->pourboire }} FCFA</p>

                      <h4>Médicaments</h4>
                  <ul>
                       @foreach($activityReport->drugs as $drug)
                          <li>{{ $drug->trade_name }} - {{ $drug->pivot->amountDrug }} FCFA</li>
                       @endforeach
                  </ul> -->
                </table>
             </div>
             <div class="col-12 border-top">
                        <p class="mt-4">
                            <h6><b>Nb :</b> tous les soins effectués doivent être soumis à l'appréciation de l'hôte qui doit apposer sa
                            signature afin d'approuver le montant desdits soins.<h6>
                            
                        </p>
             </div>

        
             <div style="margin-top: 50px; text-align: center;">
                   <div style="display: flex; justify-content: space-between;">
                      <div class="text-underline"><b>Signature de l'hôte</b></div>
                      <div class="text-underline"><b>Signature du praticien</b></div>
                      <div class="text-underline"><b>Visa de la direction</b></div>
                   </div>
             </div>

                        <!-- <button class="btn btn-primary no-print" onclick="window.print()">Imprimer</button> -->
            </div>
      </div>
      <div style="margin-bottom: 250px;"></div>

              <!-- END ROW : Drugs List -->
              <!-- ROW : Footer informations -->
            <div class="row">
              <div class="col">
                  <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
               </div>
               <div class="col">
                  <p class="float-right font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
               </div>
           </div>               
 </div>
    </div>
    </div>
    
</div>
@endsection

@section('header')
<link href="{{ asset('css/print.css') }}" rel="stylesheet" media="all">

<style type="text/css">
p,
u,
li {
    color: #444444 !important;
}
.text-underline{
    text-decoration: underline;
}

@media print {
    body {
        margin: 0;
        padding: 0;
    }

    #print_area {
        width: 100%; /* Largeur A4 */
        height: 100vh; /* Hauteur A4 */
        padding: 20mm; /* Marges internes */
        box-sizing: border-box; /* Inclut le padding dans les dimensions */
        background: white; /* Fond blanc pour l'impression */
        page-break-before: always; /* Commencer sur une nouvelle page */
    }

    .table-bordered {
        width: 100%; /* Table pleine largeur */
        border: 1px solid #333;
    }

    .table{
        width:100%;
        border: 1px solid #333;
    }

    .table-bordered td, .table-bordered th {
        font-size: 12px; /* Réduire la taille des caractères si nécessaire */
        padding: 5px; /* Ajuster l'espacement */
        border: 1px solid #333;
    }

    .no-print {
        display: none;
    }

    .card {
        border: none;
        width: 1000px;
        height:25vh;
    }

    @page {
        size: A4; /* Définit le format de la page */
        margin: 0; /* Retire les marges par défaut */
    }
    
}
/* .report-container {
    border: 2px solid black;
    padding: 20px;
    border-radius: 10px;
} */

.table-bordered th {
    background: #f8f9fa;
    font-weight: bold;
}
.table-bordered td {
    border: 1px solid #000;
}
.print_area {
        width: 210mm; /*Largeur A4 */
        height: 297mm; /* Hauteur A4 */
        padding: 20mm; /* Marges internes */
        box-sizing: border-box; /* Inclut le padding dans les dimensions */
        background: white; /* Fond blanc pour l'impression */
        page-break-before: always; /* Commencer sur une nouvelle page */
}

</style>
@endsection

@section('footer')
<script type="text/javascript">
    function PrintPreview(divName) {

        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }


    $(function() {
        $(document).on("click", '.print_prescription', function() {
            PrintPreview('print_area');
            
            /*
            $('#print_area').printThis({
             importCSS: true,
                    importStyle: true,//thrown in for extra measure
             loadCSS: "{{ asset('dashboard/css/sb-admin-2.min.css') }}",
             pageTitle: "xxx",
             copyTagClasses: true,
              base: true,
              printContainer: true,
              removeInline: false,
            });
            */

        });
    });
</script>
@endsection


<!-- </body>
</html> -->
