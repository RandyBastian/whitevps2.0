<div class="block">
            <div class="container">
            <!-- Wide table with range of cols -->
                <div class="table-responsive">
                <table class="table table-bordered table--wide table-present">
                    <colgroup class="col-sm-width">
                    </colgroup><colgroup class="col-sm-width">
                    </colgroup><colgroup class="col-sm-width">
                    </colgroup><colgroup class="col-sm-width">
                    </colgroup><colgroup class="col-sm-width">
                    </colgroup><colgroup class="col-sm-width">
                    </colgroup><colgroup class="col-sm-width">
                    </colgroup><colgroup class="col-sm-width">
                    </colgroup><thead>
                        <tr>
                            <th style="text-align:center">#</th>
                            <th style="text-align:center">Server Name</th>
                            <th style="text-align:center">Host</th>
                            <th style="text-align:center">SSH Port</th>
                            <th style="text-align:center">VPN TCP Port</th>
                            <th style="text-align:center">VPN UDP Port</th>
                            <th style="text-align:center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach($server as $row)
                        {
                          ?>
                            <tr>
                              <td style="text-align:center"><?php echo $no; ?></td>
                              <td style="text-align:center"><?php echo $row->name; ?></td>
                              <td style="text-align:center"><?php echo $row->host; ?></td>
                              <td style="text-align:center">
                              <?php 
                                foreach($port as $list)
                                {
                                  if($list->id_server == $row->id && $list->configuration_type == "SSH")
                                  {
                                    ?>
                                    <i class="fa fa-check" data-selector="i.fa"> <?php echo $list->port;?></i>
                                    <?php
                                  }
                                }
                              ?></td>
                               <td style="text-align:center">
                              <?php 
                                foreach($port as $list)
                                {
                                  if($list->id_server == $row->id && $list->configuration_type == "TCP")
                                  {
                                    ?>
                                    <i class="fa fa-check" data-selector="i.fa"> <?php echo $list->port;?></i>
                                    <?php
                                  }
                                }
                              ?></td>
                               <td style="text-align:center">
                              <?php 
                                foreach($port as $list)
                                {
                                  if($list->id_server == $row->id && $list->configuration_type == "UDP")
                                  {
                                    ?>
                                    <i class="fa fa-check" data-selector="i.fa"> <?php echo $list->port;?></i>
                                    <?php
                                  }
                                }
                              ?></td>
                              <td style="text-align:center">
                              <a class="btn btn-primary btn-sm" href="#" data-selector="a.btn">Restart SSH</a>x
                              <a class="btn btn-primary btn-sm" href="#" data-selector="a.btn">Restart VPN</a>
                              </td>
                            </tr>
                          <?php
                          $no++;
                        }
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>