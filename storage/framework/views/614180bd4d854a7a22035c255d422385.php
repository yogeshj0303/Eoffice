
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.list-js'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
<style>
    
    .col-lg-12 {
        flex: 0 0 auto;
        width: 70% !important;
    }
.file-submit{
    margin:0 auto;
    padding:5px;
    margin-left: 380px;
    border-radius:5px;
}
</style>
     <div class="row">
        <div class="col-lg-12" style="margin-left:200px">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Closed file Report</h4>
                  
                </div><!-- end card header -->
                
                <div class="card-body">
                    <div class="live-preview">
                          

                        <div class="row gy-12" style="margin:10px">
                         <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="exampleInputdate" class="form-label">From</label>
                                    <input type="date" class="form-control" id="exampleInputdate">
                                </div>
                        </div> 
                         <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="exampleInputdate" class="form-label">To</label>
                                    <input type="date" class="form-control" id="exampleInputdate">
                                </div>
                            </div>
                           
                </div>
                 
                
                   <a href="/closed-file-report">
    <button class="file-submit">Submit</button>
</a>
            </div>
        </div>
        <!--end col-->
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/libs/list.js/list.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/libs/list.pagination.js/list.pagination.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/pages/listjs.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/acttconnect/e-office.acttconnect.com/resources/views/report/closed-file.blade.php ENDPATH**/ ?>