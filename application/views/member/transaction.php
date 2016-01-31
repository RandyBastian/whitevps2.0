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
                                <th><label></label></th>
                                <th style="text-align:center">Invoice</th>
                                <th style="text-align:center">Name</th>
                                <th style="text-align:center">Price</th>
                                <th style="text-align:center">Date</th>
                                <th style="text-align:center">Price Type</th>
                                <th style="text-align:center">Payment Method</th>
                                <th style="text-align:center">Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><label></label></th>
                                <th style="text-align:center">Invoice</th>
                                <th style="text-align:center">Name</th>
                                <th style="text-align:center">Price</th>
                                <th style="text-align:center">Date</th>
                                <th style="text-align:center">Price Type</th>
                                <th style="text-align:center">Payment Method</th>
                                <th style="text-align:center">Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($transaction as $data){ ?>
                        	<tr>
                                <td></td>
                        		<td style="text-align:center"><?php echo $data->invoice;?></td>
                        		<td style="text-align:center"><?php echo $data->name;?></td>
                                <td style="text-align:center"><?php echo $data->price;?></td>
                                <td style="text-align:center"><?php echo $data->transaction_date;?></td>
                                <td style="text-align:center"><?php echo $data->price_type;?></td>                               
                                <td style="text-align:center"><?php echo $data->payment_method;?></td>
                                <th style="text-align:center"><?php echo $data->status;?></th>
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