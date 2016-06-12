<section class="page-title">
    <div class="container">
        <div class="inner">
          <div class="column">
            <div class="title">
              <h1>Server Information</h1>
            </div><!-- .title -->
          </div><!-- .column -->
          <div class="column">
            <div class="breadcrumbs">
              <a href="<?php echo site_url(); ?>">Home</a>
              <span class="delimiter"><i class="icon-arrow-right"></i></span>
              <span>Server Information</span>
            </div><!-- .breadcrumbs -->
          </div><!-- .column -->
        </div>
    </div>
</section><!-- .page-title -->
<div class="container">
  <div class="row">
    <p>Note : Silahkan login untuk mengetahui akun OpenVPN anda yang sedang Online.</p>
    <p style="color:red">Scroll tabel ke kanan untuk melihat Online Account (Mobile View).</p>
    <div class="table-responsive">
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Server Name</th>
                <th>Host</th>
                <th width="200px">Location</th>
                <th width="200px">Online Accounts</th>
                <th width="150px">My Accounts</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if(!empty($server))
              {
                $no = 1;
                foreach($server as $s)
                {
                  $jumlah     = 0;
                  $my_account = "";
                  if(!empty($account))
                  {
                    $counter = 0;
                    foreach($account as $a)
                    {
                      if($a->ip_address == $s->host)
                      {
                        $jumlah++;
                        if(!empty($id))
                        {
                          if($id == $a->id_user)
                          {
                            $my_account[$counter] = $a->username;
                            $counter++;
                          }
                        }
                      }
                    }
                  }
                  ?>
                  <tr>
                    <th><?php echo $no; ?></th>
                    <th><?php echo $s->name; ?></th>
                    <th><?php echo $s->host; ?></th>
                    <th><?php echo $s->area; ?></th>
                    <th><?php echo $jumlah;?></th>
                    <th><?php
                    if(!empty($my_account))
                    {
                      foreach($my_account as $m)
                      {
                        echo "$m<br>";
                      }
                    }
                    else
                    {
                      echo "-";
                    }
                    ?></th>
                  </tr>
                  <?php
                  $no++;
                }
              }
              ?>
            </tbody>
          </table>
        </div>
  </div>

</div>