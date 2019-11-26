
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Atualizando combos com jquery</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript" src="jquery-1.6.4_min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#estado').change(function () {
                $('#cidade').load('listaCidades.php?estado='+ encodeURI($('#estado').val()), function (data) {
                console.log(data);
                this.innerHTML(data);
                });

            });
        });
    </script>
</head>
<body>
<h1>Atualizando combos com jquery</h1>
<label>Estado:</label>
<select name="estado" id="estado">
    <?php
    include 'conexao.php';
    $obj            = new conexao;
    $connect1       = $obj->conecta();
    $query_select   = "SELECT * FROM gceu;";
    //criando a query de consulta à tabela criada
    $sql = mysqli_query($connect1, $query_select) or die(
    mysqli_error($connect1) //caso haja um erro na consulta
    );
    ?>

    <?php while($aux = mysqli_fetch_assoc($sql)) { ?>
    <option value="<?php echo $aux['nome_gceu'] ?>"> <?php echo $aux['nome_gceu']; ?> </option>
    <?php } ?>
</select>
<br/><br/>
<select name="cidade" id="cidade">

</select>
</body>
</html>