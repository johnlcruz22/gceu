<!DOCTYPE html>
<html lang='pt-BR'>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>GCEU - Alteração de senha</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <style>
  el.error{
  background-color: red;
   }
  </style>
</head>
  
<body class="bg-dark">

 <?php
    $linkauto = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $limpa    =  strstr($linkauto,'=');
    
 ?>
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div class="text-center mb-4">
          <h4>Digite uma nova senha:</h4>
       <span id="msg"></span>
        </div>
        <form id="formulario" method="POST" action="<?php echo 'recpass.php?email'.$limpa ?>" >

         <div class="form-group">
              <div class="form-label-group">
                 
                  <input type="password" id="senha" name="senha" class="form-control" placeholder="senha">
                  <label for=senha>Password</label>
                  <span></span>
                </div>
          </div>      
         <div class="form-group">          
                <div class="form-label-group">
                  <input type="password" name="confirmar_senha" id="confirmar_senha"  class="form-control" placeholder="Confirmar password">
                  <label for=confirmar_senha>Confirmar password</label>
                  <span></span>
                </div>
              
          </div>
          
         <button type="submit" class="btn btn-primary btn-block">Resetar agora</button>
        </form>
      </div>
    </div>
  </div>

 <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-validation/dist/jquery.validate.js"></script>
  <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>


  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
 var validator = $("#formulario").bind("invalid-form.validate",function(){
    $("#msg").html("Este formulario tem "+validator.numberOfInvalids() +" erro(s)");
   
  }).validate({
     errorElement:"el",
     errorPlacement: function(error, element) {
      console.log('Debug:' +  error);
      /*here we add the error label to the div that is after the br tag 
      using the next method provided by jquery to navigate on the DOM*/     
      error.appendTo(element.next().next());
    },
      rules: {
      senha: {
        required: true
      },
      confirmar_senha: {
        required: true,
        equalTo: "#senha"
      }
    },
    messages: {
      senha: {
        required: "O campo senha é obrigatório."
      },
      confirmar_senha: {
        required: "O campo confirmação de senha é obrigatório.",
        equalTo: "O campo confirmação de senha deve ser identico ao campo senha."
      }
    }
  });
});
</script>


 
</body>

</html>
