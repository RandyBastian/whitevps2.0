<div class="container">
       <center>
            <?php
            if(!empty(validation_errors()))
            {
                  ?>
                  <div class="error">
                      <div class="message-box-wrap">
                     <button class="close-but" id="colosebut4">close</button><?php echo validation_errors();?></div>
                  </div>  
                  <?php
            }
            if(!empty($pesan))
            {
                  if($pesan == "ERROR")
                  { ?>
                        <div class="error">
                            <div class="message-box-wrap">
                           <button class="close-but" id="colosebut4">close</button>Error !!. Try Again Later !!</div>
                        </div> 
                   <?php
                  }
                  else
                  {
                        ?>
                        <div class="success">
                        <div class="message-box-wrap">
                              <strong>Success !!</strong> Check Your Email.</div>
                        </div>
                        <?php
                  }
            }
            ?>
       </center>
       <form action="<?php echo site_url("register/resend_key_submit");?>" method="POST">
            <fieldset>
             <label for="email" class="blocklabel">E-Mail</label>
             <input name="email" class="input_bg" type="email" id="email" required>
             <input name="submit" type="submit" value="Resend Activation Key" class="comment_submit" id="submit"/>
             <br>
             <br>
            </fieldset>
       </form>
</div>