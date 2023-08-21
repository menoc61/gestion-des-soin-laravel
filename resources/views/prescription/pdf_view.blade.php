<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="Digit94Team">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="zXbiSv6MysbCo84DXZ4JSrdGP6dkFJbqvwo0wgSS">
      <title>Doctorino - {{ __('sentence.View Prescription') }} 
      </title>
      <!-- Custom styles for this template-->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <style type="text/css">
         
      </style>
   </head>
   <body>

                     
                                 <!-- ROW : Doctor informations -->
                                 <div class="row">
                                    <div class="col-9">
                                       {!! clean(App\Setting::get_option('header_left')) !!}
                                    </div>
                                    <div class="col-3">
                                      Alger, {{ __('sentence.On') }} {{ $prescription->created_at->format('d-m-Y') }}
                                    </div>
                                 </div>
                                 <!-- END ROW : Doctor informations -->
                                   <hr>
                                 <!-- ROW : Patient informations -->
                                 <div class="row">
                                    <div class="col">
                                     
                                       <p>
                                          <b>{{ __('sentence.Patient Name') }} :</b> {{ $prescription->User->name }}
                                          @isset($prescription->User->Patient->birthday)
                                          - <b>{{ __('sentence.Age') }} :</b> {{ $prescription->User->Patient->birthday }} ({{ \Carbon\Carbon::parse($prescription->User->Patient->birthday)->age }} {{ __('sentence.Years') }})
                                          @endisset
                                          @isset($prescription->User->Patient->gender)
                                          - <b>{{ __('sentence.Gender') }} :</b> {{ __('sentence.'.$prescription->User->Patient->gender) }}
                                          @endisset
                                          @isset($prescription->User->Patient->weight)
                                          - <b>{{ __('sentence.Patient Weight') }} :</b> {{ $prescription->User->Patient->weight }} Kg
                                          @endisset
                                          @isset($prescription->User->Patient->height)
                                          - <b>{{ __('sentence.Patient Height') }} :</b> {{ $prescription->User->Patient->height }}
                                          @endisset
                                       </p>
                                       <hr>
                                       <h5 class="text-center"><b>{{ __('sentence.Prescription') }}</b></h5>
                                       <hr>
                                    </div>
                                 </div>
                                 <!-- END ROW : Patient informations -->
                                 <!-- ROW : Drugs List -->
                                 <div class="row justify-content-center">
                                    <div class="col">
                                       @forelse ($prescription_drugs as $drug)
                                       <li>{{ $drug->type }} - {{ $drug->Drug->trade_name }} {{ $drug->strength }} - {{ $drug->dose }} - {{ $drug->duration }} <br> {{ $drug->drug_advice }}</li>
                                       @empty
                                       <p>{{ __('sentence.No Drugs') }}</p>
                                       @endforelse
                                    </div>
                                 </div>
                                 <!-- END ROW : Drugs List -->
                                 <!-- ROW : Footer informations -->
                                    <hr>
                                    <div class="row">
                                       <div class="col-6">
                                          <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                                       </div>
                                       <div class="col-6">
                                          <p class="float-right font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                                       </div>
                                    </div>
                                    <!-- END ROW : Footer informations -->
                             
                  
                
   
 
   </body>
</html>