<div class="page_title">
  <div class="container">
    <div class="title"><h1>Server Information</h1></div>
        <div class="pagenation">&nbsp;<a href="<?php echo site_url();?>">Home</a> <i>/</i> <a href="<?php echo site_url("server"); ?>">Server Information</a></div>
  </div>
</div><!-- end page title --> 

<div class="clearfix"></div>
<!-- Contant
======================================= -->
<div class="one_full">
  <div class="table-style">
    <table class="table-list">
        <tr>
            <th>No.</th>
            <th>Server</th>
            <th>TCP Port</th>
            <th>UDP Port</th>
            <th>Status</th>
        </tr>
      <?php
      $no = 1;
      foreach($server as $s)
      {
      ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $s->name;?></td>
            <td><?php
            foreach($port as $p)
            {
              if($p->type == "TCP" && $p->id_server == $s->id)
              {
                echo $p->port." <i class='fa fa-check fa-lg'></i> ";
              }
            }
            ?></td>
            <td><?php
            foreach($port as $p)
            {
              if($p->type == "UDP" && $p->id_server == $s->id)
              {
                echo $p->port." <i class='fa fa-check fa-lg'></i> ";
              }
            }
            ?></td>
            <td><?php
            if($s->status == "UP")
            {
              echo "<i class='fa fa-check fa-lg' style='color:green'> $s->status</i>";
            }
            else
            {
              echo "<i class='fa fa-remove fa-lg' style='color:red'> $s->status</i>";
            }
            ?></td>
        </tr>
      <?php
      $no++;
      }
      ?>
    </table>
  </div>  
</div><!-- end tables -->