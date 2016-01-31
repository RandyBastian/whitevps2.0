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
                                <th style="text-align:center">Port Service TCP</th>
                                <th style="text-align:center">Port Service UDP</th>
                                <th style="text-align:center">Status</th>
                                <th style="text-align:center">Last Update</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>    
                                <th style="text-align:center">No.</th>
                                <th style="text-align:center">Name</th>
                                <th style="text-align:center">Host</th>
                                 <th style="text-align:center">Port Service TCP</th>
                                <th style="text-align:center">Port Service UDP</th>
                                <th style="text-align:center">Status</th>
                                <th style="text-align:center">Last Update</th>
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
                                <td style="text-align:center">
                                <?php
                                    foreach($configuration as $c)
                                    {
                                        if($c->type == "TCP" && $c->id_server == $data->id)
                                        {
                                            ?>
                                            <i class="fa fa-jsfiddle"><?php echo $c->port;?> </i>
                                            <?php
                                        }
                                    }
                                ?></td>
                                <td style="text-align:center">
                                <?php
                                    foreach($configuration as $c)
                                    {
                                        if($c->type == "UDP" && $c->id_server == $data->id)
                                        {
                                            ?>
                                            <i class="fa fa-jsfiddle"><?php echo $c->port;?> </i>
                                            <?php
                                        }
                                    }
                                ?></td>
                                <th style="text-align:center"><?php 
                                if($data->status == "UP")
                                {
                                    ?>
                                    <button class="btn btn-success"><i class="fa fa-check"> Up</i></button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button class="btn btn-danger"><i class="fa fa-exclamation-triangle"> Down</i></button>
                                    <?php
                                }
                                ?></th>
                                <th style="text-align:center"><?php echo $data->update_status;?></th>
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