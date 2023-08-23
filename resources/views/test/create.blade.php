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
{{ __('sentence.Add Test') }}
@endsection

@section('content')

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Add Test') }}</h6>
         </div>
         <div class="card-body">
            <form method="post" action="{{ route('test.create') }}">
               <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">{{ __('sentence.Test Name') }}<font color="red">*</font></label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputEmail3" name="test_name">
                     {{ csrf_field() }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Description') }}</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputPassword3" name="comment">
                  </div>
               </div>
               <div class="form-group row">
                    <label for="inputSection" class="col-sm-3 col-form-label">{{ __('sentence.Form Type') }}</label>
                    <div class="col-sm-9">
                        <select multiple class="form-control" id="inputSection" name="section[]">
                            <option value="DIAGNOSE PEAU" >DIAGNOSE PEAU</option>
                            <option value="DIAGNOSE MAIN" >DIAGNOSE MAIN</option>
                            <option value="DIAGNOSE PIED" >DIAGNOSE PIED</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row " id="section-DIAGNOSE PEAU">
                <!-- Content for DIAGNOSE PEAU section -->
                <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.skin diagnostic sheet') }}</h6>
                        </div>
                        <div class="card-body">
                            <p>skin</p>
                        </div>
                    </div>
                </div>

                <div class="form-group row " id="section-DIAGNOSE MAIN">
                <!-- Content for DIAGNOSE MAIN section -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.hand diagnostic sheet') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                    <label for="Etat-generale-des-mains" class="col-sm-3 col-form-label">{{ __('sentence.general hand state') }}</label>
                                    <div class="col-sm-9">
                                        <select id="Etat-generale-des-mains" class="form-control" name="Etat-generale-des-mains">
                                            <option value="Normale">Normale</option>
                                            <option value="Sèche">Sèche</option>
                                            <option value="Très sèches">Très sèches</option>
                                            <option value="Atrophiées">Atrophiées</option>
                                        </select>
                                    </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                    <label for="Etat-des-ongles" class="col-sm-3 col-form-label">{{ __('sentence.nail state') }}</label>
                                    <div class="col-sm-9">
                                        <select id="Etat-des-ongles" class="form-control" name="Etat-des-ongles">
                                            <option value="Normaux">Normaux</option>
                                            <option value="Dures">Dures</option>
                                            <option value="Cassants">Cassants</option>
                                            <option value="Fragiles">Fragiles</option>
                                        </select>
                                    </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                    <label for="signes-particuliers-mains" class="col-sm-3 col-form-label">{{ __('sentence.particular type hand') }}</label>
                                    <div class="col-sm-9">
                                        <select id="signes-particuliers-mains" class="form-control" multiple="multiple" name="signes_particuliers_mains[]">
                                            <option value="Rousseurs">Rousseurs</option>
                                            <option value="Pigmentation">Pigmentation</option>
                                            <option value="Desquamations">Desquamations</option>
                                            <option value="Cicatrices">Cicatrices</option>
                                        </select>
                                    </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="signes-particuliers-ongles" class="col-sm-3 col-form-label">{{ __('sentence.finger state') }}</label>
                                <div class="col-sm-9">
                                    <select id="signes-particuliers-ongles" class="form-control" multiple="multiple" name="signes_particuliers_ongles[]">
                                        <option value="Epais">Epais</option>
                                        <option value="Décollés">Décollés</option>
                                        <option value="Colorés">Colorés (jaunâtre, vert)</option>
                                        <option value="Petites taches">Petites taches</option>
                                        <option value="Fripés">Fripés</option>
                                        <option value="Friables et poudreux">Friables et poudreux</option>
                                        <option value="Striées">Striées</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="soin" class="col-sm-3 col-form-label">{{ __('sentence.soin') }}</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="soin" multiple="multiple" name="soinList[]">
                                        <option value="1">soin 1</option>
                                        <option value="2">soin 2</option>
                                        <option value="3">soin 3</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="vernis" class="col-sm-3 col-form-label">{{ __('sentence.vernis') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="vernis" name="vernisInput">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="obseration" class="col-sm-3 col-form-label">{{ __('sentence.obseration') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="obseration" name="obserationInput">
                                </div>
                            </div>
                            <hr>
                            <h5>FACE  INTERNE</h5>
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <label for="relief" class="col-sm-3 col-form-label">{{ __('sentence.relief') }}</label>
                                    <input type="text" class="form-control" id="relief" name="reliefInput">
                                </div>
                                <div class="col-sm-9">
                                    <label for="cicatrices" class="col-sm-3 col-form-label">{{ __('sentence.cicatrices') }}</label>
                                    <select class="form-control" id="cicatrices"  name="cicatrices">
                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                    <option value="non">{{ __('sentence.non') }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-9">
                                <label for="callosites" class="col-sm-3 col-form-label">{{ __('sentence.callosites') }}</label>
                                    <select class="form-control" id="callosites"  name="callosites">
                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                    <option value="non">{{ __('sentence.non') }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-9">
                                <label for="sp1" class="col-sm-3 col-form-label">{{ __('sentence.signe particulier') }}</label>
                                    <textarea type="text" class="form-control" id="sp1" name="spInput1"></textarea>
                                </div>
                            </div>
                            <hr>
                            <h5>FACE  DORSALE</h5>
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <label for="skinState" class="col-sm-3 col-form-label">{{ __('sentence.etat de la peau') }}</label>
                                    <input type="text" class="form-control" id="skinState" name="skinStateInput">
                                </div>
                                <div class="col-sm-9">
                                    <label for="cicatrices" class="col-sm-3 col-form-label">{{ __('sentence.taches') }}</label>
                                    <select class="form-control" id="cicatrices"  name="cicatrices">
                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                    <option value="non">{{ __('sentence.non') }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-9">
                                    <label for="cicatrices" class="col-sm-3 col-form-label">{{ __('sentence.cicatrices') }}</label>
                                    <select class="form-control" id="cicatrices"  name="cicatrices">
                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                    <option value="non">{{ __('sentence.non') }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-9">
                                <label for="callosites" class="col-sm-3 col-form-label">{{ __('sentence.espaces inter digitale') }}</label>
                                    <select class="form-control" id="callosites"  name="callosites">
                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                    <option value="non">{{ __('sentence.non') }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-9">
                                <label for="sp2" class="col-sm-3 col-form-label">{{ __('sentence.signe particulier') }}</label>
                                    <textarea type="text" class="form-control" id="sp2" name="spInput2"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="form-group row " id="section-DIAGNOSE PIED">
                <!-- Content for DIAGNOSE PIED section -->
                <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.foot diagnostic sheet') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                    <label for="Etat-generale-des-mains" class="col-sm-3 col-form-label">{{ __('sentence.general foot state') }}</label>
                                    <div class="col-sm-9">
                                        <select id="Etat-generale-des-mains" class="form-control" name="Etat-generale-des-mains">
                                            <option value="Normale">Normale</option>
                                            <option value="Sèche">Sèche</option>
                                            <option value="Très sèches">Très sèches</option>
                                            <option value="Atrophiées">Atrophiées</option>
                                        </select>
                                    </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                    <label for="Etat-des-ongles" class="col-sm-3 col-form-label">{{ __('sentence.nail state') }}</label>
                                    <div class="col-sm-9">
                                        <select id="Etat-des-ongles" class="form-control" name="Etat-des-ongles">
                                            <option value="Normaux">Normaux</option>
                                            <option value="Dures">Dures</option>
                                            <option value="Cassants">Cassants</option>
                                            <option value="Fragiles">Fragiles</option>
                                        </select>
                                    </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                    <label for="signes-particuliers-mains" class="col-sm-3 col-form-label">{{ __('sentence.particular type foot') }}</label>
                                    <div class="col-sm-9">
                                        <select id="signes-particuliers-mains" class="form-control" multiple="multiple" name="signes_particuliers_mains[]">
                                            <option value="Rousseurs">Rousseurs</option>
                                            <option value="Pigmentation">Pigmentation</option>
                                            <option value="Desquamations">Desquamations</option>
                                            <option value="Cicatrices">Cicatrices</option>
                                        </select>
                                    </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="signes-particuliers-ongles" class="col-sm-3 col-form-label">{{ __('sentence.finger state') }}</label>
                                <div class="col-sm-9">
                                    <select id="signes-particuliers-ongles" class="form-control" multiple="multiple" name="signes_particuliers_ongles[]">
                                        <option value="Epais">Epais</option>
                                        <option value="Décollés">Décollés</option>
                                        <option value="Colorés">Colorés (jaunâtre, vert)</option>
                                        <option value="Petites taches">Petites taches</option>
                                        <option value="Fripés">Fripés</option>
                                        <option value="Friables et poudreux">Friables et poudreux</option>
                                        <option value="Striées">Striées</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="soin" class="col-sm-3 col-form-label">{{ __('sentence.soin') }}</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="soin" multiple="multiple" name="soinList[]">
                                        <option value="1">soin 1</option>
                                        <option value="2">soin 2</option>
                                        <option value="3">soin 3</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="vernis" class="col-sm-3 col-form-label">{{ __('sentence.vernis') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="vernis" name="vernisInput">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="obseration" class="col-sm-3 col-form-label">{{ __('sentence.obseration') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="obseration" name="obserationInput">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                            <div class="col-sm-9">
                                <label for="cicatrices" class="col-sm-3 col-form-label">{{ __('sentence.general foot state') }}</label>
                                <select class="form-control" id="cicatrices"  name="cicatrices">
                                    <option value="oui">{{ __('oui') }}</option>
                                    <option value="non">{{ __('non') }}</option>
                                </select>
                            </div>

                            <div class="col-sm-9">
                                <label for="cicatrices" class="col-sm-3 col-form-label">{{ __( 'sentence.particular type foot') }}</label>
                                <select class="form-control" id="cicatrices"  name="cicatrices">
                                    <option value="oui">{{ __('oui') }}</option>
                                    <option value="non">{{ __('non') }}</option>
                                </select>
                            </div>

                            <div class="col-sm-9">
                                <label for="cicatrices" class="col-sm-3 col-form-label">{{ __('sentence.taches foot') }}</label>
                                <select class="form-control" id="cicatrices"  name="cicatrices">
                                    <option value="oui">{{ __('oui') }}</option>
                                    <option value="non">{{ __('non') }}</option>
                                </select>
                            </div>

                            <div class="col-sm-9">
                                <label for="cicatrices" class="col-sm-3 col-form-label">{{ __('sentence.aureoles') }}</label>
                                <select class="form-control" id="cicatrices"  name="cicatrices">
                                    <option value="oui">{{ __('oui') }}</option>
                                    <option value="non">{{ __('non') }}</option>
                                </select>
                            </div>

                            <div class="col-sm-9">
                                <label for="cicatrices" class="col-sm-3 col-form-label">{{ __('sentence.veines face ext') }}</label>
                                <select class="form-control" id="cicatrices"  name="cicatrices">
                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                    <option value="non">{{ __('sentence.non') }}</option>
                                </select>
                            </div>

                            <div class="col-sm-9">
                                <label for="cicatrices" class="col-sm-3 col-form-label">{{ __('sentence.veines face int') }}</label>
                                <select class="form-control" id="cicatrices"  name="cicatrices">
                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                    <option value="non">{{ __('sentence.non') }}</option>
                                </select>
                            </div>

                            <div class="col-sm-9">
                                <label for="cicatrices" class="col-sm-3 col-form-label">{{ __('sentence.douleur talon') }}</label>
                                <select class="form-control" id="cicatrices"  name="cicatrices">
                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                    <option value="non">{{ __('sentence.non') }}</option>
                                </select>
                            </div>
                                <div class="col-sm-9">
                                <label for="sp2" class="col-sm-3 col-form-label">{{ __('sentence.signe particulier') }}</label>
                                    <textarea type="text" class="form-control" id="sp2" name="spInput2"></textarea>
                                </div>
                            </div>

                        </div>
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


@section('footer')
<script type="text/javascript" defer>
   window.addEventListener('DOMContentLoaded', function() {
      var sections = document.querySelectorAll('.form-group.row[id^="section-"]');

      sections.forEach(function(section) {
         section.style.display = 'none';
      });

      document.getElementById('inputSection').addEventListener('change', function() {
         var selectedOptions = Array.from(this.selectedOptions).map(option => option.value);

         sections.forEach(function(section) {
            if (selectedOptions.includes(section.id.replace('section-', ''))) {
               section.style.display = 'block';
            } else {
               section.style.display = 'none';
            }
         });
      });
   });
</script>

<script type="text/javascript" src="https://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
<!-- Initialize the plugin: -->
<script type="text/javascript">
    $('#signes-particuliers-mains, #signes-particuliers-ongles, #soin').multiselect();
</script>
@endsection
