<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Edit Drug')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Edit Drug')); ?> "<?php echo e($drug->trade_name); ?>"
                    </h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo e(route('drug.store_edit')); ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trade Name *</label>
                            <input type="text" class="form-control" name="trade_name" id="TradeName"
                                aria-describedby="TradeName" value="<?php echo e($drug->trade_name); ?>">
                            <?php echo e(csrf_field()); ?>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"><?php echo e(__('sentence.Generic Name')); ?><font color="red">*
                                </font></label>
                            <select name="generic_name[]" multiple id="GenericName" class="form-control">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($product['name']); ?>"><?php echo e($product['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Note</label>
                            <input type="text" class="form-control" name="note" id="Note"
                                placeholder="aucun description...">
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('sentence.Save')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript"
        src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
        $('#GenericName').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            filterPlaceholder: 'Recherche un Hôte...',
            buttonContainer: '<div class="btn-group w-100" />'
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Desktop\gestion des soins\v1.0\resources\views/drug/edit.blade.php ENDPATH**/ ?>
