<section class="page-title">
    <div class="container">
        <div class="inner">
          <div class="column">
            <div class="title">
              <h1>Daftar Harga</h1>
            </div><!-- .title -->
          </div><!-- .column -->
          <div class="column">
            <div class="breadcrumbs">
              <a href="<?php echo site_url(); ?>">Home</a>
              <span class="delimiter"><i class="icon-arrow-right"></i></span>
              <span>Daftar Harga</span>
            </div><!-- .breadcrumbs -->
          </div><!-- .column -->
        </div>
    </div>
</section><!-- .page-title -->

<div class="container">
    <div class="pricing-table space-top">
          <table>
            <colgroup>
              <col>
              <col>
              <col class="featured">
            </colgroup>
            <tbody><tr>
              <td>&nbsp;</td>
              <td>
                <span class="text-bold">Premium Credits</span>
                <span class="text-gray space-top">For the home page, Internet Identity.</span>
                <a href="#" class="text-sm space-top">Buy now</a>
              </td>
              <td>
                <span class="img-icon"><img src="<?php echo site_url();?>assets/front/img/pricing/icon.png" alt="Featured Plan"></span>
                <span class="text-bold">Mega Credits</span>
                <span class="text-gray space-top">Allows you to place a standard site.</span>
                <a href="#" class="text-sm space-top">Buy now</a>
              </td>
              <td>
                <span class="text-bold">Ultimate Credits</span>
                <span class="text-gray space-top">Optimal solution for a news portal, shop.</span>
                <a href="#" class="text-sm space-top">Buy now</a>
              </td>
              
            </tr>
            <tr>
              <td class="text-gray text-right">Credits (<a target="_blank" style="color:red" href="<?php echo site_url("knowledge"); ?>">Apa itu Credit <i class="fa fa-question fa-lg"></i></a> )</td>
              <td class="text-bold">1 </td>
              <td class="text-bold">6</td>
              <td class="text-bold">12</td>
              
            </tr>
            <tr>
              <td class="text-gray text-right">Subdomains</td>
              <td class="text-bold">2</td>
              <td class="text-bold">5</td>
              <td class="text-bold">30</td>
             
            </tr>
            <tr>
              <td class="text-gray text-right">Disk space</td>
              <td class="text-bold">500 MB</td>
              <td class="text-bold">1 GB</td>
              <td class="text-bold">10 GB</td>
              
            </tr>
            <tr>
              <td class="text-gray text-right">Bandwidth</td>
              <td class="text-bold"><span class="infinity"></span></td>
              <td class="text-bold"><span class="infinity"></span></td>
              <td class="text-bold"><span class="infinity"></span></td>
             
            </tr>
            <tr>
              <td class="text-gray text-right">PHP support</td>
              <td class="text-bold"><span class="not-available"></span></td>
              <td class="text-bold"><span class="available"></span></td>
              <td class="text-bold"><span class="available"></span></td>
              
            </tr>
            <tr>
              <td class="text-gray text-right">Annual cost</td>
              <td class="text-bold">$9.99</td>
              <td class="text-bold">$15.99</td>
              <td class="text-bold">$29.99</td>
            </tr>
          </tbody></table><!-- table -->
        </div>
</div>

<div class="clearfix"></div>

<div class="pricing-tables-main">
    <div class="mar_top3"></div>
    <div class="clearfix"></div>

<?php
foreach($order as $o)
{
?>
    <div class="pricing-tables-helight-two">
        <div class="title"><?php echo $o->name;?></div>
        <div class="price"> 
        <?php 
        $long_string    = strlen($o->price_idr);
        $long_string    = $long_string - 3;
        $first_char     = substr($o->price_idr,0, $long_string);
        $last_char      = substr($o->price_idr, -3);
        echo "Rp $first_char.$last_char,00";
        ?></div>
        <div class="cont-list">
            <ul>
                <li><?php echo $o->description;?> | <a href="<?php echo site_url("knowledge"); ?>">What <i class="fa fa-question fa-lg"></i></a></li>
                <li>Unlimited Bandwidth</li>
                <li>OpenVPN Windows / Linux / Mac</li>
                <li>OpenVPN Android / iOS</li>
                <li>Secure Connection</li>
                <li>Anonymous</li>
                <li>Stable</li>
                <li>No Log</li>
                <li>Fast</li>
                <li>Unblock Website</li>
                <li>Play Online Game</li>
                <li>Streaming Video</li>
                <li><strong>Payment</strong> : Credit Card, Bank Transfer, <strong>Indomaret</strong></li>
                <li>1 Account/s for All Server</li>
                
            </ul>
        </div>
        <div class="ordernow"><a href="<?php echo site_url("order/process/$o->id"); ?>" class="normalbut">Order Now</a></div>
    </div><!-- end section -->
<?php
}
?>
</div><!-- end pricing tables with 3 columns -->
 