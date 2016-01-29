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
                                <th><label><input type="checkbox" class="checkAll"/></label></th>
                                <th style="text-align:center">Title</th>
                                <th style="text-align:center">Tag</th>
                                <th style="text-align:center">Date</th>
                                <th style="text-align:center">Source</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><label><input type="checkbox" class="checkAll"/></label></th>
                                <th style="text-align:center">Title</th>
                                <th style="text-align:center">Tag</th>
                                <th style="text-align:center">Date</th>
                                <th style="text-align:center">Source</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($announcement as $data){ ?>
                        	<tr>
                                <td><input type="checkbox" id="msg[]" name="msg[]" value="<?php echo "$data->id"; ?>"></td>
                        		<td style="text-align:center"><?php echo $data->title;?></td>
                        		<td style="text-align:center"><?php echo $data->tag;?></td>
                                <td style="text-align:center"><?php echo $data->date;?></td>
                                <td style="text-align:center">
                                <?php
                                    $body = substr($data->source, 0, 30);
                                    echo $body."...";
                                ?></td>
                        		<td style="text-align:center">
                                    <a target="_blank" href='<?php echo site_url("administrator/announcement-edit/$data->id");?>'><button type="button" class="btn btn-info"><i class="fa fa-gears"> Edit</i></button></a>
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