<div class="row" id="user_table">
    <div class="col-lg-12">
        <div class="panel panel-default">
            
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><label><input type="checkbox" class="checkAll"/></label></th>
                                <th style="text-align:center">Email</th>
                                <th style="text-align:center">Credit</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><label><input type="checkbox" class="checkAll"/></label></th>
                                <th style="text-align:center">Email</th>
                                <th style="text-align:center">Credit</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($user as $data_user){ ?>
                        	<tr>
                                <td><input type="checkbox" id="msg[]" name="msg[]" value="<?php echo "$data_user->id"; ?>"></td>
                        		<td style="text-align:center"><?php echo $data_user->email;?></td>
                        		<td style="text-align:center"><?php echo $data_user->credit_premium;?></td>
                        		<td style="text-align:center">
                                    <a href='<?php echo site_url("partner/user-edit/$data_user->id");?>'><button type="button" class="btn btn-info"><i class="fa fa-gears"> Edit</i></button></a>
                        		</td>
                        	</tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>