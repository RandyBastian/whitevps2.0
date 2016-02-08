<div class="page_title">
  <div class="container">
    <div class="title"><h1>Register</h1></div>
        <div class="pagenation">&nbsp;<a href="<?php echo site_url();?>">Home</a> <i>/</i> Register<i></div>
  </div>
</div><!-- end page title --> 


<div class="container">
   <div class="one_half">
   <br>
        <?php
        if(!empty(validation_error()))
        {
            ?>
            <div class="error">
                <div class="message-box-wrap">
               <button class="close-but" id="colosebut4">close</button><?php echo validation_error();?></div>
            </div>  
            <?php
        }

        if(!empty($pesan))
        {
            ?>
            <div class="error">
                <div class="message-box-wrap">
               <button class="close-but" id="colosebut4">close</button><?php echo $pesan;?></div>
            </div> 
            <?php
        }
        ?>
            
        <form action="<?php echo site_url("register/submit");?>" method="post">
    
            <fieldset>
            <label for="first_name" class="blocklabel">First Name*</label>
            <p class="" ><input name="first_name" class="input_bg" type="text" id="first_name" value=''/></p>
            
            <label for="last_name" class="blocklabel">Last Name*</label>
            <p class="" ><input name="last_name" class="input_bg" type="text" id="last_name" value=''/></p>

            <label for="email" class="blocklabel">E-Mail*</label>
            <p class="" ><input name="email" class="input_bg" type="email" id="email" value='' /></p>
            
            <label for="password" class="blocklabel">Password*</label>
            <p><input name="password" class="input_bg" type="password" id="password" value=""/></p>
            
            <label for="confirm_password" class="blocklabel">Confirm Password*</label>
            <p><input name="confirm_password" class="input_bg" type="confirm_password" id="confirm_password" value=""/></p>

            <label for="phone" class="blocklabel">Phone* :</label>
            <p><input name="phone" class="input_bg" type="text" id="phone" value=""/></p>

            <label for="facebook" class="blocklabel">Facebook :</label>
            <p><input name="facebook" class="input_bg" type="text" id="facebook" value=""/></p>

            <label for="city" class="blocklabel">City / Region</label>
            <p><input name="city" class="input_bg" type="city" id="city" value=""/></p>

            <label for="address" class="blocklabel">Address*</label>
            <p class=""><textarea name="address" class="textarea_bg" id="address" cols="8" rows="7" ></textarea></p>
            <div class="clearfix"></div>
            <input name="submit" type="submit" value="Register" class="comment_submit" id="submit"/>
            <br>
            <br>
            </fieldset>
        </form> 
   </div>
</div>