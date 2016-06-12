<section class="page-title">
    <div class="container">
        <div class="inner">
          <div class="column">
            <div class="title">
              <h1>Re-send Activation Key</h1>
            </div><!-- .title -->
          </div><!-- .column -->
          <div class="column">
            <div class="breadcrumbs">
              <a href="<?php echo site_url(); ?>">Home</a>
              <span class="delimiter"><i class="icon-arrow-right"></i></span>
              <span>Re-send Activation Key</span>
            </div><!-- .breadcrumbs -->
          </div><!-- .column -->
        </div>
    </div>
</section><!-- .page-title -->
<div class="container">
       <center>
            <?php
            if(!empty(validation_errors()))
            {
                  ?>
                  <center><p class="bg-danger"><?php echo validation_errors(); ?></p></center>
                  <?php
            }
            if(!empty($pesan))
            {
                  if($pesan == "ERROR")
                  { ?>
                        <center><p class="bg-danger"><strong>Error</strong> !!. Try Again Later !!</p></center>
                   <?php
                  }
                  else
                  {
                        ?>
                        <center><p class="bg-success">Sukses !. Password terbaru telah kami kirim ke Email Anda !.</p></center>
                        <?php
                  }
            }
            ?>
       </center>
       <form action="<?php echo site_url("register/resend_key_submit");?>" method="POST">
            <fieldset>
            <div class="row">
              <div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
                <div class="form-group">
                <label for="email">Email</label>
                  <input type="email" name="email" id="email" placeholder="My Email Here" required>
                  <center>
                      <br>
                      <?php echo $this->recaptcha->render(); ?>
                      <br>
                  </center>
                  <input name="submit" type="submit" value="Resend Activation Key" class="btn btn-block btn-3d btn-primary" id="submit"/>
                </div>
              </div>
            </div>
            </fieldset>
       </form>
</div>