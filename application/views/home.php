</div><div class="block">
    <div class="container">
        <h2 class="block-title" data-selector="h2">Our Service</h2>
    <div class="row">
        <div class="col-sm-12 opposite-block">
            <div id="number-start">
                <!-- Default stat view -->
                <div class="stat-row">
                    <div class="stat stat--additional">
                        <span class="stat__number"><?php echo $sum_server; ?></span>
                        <i class="stat__icon fa fa-calendar-o" data-selector="i.fa"></i>
                        <p class="stat__dimension" data-selector="p">Server Available</p>
                    </div>
                    <div class="stat stat--additional">
                        <span class="stat__number"><?php echo $sum_server_asia; ?></span>
                        <i class="stat__icon fa fa-globe" data-selector="i.fa"></i>
                        <p class="stat__dimension" data-selector="p">ASIA Server</p>
                    </div>
                    <div class="stat stat--additional">
                        <span class="stat__number"><?php echo $sum_server_europe; ?></span>
                        <i class="stat__icon fa fa-globe" data-selector="i.fa"></i>
                        <p class="stat__dimension" data-selector="p">EUROPE Server</p>
                    </div>
                    <div class="stat stat--additional">
                        <span class="stat__number"><?php echo $sum_server_us;?></span>
                        <i class="stat__icon fa fa-globe" data-selector="i.fa"></i>
                        <p class="stat__dimension" data-selector="p">US Server</p>
                    </div>
                    <div class="stat stat--additional">
                        <span class="stat__number"><?php echo $account_created; ?></span>
                        <p class="stat__dimension" data-selector="p">Account Created</p>
                    </div>
                    <div class="stat stat--additional">
                        <span class="stat__number"><?php
                        date_default_timezone_set('Asia/Jakarta');
                        echo date("Y-m-d H:i:s"); ?></span>
                        <p class="stat__dimension" data-selector="p">Server Time</p>
                    </div>
                    <div class="stat stat--additional">
                        <span class="stat__number"><?php echo "00:01:00 (GMT + 7)"; ?></span>
                        <p class="stat__dimension" data-selector="p">Server Reset</p>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div><!-- end row -->
    <div class="devider-brand devider--top2x"></div>
    </div>

<center>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- halaman utama white vps -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-3273236229288524"
         data-ad-slot="6840243092"
         data-ad-format="auto"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</center>
<div class="block">
    <h2 class="block-title" data-selector="h2">ASIA Server</h2>
    <div class="container">
        <div class="row price-container">
            <?php foreach($server as $row)
            {
                if($row->location != "1")
                    continue;
            ?>
            <div class="col-sm-3">
                    <!-- Price table -->
                    <div class="price price--simple">
                        <header class="price__head">
                            <h4 class="price__package"><?php echo $row->name;?></h4>
                            <p class="price__descript" data-selector="p"><?php echo $row->host; ?></p>
                        </header>
                        <ul class="price__content">
                            <li class="price-quality">
                            <?php
                                echo "Squid : ";
                                if($row->squid_port == 0 )
                                    echo "NO";
                                else
                                    echo $row->squid_port;
                            ?></li>
                            <li class="price-quality">
                            <?php
                                echo "SSH : ";
                                foreach($port as $config)
                                {
                                    if($config->configuration_type == "SSH")
                                    {
                                        if($config->id_server == $row->id)
                                            echo $config->port." ";
                                    }
                                }
                            ?></li>
                            <li class="price-quality"><?php
                                echo "VPN TCP : ";
                                foreach($port as $config)
                                {
                                    if($config->configuration_type == "TCP")
                                    {
                                        if($config->id_server == $row->id)
                                            echo $config->port." ";
                                    }
                                }
                            ?></li>
                            <li class="price-quality"><?php
                                echo "VPN UDP : ";
                                foreach($port as $config)
                                {
                                    if($config->configuration_type == "UDP")
                                    {
                                        if($config->id_server == $row->id)
                                            echo $config->port." ";
                                    }
                                }
                            ?></li>
                            <li class="price-quality"><?php echo "$row->max_day Accounts / day"; ?></li>
                            <li class="price-quality"><?php echo "Expired : $row->expired_account day"; ?></li>
                        </ul>
                        <footer class="price__bottom">
                            <?php $server_name = strtolower($row->name); ?>
                            <a class="btn btn-primary btn--decorated price__btn" href="<?php echo site_url("home/server/$server_name");?>" data-selector="a.btn">Create Now</a>
                        </footer>
                    </div>
                    <!-- end price table -->
            </div><!-- end col -->
            <?php
            } 
            ?>
        </div><!-- end row -->
    </div>

