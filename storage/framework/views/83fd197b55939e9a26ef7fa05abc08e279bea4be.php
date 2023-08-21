<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

      <title>Doctorino - Login</title>
      
      <link rel="icon" type="image/png" href="<?php echo e(asset('img/favicon.png')); ?>">
      
      <!-- Custom styles for this template-->
      <link href="<?php echo e(asset('dashboard/css/sb-admin-2.min.css')); ?>" rel="stylesheet">

      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-178915398-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-178915398-1');
      </script>

   </head>
   <body class="bg-gradient-primary">
      <div class="container">
         <!-- Outer Row -->
         <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
               <div class="card o-hidden border-0 shadow-lg my-5">
                  <div class="card-body p-0">
                     <!-- Nested Row within Card Body -->
                     <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                           <div class="p-5">
                              <div class="text-center">
                                 <h1 class="h4 text-gray-900 mb-4"><?php echo e(__('sentence.Welcome')); ?></h1>
                              </div>
                              <form method="POST" action="<?php echo e(route('login')); ?>" class="user">
                                 <div class="form-group">
                                    <input id="email" type="email" class="form-control form-control-user <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus  aria-describedby="emailHelp" placeholder="<?php echo e(__('sentence.Email')); ?>">
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                 </div>
                                 <div class="form-group">
                                    <input id="password" type="password" class="form-control form-control-user <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password" placeholder="<?php echo e(__('sentence.Password')); ?>">
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                 </div>
                                 <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                       <input class="custom-control-input" type="checkbox" name="remember" id="customCheck" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                       <?php echo e(csrf_field()); ?>

                                       <label class="custom-control-label" for="customCheck"><?php echo e(__('sentence.Remember Me')); ?></label>
                                    </div>
                                 </div>
                                 <button class="btn btn-warning btn-user btn-block" type="submit"> <?php echo e(__('sentence.Login')); ?></button> 
                              </form>
                              <hr>
                              <?php if(Route::has('password.request')): ?>
                              <div class="text-center">
                                 <a class="small" href="<?php echo e(route('password.request')); ?>"> <?php echo e(__('sentence.Forgot Your Password')); ?></a>
                              </div>
                              <?php endif; ?>
                           </div>
                           <table class="table">
                              <tr>
                                 <td align="center"><b>E-mail</b></td>
                                 <td align="center"><b>Password</b></td>
                              </tr>
                              <tr>
                                 <td align="center">doctor@gmail.com</td>
                                 <td align="center">doctorino</td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
   </body>
</html><?php /**PATH C:\xampp\htdocs\doctorino\v3.4\resources\views/auth/login.blade.php ENDPATH**/ ?>