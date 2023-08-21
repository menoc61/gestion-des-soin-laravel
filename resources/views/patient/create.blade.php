@extends('layouts.master')
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
                  <div class="form-group col-md-6">
                     <label for="inputCity">{{ __('sentence.Gender') }}<font color="red">*</font></label>
                     <select class="form-control" name="gender" id="Gender">
                        <option value="Male">{{ __('sentence.Male') }}</option>
                        <option value="Female">{{ __('sentence.Female') }}</option>
                     </select>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="inputZip">{{ __('sentence.Blood Group') }}</label>
                     <select class="form-control" name="blood" id="Blood">
                        <option value="Unknown">{{ __('sentence.Unknown') }}</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                     </select>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputAddress2">{{ __('sentence.Patient Weight') }}</label>
                     <input type="text" class="form-control" id="Weight" name="weight">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="inputAddress">{{ __('sentence.Patient Height') }}<font color="red">*</font></label>
                     <input type="text" class="form-control" id="height" name="height">
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputState">{{ __('sentence.Image') }}</label>
                     <label for="file-upload" class="custom-file-upload">
                     <i class="fa fa-cloud-upload"></i> Select Image to Upload
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
@endsection
@section('footer')
@endsection