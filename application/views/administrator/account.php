<div class="row" id="user_table">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th style="text-align:center">Username</th>
                                <th style="text-align:center">Created Date</th>
                                <th style="text-align:center">Expired Date</th>
                                <th style="text-align:center">Owner</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th style="text-align:center">Username</th>
                                <th style="text-align:center">Created Date</th>
                                <th style="text-align:center">Expired Date</th>
                                <th style="text-align:center">Owner</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($account as $data){ ?>
                        	<tr>
                        		<td style="text-align:center"><?php echo $data->username;?></td>
                        		<td style="text-align:center"><?php echo $data->created_date;?></td>
                        		<td style="text-align:center"><?php echo $data->expired_date;?></td>
                        		<td style="text-align:center">
                        		<?php 
                        			foreach($user as $list)
                        			{
                        				if($list->id == $data->id_user)
                        				{
                        					echo $list->email;
                        				}
                        			}
                        		?></td>
                        	</tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="row">
                    	<div class="form-group">
                            <label for="server" class="col-lg-2 control-label">Select Server :</label>
                            <div class="col-lg-4">
                                <select class="form-control" name="server" id="server">
                                    <?php
                                    	$no = 1;
                                    	foreach($server as $choose_server)
                                    	{
                                    		echo "<option value='$choose_server->id'>$no. $choose_server->name</option>";
                                    		$no++;
                                    	}
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>