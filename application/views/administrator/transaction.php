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
                                <th style="text-align:center">Invoice</th>
                                <th style="text-align:center">Product</th>
                                <th style="text-align:center">Price</th>
                                <th style="text-align:center">Transaction Date</th>
                                <th style="text-align:center">Payment Date</th>
                                <th style="text-align:center">Payment Method</th>
                                <th style="text-align:center">Status</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><label><input type="checkbox" class="checkAll"/></label></th>
                                <th style="text-align:center">Invoice</th>
                                <th style="text-align:center">Product</th>
                                <th style="text-align:center">Price</th>
                                <th style="text-align:center">Transaction Date</th>
                                <th style="text-align:center">Payment Date</th>
                                <th style="text-align:center">Payment Method</th>
                                <th style="text-align:center">Status</th>
                                <th style="text-align:center">Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($transaction as $data){ ?>
                        	<tr>
                                <td><input type="checkbox" id="msg[]" name="msg[]" value="<?php echo "$data->id"; ?>"></td>
                        		<td style="text-align:center"><?php echo $data->invoice;?></td>
                        		<td style="text-align:center"><?php echo $data->name;?></td>
                                <td style="text-align:right">Rp. <?php echo $data->price;?>,00</td>
                                <td style="text-align:center"><?php echo $data->transaction_date; ?></td>
                                <td style="text-align:center"><?php echo $data->payment_date; ?></td>
                                <td style="text-align:center"><?php echo $data->payment_method; ?></td>
                        		<td style="text-align:center"><?php echo $data->status;?></td>
                                <td style="text-align:center">
                                  <?php
                                  if($data->status != "PAID")
                                  {
                                    ?>
                                    <a href="<?php echo site_url("administrator/transaction_edit/$data->id"); ?>">
                                    <button class="btn btn-info" onclick="return confirm('Approve <?php echo "$data->invoice";?> ?')">Approve</button>
                                  </a>
                                    <?php
                                  }
                                  else
                                  {
                                    echo "-";
                                  }
                                  ?>
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