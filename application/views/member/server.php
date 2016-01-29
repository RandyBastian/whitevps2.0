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
                                <th style="text-align:center">No.</th>
                                <th style="text-align:center">Server Name</th>
                                <th style="text-align:center">Host</th>
                                <th style="text-align:center">Location</th>
                                <th style="text-align:center">Premium Account</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>    
                                <th style="text-align:center">No.</th>
                                <th style="text-align:center">Server Name</th>
                                <th style="text-align:center">Host</th>
                                <th style="text-align:center">Location</th>
                                <th style="text-align:center">Premium Account</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php 
                        $no = 1;
                        foreach($server as $data){ ?>
                        	<tr>
                                <td style="text-align:center"><?php echo $no;?></td>
                        		<td style="text-align:center"><?php echo $data->name;?></td>
                        		<td style="text-align:center"><?php echo $data->host;?></td>
                        		<td style="text-align:center"><?php
                                    if($data->location == 1)
                                        echo "ASIA";
                                    elseif($data->location == 2)
                                        echo "EUROPE";
                                    elseif($data->location == 3)
                                        echo "US";
                                ?></td>
                                <td style="text-align:center">
                                	<?php 
                                    $sum_account = 0;
                                    foreach($account as $row)
                                    {
                                        if($data->id == $row->id_server)
                                            $sum_account++;
                                		
                                    }
                                    echo $sum_account;
                                    ?>
                                </td>
                        	</tr>
                        <?php 
                        $no++;
                        } ?>
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