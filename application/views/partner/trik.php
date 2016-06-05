<div class="row" id="user_table">
    <div class="col-lg-12">
        <div class="panel panel-default">
             <div class="panel-heading">
                <a href="<?php echo site_url('partner/trik/trik_create');?>" class="btn btn-block btn-social btn-dropbox"><i class="fa fa-dropbox"></i> Create New</a>
            </div>
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th style="text-align:center">Judul</th>
                                <th style="text-align:center">Isi</th>
                                <th style="text-align:center" width="150px">Tangal Dibuat</th>
                                <th width="300px">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th style="text-align:center">Judul</th>
                                <th style="text-align:center">Isi</th>
                                <th style="text-align:center">Tangal Dibuat</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($trik as $data_user){ ?>
                        	<tr>
                        		<td style="text-align:center"><?php echo $data_user->judul;?></td>
                        		<td style="text-align:center"><?php echo $data_user->isi;?></td>
                                <td><?php echo $data_user->created_date; ?></td>
                        		<td style="text-align:center">
                                    <a href='<?php echo site_url("partner/trik/trik-edit/$data_user->id");?>'><button type="button" class="btn btn-info"><i class="fa fa-gears"> Edit Trik</i></button></a> | 
                                    <a href='<?php echo site_url("partner/trik/trik-delete/$data_user->id");?>'><button type="button" class="btn btn-danger" onclick="return confirm('Delete  <?php echo "$data_user->judul";?> ?')"><i class="fa fa-plus-circle"></i> Delete Trik</button></a>
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