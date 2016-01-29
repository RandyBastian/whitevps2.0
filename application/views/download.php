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
                            <th style="text-align:center">Location</th>
                            <th style="text-align:center">Download</th>
                            <th style="text-align:center">Create Free Account</th>
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
                              <td style="text-align:center"><?php echo $row->name;?></td>
                              <td style="text-align:center"><?php echo $row->host; ?></td>
                              <td style="text-align:center">
                              <?php
                                if($row->location == "1")
                                  echo "ASIA";
                                elseif($row->location == "2")
                                  echo "EUROPE";
                                else
                                  echo "US";
                              ?></td>
                              <td style="text-align:center"><?php 
                                foreach($configuration as $list)
                                {
                                  if($list->configuration_type == "TCP" && $list->id_server == $row->id)
                                  {
                                    ?>
                                    <a class="btn btn-primary btn-sm" href="<?php echo site_url("download/file/$list->id");?>" data-selector="a.btn">VPN TCP <?php echo $list->port;?></a></p>
                                    <?php
                                  }
                                }
                                foreach($configuration as $list)
                                {
                                  if($list->configuration_type == "UDP" && $list->id_server == $row->id)
                                  {
                                    ?>
                                    <a class="btn btn-primary btn-sm" href="<?php echo site_url("download/file/$list->id");?>" data-selector="a.btn">VPN UDP <?php echo $list->port;?></a></p>
                                    <?php
                                  }
                                }
                                $list_server = strtolower($row->name);
                              ?></td>
                              <td style="text-align:center"><a target="_blank" class="btn btn-primary btn-sm" href="<?php echo site_url("home/server/$list_server");?>" data-selector="a.btn">Create HERE</a></p>
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