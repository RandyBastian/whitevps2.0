<div class="block">
            <section class="container">            
                <div class="price-container">
                        <div class="col-sm-4 price--full">
                            <center>
                                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <!-- left create account white-vps -->
                                <ins class="adsbygoogle"
                                     style="display:inline-block;width:300px;height:250px"
                                     data-ad-client="ca-pub-3273236229288524"
                                     data-ad-slot="5078171494"></ins>
                                <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                                <br>
                                <a href="https://www.digitalocean.com/?refcode=7bea1f3fd4d3" target="_blank"><img src="<?php echo base_url();?>assets/digitalocean.gif" title="digital ocean" alt="digitalocean Link"></a>
                            </center>
                        </div><!-- end col -->
             
                        <div class="col-sm-4 price--full">
                                <!-- Price table -->
                                <div class="price price--popular">
                                    <header class="price__head">
                                        <h4 class="price__package"><?php echo $name; ?></h4>
                                        <p class="price__descript" data-selector="p"><?php echo "Host : ".$host; ?></p>
                                    </header>
                                    <ul class="price__content">
                                        <li class="price-quality"><?php
                                        echo "Squid : ";
                                        if($squid != "0")
                                        {
                                            echo $squid;
                                        }
                                        else
                                            echo "NO";
                                        ?></li>
                                       <li class="price-quality">
                                        <?php
                                            echo "SSH : ";
                                            foreach($port as $config)
                                            {
                                                if($config->configuration_type == "SSH")
                                                {
                                                    echo $config->port." ";
                                                }
                                            }
                                        ?></li>
                                        <li class="price-quality">
                                        <p style="color:white">VPN UDP :
                                        <?php
                                            foreach($port as $config)
                                            {
                                                if($config->configuration_type == "UDP")
                                                { 
                                                    echo "$config->port ";
                                                }
                                            }
                                            echo "</p>";
                                        ?>
                                        <p style="color:white">VPN TCP :
                                        <?php
                                            foreach($port as $config)
                                            {
                                                if($config->configuration_type == "TCP")
                                                { 
                                                    echo "$config->port ";
                                                }
                                            }
                                            echo "</p>";
                                        ?></li>
                                        <li class="price-quality"><?php echo "$max_day Accounts / day"; ?></li>
                                        <li class="price-quality"><?php echo "Expired : $expired day"; ?></li>
                                    </ul>
                                    <footer>
                                        <form class="search search--light search--large" id="search-domain" name="search-domain" method="POST" action="<?php echo site_url("home/server_create/$id");?>">
                                            <input class="search__field" placeholder="username" value="" type="text" id="username" name="username">
                                             <input class="search__field" placeholder="password" value="" type="text" id="password" name="password">
                                             <br>
                                            <button class="search__field" type="submit" name="submit" id="submit" style="background-color:#85d6de; color:white">
                                              Create Free Account
                                            </button>
                                            <p id="loading" style="color:white;display:none">Loading. Please Wait..</p>
                                        </form>
                                    </footer>
                                </div>
                                <!-- end price table -->
                        </div><!-- end col -->
                        <div class="col-sm-4 price--full">
                                <!-- Price table -->
                                <!-- end price table -->
                                <div class="price" style="color:black">
                                    <header class="price__head">
                                        <h4 class="price__package">Account Information</h4>
                                    </header>
                                    <ul class="price__content" id="result">
                                        Account Information Will Appear HERE
                                    </ul>
                                </div>
                                <div class="price" style="color:black">
                                    <ul class="price__content" id="download_area">
                                        <h5>Download : </h5>
                                        <?php
                                        foreach($port as $row)
                                        {   
                                            if($row->configuration_type == "UDP")
                                            {
                                        ?>
                                            <a class="btn btn-primary btn-sm" href="<?php echo site_url("download/file/$row->id");?>" data-selector="a.btn">VPN UDP <?php echo $row->port;?></a>
                                        <?php   
                                            }
                                            elseif($row->configuration_type == "TCP")
                                            {
                                        ?>
                                            <a class="btn btn-primary btn-sm" href="<?php echo site_url("download/file/$row->id");?>" data-selector="a.btn">VPN TCP <?php echo $row->port;?></a>
                                        <?php }
                                        }
                                        ?>
                                    </ul>
                                </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
            </section>
        </div>
<!-- NEW BLOCK -->

<!-- 
<div class="block">
    <section class="container">            
        <div class="price-container">
                <div class="col-sm-4 price--full">
                    <center>
                        
                        <div class="price" style="color:black">
                            <ul class="price__content" id="social media">
                            <center>
                                    <div class="fb-page" data-href="https://www.facebook.com/tempatjualvpnsshmurah/?ref=ts&amp;fref=ts" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/tempatjualvpnsshmurah/?ref=ts&amp;fref=ts"><a href="https://www.facebook.com/tempatjualvpnsshmurah/?ref=ts&amp;fref=ts">White-VPS</a></blockquote></div></div>
                            </center>
                            </ul>
                        </div>
                    </center>
                </div>
     
                <div class="col-sm-8 price--full" >
                       
                       <div class="fb-comments" data-href="https://white-vps.com" data-numposts="7"></div>
                </div>
            </div>
    </section>
</div>
-->
