<section class="page-title">
    <div class="container">
        <div class="inner">
          <div class="column">
            <div class="title">
              <h1>Register</h1>
            </div><!-- .title -->
          </div><!-- .column -->
          <div class="column">
            <div class="breadcrumbs">
              <a href="<?php echo site_url(); ?>">Home</a>
              <span class="delimiter"><i class="icon-arrow-right"></i></span>
              <span>Register</span>
            </div><!-- .breadcrumbs -->
          </div><!-- .column -->
        </div>
    </div>
</section><!-- .page-title -->

<div class="container">
    <?php
        if(!empty(validation_errors()))
        {
            ?>
            <center><p class="bg-danger"><?php echo validation_errors(); ?></p></center>
            <?php
        }
        
        if(!empty($pesan))
        {
            ?>
            <center><p class="bg-danger"><?php echo $pesan; ?></p></center>
            <?php
        }
        ?>
    <div class="row">
        <fieldset>
            <form action="<?php echo site_url("register/process");?>" method="post" id="userform">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="first_name">Nama Depan</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Your First Name Here" required>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="last_name">Nama Belakang</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Your Last Name Here" required>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="phone">No. Telepon</label>
                            <input type="number" name="phone" id="phone" class="form-control" placeholder="08xxxx" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="xxxx@gmail.com" required>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password Here" required>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="confirm_password">Re-Type Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Re-Type Password Here" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="facebook">Facebook URL</label>
                            <input type="text" name="facebook" id="facebook" class="form-control" value="https://facebook.com/" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="city">Kota / Provinsi</label>
                            <input type="text" name="city" id="city" class="form-control" placeholder="Your Region Here" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea class="form-control" name="address" id="address" rows="4" placeholder="Your Address Here"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label class="checkbox">
                            <div class="icheckbox">
                                <input type="checkbox" name="tos" id="tos" unchecked required="checked">
                            </div>
                            Setuju dengan <a href="<?php echo site_url("tos"); ?>" target="_blank">Term Of Service</a>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <center>
                              <br>
                              <?php echo $this->recaptcha->render(); ?>
                              <br>
                          </center>
                        <input type="submit" name="submit" class="btn btn-3d btn-info btn-block" value="Registrasi">
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
</div>