<!-- Server Europe -->

<div class="block">
    <h2 class="block-title" data-selector="h2">EUROPE Server</h2>
    <div class="container">
        <div class="row price-container">
            <?php foreach($server as $row)
            {
                if($row->location != "2")
                    continue;
            ?>
            <div class="col-sm-3">
                    <!-- Price table -->
                    <div class="price price--simple">
                        <header class="price__head">
                            <h4 class="price__package"><?php echo $row->name;?></h4>
                            <p class="price__descript" data-selector="p"><?php echo $row->host; ?></p>
                        </header>
                        <ul class="price__content">
                            <li class="price-quality">
                            <?php
                                echo "Squid : ";
                                if($row->squid_port == 0 )
                                    echo "NO";
                                else
                                    echo $row->squid_port;
                            ?></li>
                            <li class="price-quality">
                            <?php
                                echo "SSH : ";
                                foreach($port as $config)
                                {
                                    if($config->configuration_type == "SSH")
                                    {
                                        if($config->id_server == $row->id)
                                            echo $config->port." ";
                                    }
                                }
                            ?></li>
                            <li class="price-quality"><?php
                                echo "VPN TCP : ";
                                foreach($port as $config)
                                {
                                    if($config->configuration_type == "TCP")
                                    {
                                        if($config->id_server == $row->id)
                                            echo $config->port." ";
                                    }
                                }
                            ?></li>
                            <li class="price-quality"><?php
                                echo "VPN UDP : ";
                                foreach($port as $config)
                                {
                                    if($config->configuration_type == "UDP")
                                    {
                                        if($config->id_server == $row->id)
                                            echo $config->port." ";
                                    }
                                }
                            ?></li>
                            <li class="price-quality"><?php echo "$row->max_day Accounts / day"; ?></li>
                            <li class="price-quality"><?php echo "Expired : $row->expired_account day"; ?></li>
                        </ul>
                        <footer class="price__bottom">
                            <?php $server_name = strtolower($row->name); ?>
                            <a class="btn btn-primary btn--decorated price__btn" href="<?php echo site_url("home/server/$server_name");?>" data-selector="a.btn">Create Now</a>
                        </footer>
                    </div>
                    <!-- end price table -->
            </div><!-- end col -->
            <?php
            } 
            ?>
        </div><!-- end row -->
    </div>
<!-- US Server -->

<div class="block">
    <h2 class="block-title" data-selector="h2">US Server</h2>
    <div class="container">
        <div class="row price-container">
            <?php foreach($server as $row)
            {
                if($row->location != "3")
                    continue;
            ?>
            <div class="col-sm-3">
                    <!-- Price table -->
                    <div class="price price--simple">
                        <header class="price__head">
                            <h4 class="price__package"><?php echo $row->name;?></h4>
                            <p class="price__descript" data-selector="p"><?php echo $row->host; ?></p>
                        </header>
                        <ul class="price__content">
                            <li class="price-quality">
                            <?php
                                echo "Squid : ";
                                if($row->squid_port == 0 )
                                    echo "NO";
                                else
                                    echo $row->squid_port;
                            ?></li>
                            <li class="price-quality">
                            <?php
                                echo "SSH : ";
                                foreach($port as $config)
                                {
                                    if($config->configuration_type == "SSH")
                                    {
                                        if($config->id_server == $row->id)
                                            echo $config->port." ";
                                    }
                                }
                            ?></li>
                            <li class="price-quality"><?php
                                echo "VPN TCP : ";
                                foreach($port as $config)
                                {
                                    if($config->configuration_type == "TCP")
                                    {
                                        if($config->id_server == $row->id)
                                            echo $config->port." ";
                                    }
                                }
                            ?></li>
                            <li class="price-quality"><?php
                                echo "VPN UDP : ";
                                foreach($port as $config)
                                {
                                    if($config->configuration_type == "UDP")
                                    {
                                        if($config->id_server == $row->id)
                                            echo $config->port." ";
                                    }
                                }
                            ?></li>
                            <li class="price-quality"><?php echo "$row->max_day Accounts / day"; ?></li>
                            <li class="price-quality"><?php echo "Expired : $row->expired_account day"; ?></li>
                        </ul>
                        <footer class="price__bottom">
                            <?php $server_name = strtolower($row->name); ?>
                            <a class="btn btn-primary btn--decorated price__btn" href="<?php echo site_url("home/server/$server_name");?>" data-selector="a.btn">Create Now</a>
                        </footer>
                    </div>
                    <!-- end price table -->
            </div><!-- end col -->
            <?php
            } 
            ?>
        </div><!-- end row -->
    </div>

