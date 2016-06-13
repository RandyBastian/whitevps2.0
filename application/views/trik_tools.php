<section class="page-title">
    <div class="container">
        <div class="inner">
          <div class="column">
            <div class="title">
              <h1>Trik & Tools</h1>
            </div><!-- .title -->
          </div><!-- .column -->
          <div class="column">
            <div class="breadcrumbs">
              <a href="<?php echo site_url(); ?>">Home</a>
              <span class="delimiter"><i class="icon-arrow-right"></i></span>
              <span>Trik & Tools</span>
            </div><!-- .breadcrumbs -->
          </div><!-- .column -->
        </div>
    </div>
</section><!-- .page-title -->

<div class="container">
  <div class="row">
    <?php
    if(!empty($trik))
    {
      $no = 1;
      echo "<div class='panel-group' id='accordion'>";
      foreach($trik as $t)
      {
        foreach($user as $u)
        {
          if($u->id == $t->id_creator)
          {
            $facebook = $u->facebook;
            $name     = $u->first_name;
          }
        }
        ?>
              <div class="panel">
                <div class="panel-heading">
                  <a class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#no<?php echo $no; ?>">
                    <?php echo $t->judul." ~ ".$t->created_date;?>
                  </a>
                </div>
                <div id="no<?php echo $no;?>" class="panel-collapse collapse <?php if($no == 1) echo 'in'; ?>">
                  <div class="panel-body">
                    <?php
                    if($status == "false")
                    {
                      echo "<p style='color:red'>Anda tidak memiliki akses !. Harap melakukan login dan anda memiliki akun OpenVPN premium dengan masa aktif lebih dari 3 hari.<p>";
                    }
                    else
                    {
                      echo $t->isi;
                      if(!empty($facebook)){echo "<br><br>Creator : <a href='$facebook' target='_blank'>$name</a>";}
                    }
                    ?>
                  </div>
                </div>
              </div><!-- .panel -->
        <?php
        $no++;
      }
      echo "</div><!-- .panel-group -->";
    }
    else
    {
      echo "<h1>Trik & Tools Kosong !!</h1>";
    }
    ?>
  </div>
</div>