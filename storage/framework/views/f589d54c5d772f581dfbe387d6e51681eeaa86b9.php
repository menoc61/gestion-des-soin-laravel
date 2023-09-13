<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" type="text/css" href="https://davidstutz.github.io/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Add Test')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Add Test')); ?></h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo e(route('test.create')); ?>">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Test Name')); ?><font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail3" name="test_name">
                                <?php echo e(csrf_field()); ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3"
                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.Description')); ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputPassword3" name="comment">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputSection" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Form Type')); ?></label>
                            <div class="col-sm-9">
                                <select multiple="multiple" class="form-control" id="inputSection" name="diagnostic_type[]">
                                    <option value="DIAGNOSE PEAU">DIAGNOSE PEAU</option>
                                    <option value="DIAGNOSE MAIN">DIAGNOSE MAIN</option>
                                    <option value="DIAGNOSE PIED">DIAGNOSE PIED</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row " id="section-DIAGNOSE PEAU" style="display: none;">
                            <!-- Content for DIAGNOSE PEAU section -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.skin diagnostic sheet')); ?>

                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="signes-particuliers-peau"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.SIGNES PARTICULIERS')); ?></label>
                                        <div class="col-sm-9">
                                            <select id="signes-particuliers" class="form-control" multiple="multiple"
                                                name="signes_particuliers_peau[]">
                                                <option value="Points noirs">Points noirs</option>
                                                <option value="Rosacée">Rosacée</option>
                                                <option value="Rousseurs">Rousseurs</option>
                                                <option value="Télangiectasie">Télangiectasie</option>
                                                <option value="Pustules">Pustules</option>
                                                <option value="Hypertrichose">Hypertrichose</option>
                                                <option value="Pigmentations">Pigmentations</option>
                                                <option value="Vitiligo">Vitiligo</option>
                                                <option value="Cicatrice">Cicatrice</option>
                                                <option value="Chéloïdes">Chéloïdes</option>
                                                <option value="Comédons">Comédons</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row " id="section-DIAGNOSE MAIN" style="display: none;">
                            <!-- Content for DIAGNOSE MAIN section -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.hand diagnostic sheet')); ?>

                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="Etat-generale-des-mains"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.general hand state')); ?></label>
                                        <div class="col-sm-9">
                                            <select id="Etat-generale-des-mains" class="form-control"
                                                name="Etat_generale_des_mains">
                                                <option value="Normale">Normale</option>
                                                <option value="Sèche">Sèche</option>
                                                <option value="Très sèches">Très sèches</option>
                                                <option value="Atrophiées">Atrophiées</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="Etat-des-ongles-mains"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.nail state')); ?></label>
                                        <div class="col-sm-9">
                                            <select id="Etat-des-ongles-mains" class="form-control"
                                                name="Etat_des_ongles_mains">
                                                <option value="Normaux">Normaux</option>
                                                <option value="Dures">Dures</option>
                                                <option value="Cassants">Cassants</option>
                                                <option value="Fragiles">Fragiles</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="signes-particuliers-mains"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.particular type hand')); ?></label>
                                        <div class="col-sm-9">
                                            <select id="signes-particuliers" class="form-control" multiple="multiple"
                                                name="signes_particuliers_mains[]">
                                                <option value="Rousseurs">Rousseurs</option>
                                                <option value="Pigmentation">Pigmentation</option>
                                                <option value="Desquamations">Desquamations</option>
                                                <option value="Cicatrices">Cicatrices</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="signes-particuliers-ongles-mains"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.finger state')); ?></label>
                                        <div class="col-sm-9">
                                            <select id="signes-particuliers-ongles" class="form-control"
                                                multiple="multiple" name="signes_particuliers_ongles_mains[]">
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
                                        <label for="soin"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.soin')); ?></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="soin" multiple="multiple"
                                                name="soinList_main[]">
                                                <option value="1">soin 1</option>
                                                <option value="2">soin 2</option>
                                                <option value="3">soin 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="vernis"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.vernis')); ?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="vernis"
                                                name="vernisInput_main">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="obseration-mains"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.obseration')); ?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="obseration-mains"
                                                name="obserationInput_main">
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>FACE INTERNE</h5>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <label for="relief"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.relief')); ?></label>
                                            <input type="text" class="form-control" id="relief"
                                                name="reliefInput_main">
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="cicatrices-main"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.cicatrices')); ?></label>
                                            <select class="form-control" id="cicatrices-main" name="cicatrices_main">
                                                <option value="oui"><?php echo e(__('sentence.oui')); ?></option>
                                                <option value="non"><?php echo e(__('sentence.non')); ?></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="callosites-main"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.callosites')); ?></label>
                                            <select class="form-control" id="callosites-main" name="callosites_main">
                                                <option value="oui"><?php echo e(__('sentence.oui')); ?></option>
                                                <option value="non"><?php echo e(__('sentence.non')); ?></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="sp1"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.signe particulier')); ?></label>
                                            <textarea type="text" class="form-control" id="sp1" name="spInput_main"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>FACE DORSALE</h5>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <label for="skinState-main"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.etat de la peau')); ?></label>
                                            <input type="text" class="form-control" id="skinState-main"
                                                name="skinStateInput_main">
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="tache-main"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.taches')); ?></label>
                                            <select class="form-control" id="tache-main" name="tache_main">
                                                <option value="oui"><?php echo e(__('sentence.oui')); ?></option>
                                                <option value="non"><?php echo e(__('sentence.non')); ?></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="cicatrices-main-dorsal"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.cicatrices')); ?></label>
                                            <select class="form-control" id="cicatrices-main-dorsal"
                                                name="cicatrices_main_dorsal">
                                                <option value="oui"><?php echo e(__('sentence.oui')); ?></option>
                                                <option value="non"><?php echo e(__('sentence.non')); ?></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="callosites-main-dorsal"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.espaces inter digitale')); ?></label>
                                            <select class="form-control" id="callosites-main-dorsal"
                                                name="callosite_main_dorsal">
                                                <option value="oui"><?php echo e(__('sentence.oui')); ?></option>
                                                <option value="non"><?php echo e(__('sentence.non')); ?></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="sp2"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.signe particulier')); ?></label>
                                            <textarea type="text" class="form-control" id="sp2" name="spInput_main_dorsal"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row " id="section-DIAGNOSE PIED" style="display: none;">
                            <!-- Content for DIAGNOSE PIED section -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <?php echo e(__('sentence.foot diagnostic sheet')); ?></h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="Etat-generale-des-pied"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.general foot state')); ?></label>
                                        <div class="col-sm-9">
                                            <select id="Etat-generale-des-pied" class="form-control"
                                                name="Etat_generale_des_pieds">
                                                <option value="Normale">Normale</option>
                                                <option value="Sèche">Sèche</option>
                                                <option value="Très sèches">Très sèches</option>
                                                <option value="Atrophiées">Atrophiées</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="Etat-des-ongles"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.nail state')); ?></label>
                                        <div class="col-sm-9">
                                            <select id="Etat-des-ongles" class="form-control"
                                                name="Etat_des_ongles_pieds">
                                                <option value="Normaux">Normaux</option>
                                                <option value="Dures">Dures</option>
                                                <option value="Cassants">Cassants</option>
                                                <option value="Fragiles">Fragiles</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="signes-particuliers-mains"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.particular type foot')); ?></label>
                                        <div class="col-sm-9">
                                            <select id="signes-particuliers" class="form-control" multiple="multiple"
                                                name="signes_particuliers_pieds[]">
                                                <option value="Rousseurs">Rousseurs</option>
                                                <option value="Pigmentation">Pigmentation</option>
                                                <option value="Desquamations">Desquamations</option>
                                                <option value="Cicatrices">Cicatrices</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="signes-particuliers-ongles"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.finger state')); ?></label>
                                        <div class="col-sm-9">
                                            <select id="signes-particuliers-ongles" class="form-control"
                                                multiple="multiple" name="signes_particuliers_ongles_pieds[]">
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
                                        <label for="soin"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.soin')); ?></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="soin" multiple="multiple"
                                                name="soinList_pied[]">
                                                <option value="1">soin 1</option>
                                                <option value="2">soin 2</option>
                                                <option value="3">soin 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="vernis"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.vernis')); ?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="vernis"
                                                name="vernisInput_pied">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="obseration"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.obseration')); ?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="obseration"
                                                name="obserationInput_pied">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <label for="etat_pieds"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.general foot state')); ?></label>
                                            <input type="text" class="form-control" id="etat_pieds"
                                                name="etat_pieds">
                                        </div>

                                        <div class="col-sm-9">
                                            <label for="cicatrices"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.taches foot')); ?></label>
                                            <select class="form-control" id="cicatrices" name="taches_pieds">
                                                <option value="oui"><?php echo e(__('oui')); ?></option>
                                                <option value="non"><?php echo e(__('non')); ?></option>
                                            </select>
                                        </div>

                                        <div class="col-sm-9">
                                            <label for="aureoles_pieds"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.aureoles')); ?></label>
                                            <select class="form-control" id="aureoles_pieds" name="aureoles_pieds">
                                                <option value="oui"><?php echo e(__('oui')); ?></option>
                                                <option value="non"><?php echo e(__('non')); ?></option>
                                            </select>
                                        </div>

                                        <div class="col-sm-9">
                                            <label for="veines_face_ext_pieds"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.veines face ext')); ?></label>
                                            <select class="form-control" id="veines_face_ext_pieds"
                                                name="veines_face_ext_pieds">
                                                <option value="oui"><?php echo e(__('sentence.oui')); ?></option>
                                                <option value="non"><?php echo e(__('sentence.non')); ?></option>
                                            </select>
                                        </div>

                                        <div class="col-sm-9">
                                            <label for="veines_face_int_pieds"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.veines face int')); ?></label>
                                            <select class="form-control" id="veines_face_int_pieds"
                                                name="veines_face_int_pieds">
                                                <option value="oui"><?php echo e(__('sentence.oui')); ?></option>
                                                <option value="non"><?php echo e(__('sentence.non')); ?></option>
                                            </select>
                                        </div>

                                        <div class="col-sm-9">
                                            <label for="douleur_talon_pieds"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.douleur talon')); ?></label>
                                            <select class="form-control" id="douleur_talon_pieds"
                                                name="douleur_talon_pieds">
                                                <option value="oui"><?php echo e(__('sentence.oui')); ?></option>
                                                <option value="non"><?php echo e(__('sentence.non')); ?></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="sp2"
                                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.signe particulier')); ?></label>
                                            <textarea type="text" class="form-control" id="sp2" name="spInput_pieds"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary"><?php echo e(__('sentence.Save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>
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

    <script type="text/javascript"
        src="https://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
        $('#signes-particuliers,#signes-particuliers-ongles,#soin').multiselect();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Desktop\gestion des soins\v1.0\resources\views/test/create.blade.php ENDPATH**/ ?>