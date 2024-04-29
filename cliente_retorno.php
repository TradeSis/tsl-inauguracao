<!doctype html>
<html lang="pt-BR">

<head>

    <?php include_once "vendor/head_css.php"; ?>

</head>

<body>

    <div class="container-fluid">

        <!-- Header -->
        <div class="text-center">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7 mt-4">
                    <p class="text-lead text">Por favor insira os dados do cliente.</p>
                </div>
                <div class="container">
                    <a class="brand">
                        <img src="img/lebes.png" width="130px">
                    </a>
                </div>
            </div>
        </div>

        <!-- Page content -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="col">   
                                <?php if (isset($_GET['retorno'])) { ?>
                                <div class="alert alert-info text-center my-3" role="alert">
                                    <?php echo $_GET['retorno'] ?>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="text-center mt-2">
                                <a href="index.php" role="button" class="btn btn btn-primary">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="container">
        <div class="copyright text-center">
            <p style="font-size: smaller;">Copyright &copy; TRADESIS Soluções em Sistemas 2022</p>
        </div>
    </div>


    </div>

    <!-- LOCAL PARA COLOCAR OS JS -->

    <?php include_once "vendor/footer_js.php"; ?>

    <!-- LOCAL PARA COLOCAR OS JS -FIM -->

</body>

</html>