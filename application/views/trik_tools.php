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
      foreach($trik as $t)
      {
        ?>
           <div class="panel-group" id="accordion">
              <div class="panel">
                <div class="panel-heading">
                  <a class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    Collapsible Group Item #1
                  </a>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                  <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                  </div>
                </div>
              </div><!-- .panel -->
            </div><!-- .panel-group -->
        <?php
        $no++;
      }
    }
    else
    {
      echo "<h1>Trik & Tools Kosong !!</h1>";
    }
    ?>
  </div>
</div>