<div class="page_title">
  <div class="container">
    <div class="title"><h1>OpenVPN </h1></div>
        <div class="pagenation">&nbsp;<a href="<?php echo site_url();?>">Home</a> <i>/</i> <a href="<?php echo site_url("order"); ?>">Plans & Pricing</a></div>
  </div>
</div><!-- end page title --> 

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
 