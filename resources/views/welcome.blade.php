<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Bootstrap demo</title>
   <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
   <link href="{{ asset('image-uploader/dist/image-uploader.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
   <style>
      body {
         background: rgb(168, 166, 166);
      }

      label.error {
         color: red;
         font-style: italic;
      }

      .field-icon {
         float: right;
         margin-left: -25px;
         margin-top: -27px;
         margin-right: 10px;
         position: relative;
         z-index: 2;
         cursor: pointer;
      }

      .show_password {
         height: 25px;
         width: 25px;
         position: relative;
         top: 6px;

      }

      .image {
         height: 150px;
         width: 100%;
         text-align: center;
         border: 1px solid rgb(161, 161, 161);
         border-radius: 5px;
         background: #ffff;
      }

      .image span i {
         font-size: 52px;
         color: #ffff
      }
   </style>
</head>

<body>
   <div class="container">
      <form action="" id="submitForm">
         <div class="row pt-4">
            <div class="col-xl-6 offset-3">
               <div class="form-group pb-3">
                  <label for="">Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter name">
               </div>
               <div class="form-group pb-3">
                  <label for="">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Enter email">
               </div>
               <div class="form-group pb-3">
                  <label for="">Phone</label>
                  <input type="text" name="phone" id="mobile" class="form-control"
                     onkeypress="return /[0-9]/i.test(event.key)" placeholder="Enter phone">
               </div>

               <div class="form-group pb-3">
                  <label for="">Password</label>
                  <input type="password" name="password" id="password" class="form-control show_pass"
                     placeholder="Enter password">
                  <span toggle="#password" class="fa fa-fw fa-eye field-icon view-password"></span>
               </div>
               <div class="form-group pb-3">
                  <label for="">Confirm Password</label>
                  <input type="password" name="confirm_passord" id="comfirmPass" class="form-control show_pass"
                     placeholder="Enter confirm password">
               </div>

               <div class="form-group pb-3">
                  <input type="checkbox" class="show_password" onclick="showPassword()">
                  <label for="">Show Password</label>
               </div>

               <div class="form-group pb-3">
                  <label for="">Upload Profile Picture</label>
                  <input type="file" name="" class="form-control">
               </div>
               <div class="form-group pb-3">
                  <label for="">Upload Multiple Photo</label>
                  <div class="input-images"></div>
               </div>
               <div class="pb-3">
                  <div>
                     <button type="button" class="btn btn-primary" onclick="addMoreField()"><i class="fa fa-plus"></i>
                        Add
                        More Fields </button>
                  </div>

                  <div id="moreItems">
                     <div class="default" style="display: none;">
                        <div class="row">
                           <div class="col-xl-5">
                              <label for="">Title</label>
                              <input type="text" class="form-control" name="title[]">
                           </div>
                           <div class="col-xl-5">
                              <label for="">Writer Name</label>
                              <input type="text" class="form-control" name="writer_name[]">
                           </div>
                           <div class="col-xl-2 pt-4">
                              <button type="button" class="btn btn-danger float-end" onclick="closeBtn(this)"><i
                                    class="fa fa-trash"></i></button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>




               <div class="form-group float-end pb-3">
                  <button type="button" class="btn btn-primary">Next <i class="fa fa-arrow-right"
                        aria-hidden="true"></i></button>
               </div>
               <div class="form-group pb-3">
                  <button type="submit" class="btn btn-primary">Submit</button>
               </div>

            </div>


         </div>
      </form>
   </div>
   <script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
   <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('image-uploader/dist/image-uploader.min.js') }}"></script>
   <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
   
   <script>
      $("#submitForm").validate({
         rules: {
            name: "required",
            email: {
               required: true,
               email: true,
            },
            phone: {
               required: true,
               minlength: 10,
               maxlength: 11,
            },
            password: {
               required: true,
               minlength: 5,
            },
            confirm_passord: {
               required: true,
               equalTo: "#password",
            },
         },
         messages: {
            name: "Please enter your name first",
            email: {
               required: "Enter email address",
               email: "not valied email, enter correct email",
            },
         },
         submitHandler: function(form) {
            form.submit();
         }
      });
   </script>
   <script>
      $('.view-password').click(function() {
         $(this).toggleClass("fa-eye fa-eye-slash");
         var input = $($(this).attr("toggle"));
         if (input.attr('type') == 'password') {
            input.attr('type', 'text');
         } else {
            input.attr('type', 'password');
         }
      });

      function showPassword() {
         var x = document.getElementById("password");
         var y = document.getElementById("comfirmPass");
         if (x.type === 'password' && y.type === 'password') {
            x.type = 'text';
            y.type = 'text';
         } else {
            x.type = 'password';
            y.type = 'password';
         }
      }
   </script>
   <script>
      function addMoreField() {
         var defaultDiv = document.querySelector('.default');
         var clonedDiv = defaultDiv.cloneNode(true);
         clonedDiv.style.display = '';
         var moreItemDiv = document.getElementById('moreItems');
         moreItemDiv.appendChild(clonedDiv);
      }

      function closeBtn(button) {
         $(button).closest('.default').remove();
      }
   </script>

   <script>
      $(document).ready(function() {
         $('.input-images').imageUploader({
            imagesInputName: 'image',
            preloadedInputName: 'old',
            maxSize: 2 * 1024 * 1024,
            maxFiles: 10
         });
      });
   </script>
</body>

</html>
