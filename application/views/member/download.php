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
                                <th style="text-align:center">Name</th>
                                <th style="text-align:center">Host</th>
                                <th style="text-align:center">Download Configuration</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>    
                                <th style="text-align:center">No.</th>
                                <th style="text-align:center">Name</th>
                                <th style="text-align:center">Host</th>
                                <th style="text-align:center">Download Configuration</th>
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
                        		<td>
                                <?php
                                    foreach($configuration as $c)
                                    {
                                        if($c->type == "TCP" && $c->id_server == $data->id)
                                        {
                                            ?>
                                            <a href="<?php echo site_url("download/file/$c->id");?>">
                                            <button class="btn btn-primary btn-xs"><i class="fa fa-cloud-download"> TCP <?php echo $c->port;?></i></button>
                                            </a>
                                            <?php
                                        }
                                    }
                                    foreach($configuration as $c)
                                    {
                                        if($c->type == "UDP" && $c->id_server == $data->id)
                                        {
                                            ?>
                                            <a href="<?php echo site_url("download/file/$c->id");?>">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-cloud-download"> UDP <?php echo $c->port;?></i></button>
                                            </a>
                                            <?php
                                        }
                                    }
                                ?></td>
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