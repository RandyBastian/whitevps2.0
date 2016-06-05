<?php

?>
<div class="row" id="user_table">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?php echo site_url('partner/account/account_create');?>" class="btn btn-block btn-social btn-dropbox"><i class="fa fa-dropbox"></i> Create New</a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <p style="color:red">*Top Up 1 month = Add 1 month Expired Account.</p>
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><label><input type="checkbox" class="checkAll"/></label></th>
                                <th style="text-align:center">Username</th>
                                <th style="text-align:center">Created Date</th>
                                <th style="text-align:center">Expired Date</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><label><input type="checkbox" class="checkAll"/></label></th>
                                <th style="text-align:center">Username</th>
                                <th style="text-align:center">Created Date</th>
                                <th style="text-align:center">Expired Date</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($account as $data){ ?>
                            <tr>
                                <td><input type="checkbox" id="msg[]" name="msg[]" value="<?php echo "$data->id"; ?>"></td>
                                <td style="text-align:center"><?php echo $data->username;?></td>
                                <td style="text-align:center"><?php echo $data->created_date;?></td>
                                <td style="text-align:center">
                                <?php
                                    echo $data->expired_date;
                                    if($data->expired_date < date("Y-m-d")){
                                        echo "<p style='color:red'>(Expired)</p>";
                                    }
                                ?></td>
                                <td style="text-align:center">
                                    <a href='<?php echo site_url("partner/account/account_edit/$data->id");?>'><button type="button" class="btn btn-info"><i class="fa fa-gears"></i> Change Password</button></a> | <a href='<?php echo site_url("partner/account/top_up/$data->id");?>'><button type="button" class="btn btn-danger" onclick="return confirm('Add 1 Month Expired Account : <?php echo "$data->username";?> ?')"><i class="fa fa-plus-circle"></i> Top Up 1 Month</button></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2" id="hasil"></div>
                    </div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>