@extends('layouts.master')
@section('header')
    <style>
        .hidden-section {
            display: none;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://davidstutz.github.io/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">
@endsection
@section('title')
{{ __('sentence.New Patient') }}
@endsection
@section('content')
<div class="row justify-content-center">
   <div class="col-md-10">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.New Patient') }}</h6>
         </div>
         <div class="card-body">
            <form method="post" action="{{ route('patient.create') }}" enctype="multipart/form-data">
               @csrf
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputEmail4">{{ __('sentence.Full Name') }}<font color="red">*</font></label>
                     <input type="text" class="form-control" id="Name" name="name">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="inputPassword4">{{ __('sentence.Email Adress') }}<font color="red">*</font></label>
                     <input type="email" class="form-control" id="Email" name="email">
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputAddress2">{{ __('sentence.Phone') }}</label>
                     <input type="text" class="form-control" id="Phone" name="phone">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="inputAddress">{{ __('sentence.Birthday') }}<font color="red">*</font></label>
                     <input type="date" class="form-control" id="Birthday" name="birthday" autocomplete="off">
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-12">
                     <label for="inputAddress2">{{ __('sentence.Address') }}</label>
                      <input type="text" class="form-control" id="Address" name="adress">
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-4">
                     <label for="inputCity">{{ __('sentence.Gender') }}<font color="red">*</font></label>
                     <select class="form-control" name="gender" id="Gender">
                        <option value="Male">{{ __('sentence.Male') }}</option>
                        <option value="Female">{{ __('sentence.Female') }}</option>
                     </select>
                  </div>
                  <div class="form-row col-md-7 ml-5" >
                    <div class="form-group col-md-4">
                      <label for="morphology_patient">{{ __('sentence.Morphology') }}<font color="red">*</font></label>
                      <div class="col-md-4">
                          <select class="form-control" id="morphology_patient" multiple="multiple" name="morphology[]">
                              <option value="1">Grand(e)</option>
                              <option value="3">Svelte</option>
                              <option value="2">Petit(e)</option>
                              <option value="4">Mince</option>
                              <option value="5">Maigre</option>
                              <option value="6">Rondeur</option>
                              <option value="7">Enveloppé(e)</option>
                          </select>
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="alimentation_patient">{{ __('sentence.Alimentation') }}<font color="red">*</font></label>
                      <div class="col-md-4">
                          <select class="form-control" id="alimentation_patient" multiple="multiple" name="alimentation[]">
                              <option value="1">Viande</option>
                              <option value="2">Poisson</option>
                              <option value="3">Légumes</option>
                              <option value="4">Céréales</option>
                              <option value="5">Tubercules</option>
                              <option value="6">Fruits</option>
                              <option value="7">Alcool</option>
                              <option value="9">Fumeur</option>
                              <option value="10">Non-fumeur</option>
                          </select>
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="digestion_patient">{{ __('sentence.Digestion') }}<font color="red">*</font></label>
                      <div class="col-md-4">
                          <select class="form-control" id="digestion_patient" multiple="multiple" name="digestion[]">
                              <option value="1">Bonne</option>
                              <option value="2">Alternée</option>
                              <option value="3">Médiocre</option>
                          </select>
                      </div>
                    </div>
                </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="hobbie">{{ __('sentence.Hobbies') }}<font color="red">*</font></label>
                    <input type="text" class="form-control" id="hobbie" name="hobbie">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="medication">{{ __('sentence.Medication') }}<font color="red">*</font></label>
                    <input type="text" class="form-control" id="medication" name="medication">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="allergie">{{ __('sentence.Allergies') }}<font color="red">*</font></label>
                    <input type="text" class="form-control" id="allergie" name="allergie">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="request">{{ __('sentence.Special Requests') }}<font color="red">*</font></label>
                    <input type="text" class="form-control" id="request" name="request">
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputState">{{ __('sentence.Image') }}</label>
                     <label for="file-upload" class="custom-file-upload">
                     <i class="fa fa-cloud-upload"></i> Sélectionnez l’image
                     </label>
                     <input type="file" class="form-control" id="file-upload" name="image">
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
<style type="text/css">
   input[type="file"] {
   display: none;
   }
   .custom-file-upload {
   border: 1px solid #ccc;
   display: inline-block;
   padding: 6px 12px;
   cursor: pointer;
   }
</style>

@section('footer')
<script type="text/javascript" src="https://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
<!-- Initialize the plugin: -->
<script type="text/javascript">
    $('#morphology_patient, #alimentation_patient, #digestion_patient').multiselect();
</script>
@endsection
