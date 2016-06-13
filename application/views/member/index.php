<div class="row">
    <div class="col-md-4 col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Informasi</h3>
                </div>
                <div class="panel-body">
                    <ul>
                       <li>Bagi member yang baru registrasi, anda dapat mencoba Trial Account 2 Hari pada menu Account VPN Management > <a href="<?php echo site_url("member/profile"); ?>">Create Account</a>.</li>
                       <li>Untuk mengecek User anda yang Online, anda dapat memilih menu <a href="<?php echo site_url("member/server"); ?>">Server Information</a>.</li>
                       <li>Untuk mendownload file configuration, anda dapat memilih menu <a href="<?php echo site_url("member/download"); ?>">Configuration Download Area</a></li>
                       <li>Untuk mengakses Trik & Tools, anda dapat memilih menu <a href="<?php echo site_url("trik-tools"); ?>">Trik & Tools</a> .</li>
                    </ul>
                </div>
            </div>
        </div>
    <div class="col-lg-8 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                White-VPS Information
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#accounts" data-toggle="tab">My Accounts</a>
                    </li>
                    <li><a href="#primary_servers" data-toggle="tab">Servers</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="accounts">
                        <div class="row">
                            <br>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-random fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $credit; ?></div>
                                                <div>My Credit</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-check fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $active_account; ?></div>
                                                <div>Active Accounts</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?php echo site_url("member/account"); ?>">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-times-circle fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $expired_account; ?></div>
                                                <div>Expired Accounts</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?php echo site_url("member/account"); ?>">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="primary_servers">
                        <br>
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-tasks fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $server; ?></div>
                                                <div>WHITE-VPS Server</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-tasks fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $port; ?></div>
                                                <div>Ports Available</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>