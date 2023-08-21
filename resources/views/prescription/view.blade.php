@extends('layouts.master')
@section('title')
{{ __('sentence.View Prescription') }}
@endsection
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800"></h1>
   <button href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm print_prescription"><i class="fas fa-print fa-sm text-white-50"></i> Print</button>
</div>
<div class="row justify-content-center">
   <div class="col-10">
      <div class="card shadow mb-4">
         <div class="card-body">
            <!-- ROW : Doctor informations -->
            <div class="row">
               <div class="col">
                  @if(!empty(App\Setting::get_option('logo')))
                  <img src="{{ asset('uploads/'.App\Setting::get_option('logo')) }}"><br><br>
                  @endif
                  {!! clean(App\Setting::get_option('header_left')) !!}
               </div>
               <div class="col-md-3">
                  <p><b>{{ __('sentence.Date') }} :</b> {{ $prescription->created_at->format('d M Y') }}</p>
                  <p><b>{{ __('sentence.Reference') }} :</b> {{ $prescription->reference }}</p>
               </div>
            </div>
            <!-- END ROW : Doctor informations -->
            <!-- ROW : Patient informations -->
            <div class="row">
               <div class="col">
                  <hr>
                  <p>
                     <b>{{ __('sentence.Patient Name') }} :</b> {{ $prescription->User->name }}
                     @isset($prescription->User->Patient->birthday)
                     - <b>{{ __('sentence.Age') }} :</b> {{ $prescription->User->Patient->birthday }} ({{ \Carbon\Carbon::parse($prescription->User->Patient->birthday)->age }} Years)
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
               </div>
            </div>
            <!-- END ROW : Patient informations -->
            @if(count($prescription_drugs) > 0)
            <!-- ROW : Drugs List -->
            <div class="row justify-content-center">
               <div class="col">
                  @foreach ($prescription_drugs as $drug)
                  <li>{{ $drug->type }} - {{ $drug->Drug->trade_name }} {{ $drug->strength }} - {{ $drug->dose }} - {{ $drug->duration }} <br> {{ $drug->drug_advice }}</li>
                  @if($loop->last)
                  <div style="margin-bottom: 150px;"></div>
                  <hr>
                  @endif
                  @endforeach
               </div>
            </div>
            @endif
            @if(count($prescription_tests) > 0)
            <!-- ROW : Tests List -->
            <div class="row justify-content-center">
               <div class="col">
                  <strong><u>{{ __('sentence.Test to do') }} </u></strong><br><br>
                  @foreach ($prescription_tests as $test)
                  <li>{{ $test->Test->test_name }} @empty(!$test->description) - {{ $test->description }} @endempty</li>
                  @if($loop->last)
                  <div style="margin-bottom: 150px;"></div>
                  <hr>
                  @endif
                  @endforeach
                  <hr>
               </div>
            </div>
            <!-- END ROW : Tests List -->
            @endif
            @if(!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right')))
            <!-- ROW : Footer informations -->
            <div class="row">
               <div class="col">
                  <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
               </div>
               <div class="col">
                  <p class="float-right font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
               </div>
            </div>
            <!-- END ROW : Footer informations -->
            @elseif(empty(App\Setting::get_option('footer_left')))
            <!-- ROW : Footer informations -->
            <div class="row">
               <div class="col">
                  <p class="font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
               </div>
            </div>
            <!-- END ROW : Footer informations -->
            @elseif(empty(App\Setting::get_option('footer_right')))
            <!-- ROW : Footer informations -->
            <div class="row">
               <div class="col">
                  <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
               </div>
            </div>
            <!-- END ROW : Footer informations -->
            @else
            @endif
         </div>
      </div>
   </div>
</div>
<!-- Hidden prescription -->
<div id="print_area" style="display: none;">
   <!-- ROW : Doctor informations -->
   <div class="row">
      <div class="col-9">
         @if(!empty(App\Setting::get_option('logo')))
         <img src="{{ asset('uploads/'.App\Setting::get_option('logo')) }}"><br><br>
         @endif
         {!! clean(App\Setting::get_option('header_left')) !!}
      </div>
      <div class="col-3">
         {{ __('sentence.On') }} {{ $prescription->created_at->format('d M Y') }}
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
   @if(count($prescription_drugs) > 0)
   <!-- ROW : Drugs List -->
   <div class="row justify-content-center">
      <div class="col">
         @foreach ($prescription_drugs as $drug)
         <li>{{ $drug->type }} - {{ $drug->Drug->trade_name }} {{ $drug->strength }} - {{ $drug->dose }} - {{ $drug->duration }} <br> {{ $drug->drug_advice }}</li>
         @if($loop->last)
         <div style="margin-bottom: 150px;"></div>
         <hr>
         @endif
         @endforeach
      </div>
   </div>
   @endif
   @if(count($prescription_tests) > 0)
   <!-- ROW : Tests List -->
   <div class="row justify-content-center">
      <div class="col">
         <strong><u>{{ __('sentence.Test to do') }} </u></strong><br><br>
         @foreach ($prescription_tests as $test)
         <li>{{ $test->Test->test_name }} @empty(!$test->description) - {{ $test->description }} @endempty</li>
         @if($loop->last)
         <div style="margin-bottom: 150px;"></div>
         <hr>
         @endif
         @endforeach
         <hr>
      </div>
   </div>
   <!-- END ROW : Tests List -->
   @endif
   <!-- ROW : Footer informations -->
   <footer style="position: absolute; bottom: 0;">
      <hr >
      @if(!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right')))
      <!-- ROW : Footer informations -->
      <div class="row">
         <div class="col">
            <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
         </div>
         <div class="col">
            <p class="float-right font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
         </div>
      </div>
      <!-- END ROW : Footer informations -->
      @elseif(empty(App\Setting::get_option('footer_left')))
      <!-- ROW : Footer informations -->
      <div class="row">
         <div class="col">
            <p class="font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
         </div>
      </div>
      <!-- END ROW : Footer informations -->
      @elseif(empty(App\Setting::get_option('footer_right')))
      <!-- ROW : Footer informations -->
      <div class="row">
         <div class="col">
            <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
         </div>
      </div>
      <!-- END ROW : Footer informations -->
      @else
      @endif
   </footer>
   <!-- END ROW : Footer informations -->
</div>
@endsection
@section('header')
<style type="text/css">
   p, u, li {
   color: #444444 !important; 
   }
</style>
@endsection
@section('footer')
<script type="text/javascript">
   function printDiv(divName) {
      
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
   
     document.body.innerHTML = printContents;
   
     window.print();
   
     document.body.innerHTML = originalContents;
   }
   
   
   $(function(){
     $(document).on("click", '.print_prescription',function () {
        printDiv('print_area');
      });
   });
</script>
@endsection