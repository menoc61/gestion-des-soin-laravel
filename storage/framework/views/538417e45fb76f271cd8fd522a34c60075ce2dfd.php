<?php $__env->startSection('title'); ?>
    <?php echo e($patient->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <?php if(empty(!$patient->image)): ?>
                                <center><img src="<?php echo e(asset('uploads/' . $patient->image)); ?>"
                                        class="img-profile rounded-circle img-fluid" width="256" height="256"
                                        style="object-fit: cover;" alt="profil-img"></center>
                            <?php else: ?>
                                <center><img src="<?php echo e(asset('img/default-image.jpeg')); ?>"
                                        class="img-profile rounded-circle img-fluid" width="256" height="256"
                                        style="object-fit: cover;" alt="profil-img"></center>
                            <?php endif; ?>
                            <h4 class="text-center mt-3"><b><?php echo e($patient->name); ?></b> <label
                                    class="badge badge-primary-soft"> <a href="<?php echo e(url('patient/edit/' . $patient->id)); ?>"><i
                                            class="fa fa-pen"></i></a></label></h4>
                            <hr>

                            <?php if(isset($patient->Patient->birthday)): ?>
                                <p><b><?php echo e(__('sentence.Birthday')); ?> :</b> <?php echo e($patient->Patient->birthday); ?>

                                    (<?php echo e(\Carbon\Carbon::parse($patient->Patient->birthday)->age); ?> ANS)</p>
                            <?php endif; ?>

                            <?php if(isset($patient->Patient->gender)): ?>
                                <p><b><?php echo e(__('sentence.Gender')); ?> :</b> <?php echo e($patient->Patient->gender); ?></p>
                            <?php endif; ?>

                            <?php if(isset($patient->Patient->phone)): ?>
                                <p><b><?php echo e(__('sentence.Phone')); ?> :</b> <?php echo e($patient->Patient->phone); ?></p>
                            <?php endif; ?>

                            <?php if(isset($patient->Patient->adress)): ?>
                                <p><b><?php echo e(__('sentence.Address')); ?> :</b> <?php echo e($patient->Patient->adress); ?></p>
                            <?php endif; ?>

                            <?php if(isset($patient->Patient->allergie)): ?>
                                <p><b><?php echo e(__('sentence.Allergies')); ?> :</b> <?php echo e($patient->Patient->allergie); ?></p>
                            <?php endif; ?>

                            <?php if(isset($patient->Patient->hobbie)): ?>
                                <p><b><?php echo e(__('sentence.Hobbies')); ?> :</b> <?php echo e($patient->Patient->hobbie); ?></p>
                            <?php endif; ?>

                            <?php if(isset($patient->Patient->demande)): ?>
                                <p><b><?php echo e(__('sentence.Special Requests')); ?> :</b> <?php echo e($patient->Patient->demande); ?></p>
                            <?php endif; ?>

                            <hr>

                            <?php if(isset($patient->Patient->morphology)): ?>
                                <p><b><?php echo e(__('sentence.Morphology')); ?> :</b>
                                    <?php
                                        $morphologyArray = json_decode($patient->Patient->morphology);
                                    ?>

                                    <?php if(is_array($morphologyArray)): ?>
                                        <?php $__currentLoopData = $morphologyArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="badge badge-warning-soft"><?php echo e($item); ?></label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <span>No morphology data available.</span>
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>

                            <?php if(isset($patient->Patient->alimentation)): ?>
                                <p><b><?php echo e(__('sentence.Alimentation')); ?> :</b>
                                    <?php
                                        $alimentationArray = json_decode($patient->Patient->alimentation);
                                    ?>

                                    <?php if(is_array($alimentationArray)): ?>
                                        <?php $__currentLoopData = $alimentationArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="badge badge-warning-soft"><?php echo e($item); ?></label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <span>No alimentation data available.</span>
                                    <?php endif; ?>
                                </p>
                                </p>
                            <?php endif; ?>

                            <?php if(isset($patient->Patient->type_patient)): ?>
                                <p><b><?php echo e(__('sentence.Type of patient')); ?> :</b>
                                    <?php
                                        $type_patientArray = json_decode($patient->Patient->type_patient);
                                    ?>

                                    <?php if(is_array($type_patientArray)): ?>
                                        <?php $__currentLoopData = $type_patientArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="badge badge-warning-soft"><?php echo e($item); ?></label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <span>No patient type data available.</span>
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>

                        </div>
                        <div class="col-md-8 col-sm-6">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile"
                                        role="tab" aria-controls="Profile"
                                        aria-selected="true"><?php echo e(__('sentence.Health History')); ?></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents"
                                        role="tab" aria-controls="documents" aria-selected="false">Fichier Médical</a>
                                </li>
                                
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="tests-tab" data-toggle="tab" href="#tests" role="tab"
                                        aria-controls="tests" aria-selected="false"><?php echo e(__('sentence.Test')); ?></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="prescriptions-tab" data-toggle="tab" href="#prescriptions"
                                        role="tab" aria-controls="prescriptions"
                                        aria-selected="false"><?php echo e(__('sentence.Prescriptions')); ?></a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="Billing-tab" data-toggle="tab" href="#Billing" role="tab"
                                        aria-controls="Billing"Alert
                                        aria-selected="false"><?php echo e(__('sentence.Payment History')); ?></a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">

                                    <div class="row">
                                        <div class="col">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create health history')): ?>
                                                <button type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                    data-toggle="modal" data-target="#MedicalHistoryModel"><i
                                                        class="fa fa-plus"></i> <?php echo e(__('sentence.Add New')); ?></button>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php $__empty_1 = true; $__currentLoopData = $historys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="alert alert-danger">
                                            <p class="text-danger font-size-12">
                                                <?php echo clean($history->title); ?> - <?php echo e($history->created_at); ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete health history')): ?>
                                                    <span class="float-right"><i class="fa fa-trash" data-toggle="modal"
                                                            data-target="#DeleteModal"
                                                            data-link="<?php echo e(url('history/delete/' . $history->id)); ?>"></i></span>
                                                <?php endif; ?>
                                            </p>
                                            <?php echo clean($history->note); ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <center><img src="<?php echo e(asset('img/not-found.svg')); ?>" width="200" /> <br><br> <b
                                                class="text-muted">Aucun Historique Trouvé</b></center>
                                    <?php endif; ?>


                                    

                                </div>
                                <div class="tab-pane fade" id="appointements" role="tabpanel"
                                    aria-labelledby="appointements-tab">
                                    <div class="row">
                                        <div class="col">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create appointment')): ?>
                                                <a type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                    href="<?php echo e(route('appointment.create')); ?>"><i class="fa fa-plus"></i>
                                                    <?php echo e(__('sentence.New Appointment')); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <table class="table">
                                            <tr>
                                                <td align="center">Id</td>
                                                <td align="center"><?php echo e(__('sentence.Date')); ?></td>
                                                <td align="center"><?php echo e(__('sentence.Time Slot')); ?></td>
                                                <td align="center"><?php echo e(__('sentence.Status')); ?></td>
                                                <td align="center"><?php echo e(__('sentence.Actions')); ?></td>
                                            </tr>
                                            <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td align="center"><?php echo e($appointment->id); ?> </td>
                                                    <td align="center"><label class="badge badge-primary-soft"><i
                                                                class="fas fa-calendar"></i>
                                                            <?php echo e($appointment->date->format('d M Y')); ?> </label></td>
                                                    <td align="center"><label class="badge badge-primary-soft"><i
                                                                class="fa fa-clock"></i> <?php echo e($appointment->time_start); ?> -
                                                            <?php echo e($appointment->time_end); ?> </label></td>
                                                    <td class="text-center">
                                                        <?php if($appointment->visited == 0): ?>
                                                            <label class="badge badge-warning-soft">
                                                                <i class="fas fa-hourglass-start"></i>
                                                                <?php echo e(__('sentence.Not Yet Visited')); ?>

                                                            </label>
                                                        <?php elseif($appointment->visited == 1): ?>
                                                            <label class="badge badge-success-soft">
                                                                <i class="fas fa-check"></i> <?php echo e(__('sentence.Visited')); ?>

                                                            </label>
                                                        <?php else: ?>
                                                            <label class="badge badge-danger-soft">
                                                                <i class="fas fa-user-times"></i>
                                                                <?php echo e(__('sentence.Cancelled')); ?>

                                                            </label>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit appointment')): ?>
                                                            <a data-rdv_id="<?php echo e($appointment->id); ?>"
                                                                data-rdv_date="<?php echo e($appointment->date->format('d M Y')); ?>"
                                                                data-rdv_time_start="<?php echo e($appointment->time_start); ?>"
                                                                data-rdv_time_end="<?php echo e($appointment->time_end); ?>"
                                                                data-patient_name="<?php echo e($appointment->User->name); ?>"
                                                                class="btn btn-outline-success btn-circle btn-sm"
                                                                data-toggle="modal" data-target="#EDITRDVModal"><i
                                                                    class="fas fa-check"></i></a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete appointment')): ?>
                                                            <a href="<?php echo e(url('appointment/delete/' . $appointment->id)); ?>"
                                                                class="btn btn-outline-danger btn-circle btn-sm"><i
                                                                    class="fas fa-trash"></i></a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="5" align="center"><img
                                                            src="<?php echo e(asset('img/not-found.svg')); ?>" width="200" /> <br><br>
                                                        <b
                                                            class="text-muted"><?php echo e(__('sentence.No appointment available')); ?></b>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </table>
                                    </div>

                                    


                                    

                                    <div class="tab-pane fade" id="tests" role="tabpanel" aria-labelledby="tests-tab">
                                        <div class="row">
                                            <div class="col">
                                                <a class="btn btn-primary btn-sm my-4 float-right"
                                                    href="<?php echo e(route('test.create_by', ['id' => $patient->id])); ?>"><i
                                                        class="fa fa-pen"></i>
                                                    <?php echo e(__('sentence.Add Test')); ?></a>
                                            </div>
                                        </div>
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <tr>
                                                <td align="center"><b>Id</b></td>
                                                <td align="center"><b> Nom Diagnostic</b> </td>
                                                <td align="center"><b>Description</b> </td>
                                                <td align="center"><b> Utilisation </b></td>
                                                <td align="center"><b> Action</b> </td>
                                            </tr>
                                            <?php $__empty_1 = true; $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e($test->id); ?></td>
                                                    <td><?php echo e($test->test_name); ?></td>
                                                    <td> <?php echo e($test->comment); ?> </td>
                                                    <td align="center"><?php echo e(__('sentence.In Prescription')); ?> :
                                                        <?php echo e($test->Prescription->count()); ?> <?php echo e(__('sentence.time use')); ?></td>
                                                    <td class="text-center">

                                                        <a href="<?php echo e(url('test/view/' . $test->id)); ?>"
                                                            class="btn btn-outline-primary btn-circle btn-sm"><i
                                                                class="fa fa-eye"></i></a>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit diagnostic test')): ?>
                                                            <a href="<?php echo e(url('test/edit/' . $test->id)); ?>"
                                                                class="btn btn-outline-warning btn-circle btn-sm"><i
                                                                    class="fa fa-pen"></i></a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete diagnostic test')): ?>
                                                            <a class="btn btn-outline-danger btn-circle btn-sm"
                                                                data-toggle="modal" data-target="#DeleteModal"
                                                                data-link="<?php echo e(url('test/delete/' . $test->id)); ?>"><i
                                                                    class="fa fa-trash"></i></a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="5" class="text-center"><img
                                                            src="<?php echo e(asset('img/not-found.svg')); ?>" width="200" /> <br><br>
                                                        <b class="text-muted">pas de diagnostic trouvé</b>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </table>
                                    </div>

                                    


                                    

                                    <div class="tab-pane fade" id="prescriptions" role="tabpanel"
                                        aria-labelledby="prescriptions-tab">
                                        <div class="row">
                                            <div class="col">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create prescription')): ?>
                                                    <a class="btn btn-primary btn-sm my-4 float-right"
                                                        href="<?php echo e(route('prescription.create_by', ['id' => $patient->id])); ?>"><i class="fa fa-pen"></i>
                                                        <?php echo e(__('sentence.Create Prescription')); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <table class="table">
                                            <tr>
                                                <td align="center"><?php echo e(__('sentence.Reference')); ?></td>
                                                <td class="text-center"><?php echo e(__('sentence.Content')); ?></td>
                                                <td align="center"><?php echo e(__('sentence.Created at')); ?></td>
                                                <td align="center"><?php echo e(__('sentence.Actions')); ?></td>
                                            </tr>
                                            <?php $__empty_1 = true; $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td align="center"><?php echo e($prescription->reference); ?> </td>
                                                    <td class="text-center">
                                                        <label class="badge badge-primary-soft">
                                                            <?php echo e(count($prescription->Drug)); ?> Soins
                                                        </label>
                                                        <label class="badge badge-primary-soft">
                                                            <?php echo e(count($prescription->Test)); ?> Soin
                                                        </label>
                                                    </td>
                                                    <td align="center"><label
                                                            class="badge badge-primary-soft"><?php echo e($prescription->created_at); ?></label>
                                                    </td>
                                                    <td align="center">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view prescription')): ?>
                                                            <a href="<?php echo e(url('prescription/view/' . $prescription->id)); ?>"
                                                                class="btn btn-outline-success btn-circle btn-sm"><i
                                                                    class="fa fa-eye"></i></a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit prescription')): ?>
                                                            <a href="<?php echo e(url('prescription/edit/' . $prescription->id)); ?>"
                                                                class="btn btn-outline-warning btn-circle btn-sm"><i
                                                                    class="fas fa-pen"></i></a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete prescription')): ?>
                                                            <a href="<?php echo e(url('prescription/delete/' . $prescription->id)); ?>"
                                                                class="btn btn-outline-danger btn-circle btn-sm"><i
                                                                    class="fas fa-trash"></i></a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="4" align="center"> <img
                                                            src="<?php echo e(asset('img/not-found.svg')); ?>" width="200" /> <br><br>
                                                        <b class="text-muted">
                                                            <?php echo e(__('sentence.No prescription available')); ?></b>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </table>
                                    </div>

                                    

                                    <div class="tab-pane fade" id="documents" role="tabpanel"
                                        aria-labelledby="documents-tab">
                                        <div class="row">
                                            <div class="col">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
                                                    <button type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                        data-toggle="modal" data-target="#NewDocumentModel"><i
                                                            class="fa fa-plus"></i> <?php echo e(__('sentence.Add New')); ?></button>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <?php $__empty_1 = true; $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <?php if($document->document_type == 'pdf'): ?>
                                                            <img src="<?php echo e(asset('img/pdf.jpg')); ?>" class="card-img-top">
                                                        <?php elseif($document->document_type == 'docx'): ?>
                                                            <img src="<?php echo e(asset('img/docx.png')); ?>" class="card-img-top">
                                                        <?php else: ?>
                                                            <a class="example-image-link"
                                                                href="<?php echo e(url('/uploads/' . $document->file)); ?>"
                                                                data-lightbox="example-1"><img
                                                                    src="<?php echo e(url('/uploads/' . $document->file)); ?>"
                                                                    class="card-img-top" width="209" height="209"></a>
                                                            <img src="<?php echo e(asset('img/pdf.jpg')); ?>" class="card-img-top">
                                                        <?php endif; ?>
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo e($document->title); ?></h5>
                                                            <p class="font-size-12"><?php echo e($document->note); ?></p>
                                                            <p class="font-size-11"><label
                                                                    class="badge badge-primary-soft"><?php echo e($document->created_at); ?></label>
                                                            </p>
                                                            <a href="<?php echo e(url('/uploads/' . $document->file)); ?>"
                                                                class="btn btn-primary btn-sm" download><i
                                                                    class="fa fa-cloud-download-alt"></i> Download</a>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
                                                                <a class="btn btn-danger btn-sm" data-toggle="modal"
                                                                    data-target="#DeleteModal"
                                                                    data-link="<?php echo e(url('document/delete/' . $document->id)); ?>"><i
                                                                        class="fa fa-trash"></i></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <div class="col text-center">
                                                    <img src="<?php echo e(asset('img/not-found.svg')); ?>" width="200" /> <br><br> <b
                                                        class="text-muted"> <?php echo e(__('sentence.No document available')); ?> </b>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>


                                    

                                    <div class="tab-pane fade" id="Billing" role="tabpanel" aria-labelledby="Billing-tab">
                                        <div class="row mt-4">
                                            <div class="col-lg-4 mb-4">
                                                <div class="card bg-primary text-white shadow">
                                                    <div class="card-body">
                                                        <?php echo e(__('sentence.Total With Tax')); ?>

                                                        <div class="text-white small">
                                                            <?php echo e(Collect($invoices)->sum('total_with_tax')); ?>

                                                            <?php echo e(App\Setting::get_option('currency')); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="card bg-success text-white shadow">
                                                    <div class="card-body">
                                                        <?php echo e(__('sentence.Already Paid')); ?>

                                                        <div class="text-white small">
                                                            <?php echo e(Collect($invoices)->sum('deposited_amount')); ?>

                                                            <?php echo e(App\Setting::get_option('currency')); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="card bg-danger text-white shadow">
                                                    <div class="card-body">
                                                        <?php echo e(__('sentence.Due Balance')); ?>

                                                        <div class="text-white small">
                                                            <?php echo e(Collect($invoices)->whereIn('payment_status', ['Partially Paid', 'Unpaid'])->sum('due_amount')); ?>

                                                            <?php echo e(App\Setting::get_option('currency')); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice')): ?>
                                                    <a type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                        href="<?php echo e(route('billing.create_by', ['id' => $patient->id])); ?>"><i class="fa fa-plus"></i>
                                                        <?php echo e(__('sentence.Create Invoice')); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <table class="table">
                                            <tr>
                                                <th><?php echo e(__('sentence.Invoice')); ?></th>
                                                <th><?php echo e(__('sentence.Date')); ?></th>
                                                <th><?php echo e(__('sentence.Amount')); ?></th>
                                                <th><?php echo e(__('sentence.Status')); ?></th>
                                                <th><?php echo e(__('sentence.Actions')); ?></th>
                                            </tr>
                                            <?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><a
                                                            href="<?php echo e(url('billing/view/' . $invoice->id)); ?>"><?php echo e($invoice->reference); ?></a>
                                                    </td>
                                                    <td><label
                                                            class="badge badge-primary-soft"><?php echo e($invoice->created_at->format('d M Y h:m:s')); ?></label>
                                                    </td>
                                                    <td> <?php echo e($invoice->total_with_tax); ?>

                                                        <?php echo e(App\Setting::get_option('currency')); ?>

                                                        <?php if($invoice->payment_status == 'Unpaid' or $invoice->payment_status == 'Partially Paid'): ?>
                                                            <label class="badge badge-danger-soft"><?php echo e($invoice->due_amount); ?>

                                                                <?php echo e(App\Setting::get_option('currency')); ?> </label>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($invoice->payment_status == 'Unpaid'): ?>
                                                            <label class="badge badge-danger-soft">
                                                                <i class="fas fa-hourglass-start"></i>
                                                                <?php echo e(__('sentence.Unpaid')); ?>

                                                            </label>
                                                        <?php elseif($invoice->payment_status == 'Paid'): ?>
                                                            <label class="badge badge-success-soft">
                                                                <i class="fas fa-check"></i> <?php echo e(__('sentence.Paid')); ?>

                                                            </label>
                                                        <?php else: ?>
                                                            <label class="badge badge-warning-soft">
                                                                <i class="fas fa-user-times"></i>
                                                                <?php echo e(__('sentence.Partially Paid')); ?>

                                                            </label>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view invoice')): ?>
                                                            <a href="<?php echo e(url('billing/view/' . $invoice->id)); ?>"
                                                                class="btn btn-outline-success btn-circle btn-sm"><i
                                                                    class="fa fa-eye"></i></a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
                                                            <a href="<?php echo e(url('billing/edit/' . $invoice->id)); ?>"
                                                                class="btn btn-outline-warning btn-circle btn-sm"><i
                                                                    class="fas fa-pen"></i></a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice')): ?>
                                                            <a href="<?php echo e(url('billing/delete/' . $invoice->id)); ?>"
                                                                class="btn btn-outline-danger btn-circle btn-sm"><i
                                                                    class="fas fa-trash"></i></a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                </tr>
                                                <td colspan="6" align="center"><img
                                                        src="<?php echo e(asset('img/not-found.svg')); ?>" width="200" /> <br><br> <b
                                                        class="text-muted"><?php echo e(__('sentence.No Invoices Available')); ?></b>
                                                </td>
                                            <?php endif; ?>
                                        </table>
                                    </div>

                                    

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Modal-->
        <div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <?php echo e(__('sentence.You are about to modify an appointment')); ?></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><b><?php echo e(__('sentence.Patient')); ?> :</b> <span id="patient_name"></span></p>
                        <p><b><?php echo e(__('sentence.Date')); ?> :</b> <label class="badge badge-primary-soft"
                                id="rdv_date"></label></p>
                        <p><b><?php echo e(__('sentence.Time Slot')); ?> :</b> <label class="badge badge-primary-soft"
                                id="rdv_time"></span></label>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button"
                            data-dismiss="modal"><?php echo e(__('sentence.Close')); ?></button>
                        <a class="btn btn-primary text-white"
                            onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();"><?php echo e(__('sentence.Confirm Appointment')); ?></a>
                        <form id="rdv-form-confirm" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST"
                            class="d-none">
                            <input type="hidden" name="rdv_id" id="rdv_id">
                            <input type="hidden" name="rdv_status" value="1">
                            <?php echo csrf_field(); ?>
                        </form>
                        <a class="btn btn-danger text-white"
                            onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();"><?php echo e(__('sentence.Cancel Appointment')); ?></a>
                        <form id="rdv-form-cancel" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST"
                            class="d-none">
                            <input type="hidden" name="rdv_id" id="rdv_id2">
                            <input type="hidden" name="rdv_status" value="2">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Document Modal -->
        <div id="NewDocumentModel" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un Fichier / Note</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="<?php echo e(route('document.store')); ?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="title" placeholder="Titre" required>
                                    <input type="hidden" name="patient_id" value="<?php echo e($patient->id); ?>">
                                    <?php echo e(csrf_field()); ?>

                                </div>
                                <div class="col">
                                    <input type="file" class="form-control-file" name="file"
                                        id="exampleFormControlFile1" required>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <textarea class="form-control" name="note" placeholder="Note"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button"
                                data-dismiss="modal"><?php echo e(__('sentence.Close')); ?></button>
                            <button class="btn btn-primary text-white" type="submit"><?php echo e(__('sentence.Save')); ?></button>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <!--Document Modal -->
        <div id="MedicalHistoryModel" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('sentence.New Medical Info')); ?></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="<?php echo e(route('history.store')); ?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="title" placeholder="Titre" required>
                                    <input type="hidden" name="patient_id" value="<?php echo e($patient->id); ?>">
                                    <?php echo e(csrf_field()); ?>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <textarea class="form-control" name="note" placeholder="Note" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button"
                                data-dismiss="modal"><?php echo e(__('sentence.Close')); ?></button>
                            <button class="btn btn-primary text-white" type="submit"><?php echo e(__('sentence.Save')); ?></button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('header'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('dashboard/css/lightbox.css')); ?>" />
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('footer'); ?>
        <script type="text/javascript" src="<?php echo e(asset('dashboard/js/lightbox.js')); ?>"></script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\HS\gestion-des-soin-laravel\resources\views/patient/view.blade.php ENDPATH**/ ?>