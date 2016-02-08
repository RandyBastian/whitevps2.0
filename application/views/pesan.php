<div class="page_title">
  <div class="container">
    <div class="title"><h1>Order Detail</h1></div>
        <div class="pagenation">&nbsp;<a href="<?php echo site_url();?>">Home</a> <i>/</i> <a href="<?php echo site_url("order"); ?>">Order</a> <i>/</i> Transaction Status</div>
  </div>
</div><!-- end page title --> 

<center>
	<h2>
<?php
if(!empty($pesan))
{
	echo "$pesan";
}
?></h2>
</center>