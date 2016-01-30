<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Randy Bastian">
    <title>Login | White-vps.com</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>/assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>/assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open("login/signin",array("id" => "login_form"));?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="email" id="email" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password here" id="password" name="password" type="password">
                                </div>
                                <center>
                                    <?php echo $this->recaptcha->render(); ?>
                                    <br>
                                </center>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-success btn-block" id="submit" value="Login">
                                </div>
                            </fieldset>
                        </form>
                        <a href="<?php echo site_url('register');?>">Need Account ?. Register Here.</a>
                    </div>
                </div>
                <?php
                if(!empty($pesan) || !empty(validation_errors()))
                {
                ?>
                    <div class="alert alert-danger">
                        <center>
                            <?php
                            if(!empty($pesan))
                            {
                                echo $pesan;
                            }
                            if(!empty(validation_errors()))
                            {
                                echo validation_errors();
                            }
                            ?>
                        </center>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url();?>/assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>/assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

     <script src="<?php echo base_url();?>/assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>/assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>/assets/dist/js/sb-admin-2.js"></script>
</body>

</html>
