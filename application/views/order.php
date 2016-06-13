<section class="page-title">
    <div class="container">
        <div class="inner">
          <div class="column">
            <div class="title">
              <h1>Daftar Harga OpenVPN</h1>
            </div><!-- .title -->
          </div><!-- .column -->
          <div class="column">
            <div class="breadcrumbs">
              <a href="<?php echo site_url(); ?>">Home</a>
              <span class="delimiter"><i class="icon-arrow-right"></i></span>
              <span>Daftar Harga OpenVPN</span>
            </div><!-- .breadcrumbs -->
          </div><!-- .column -->
        </div>
    </div>
</section><!-- .page-title -->
<?php
if(!empty($order))
{
    $no = 0;
    $name = "";
    $harga= "";
    foreach($order as $o)
    {
        $name[$no]  = strtolower(str_replace(" ","-",$o->name));
        $harga[$no] = $o->id;
        $no++;
    }
}
?>
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
                <span class="text-gray space-top">Cukup untuk Sebulan.</span>
                <a href="<?php echo site_url("order/process/$harga[0]/$name[0]"); ?>" class="text-sm space-top" style="color:red">Beli Sekarang</a>
              </td>
              <td>
                <span class="img-icon"><img src="<?php echo site_url();?>assets/front/img/pricing/icon.png" alt="Featured Plan"></span>
                <span class="text-bold">Mega Credits</span>
                <span class="text-gray space-top">Puas untuk 6 bulan.</span>
                <a href="<?php echo site_url("order/process/$harga[1]/$name[1]"); ?>" class="text-sm space-top" style="color:red">Beli Sekarang</a>
              </td>
              <td>
                <span class="text-bold">Ultimate Credits</span>
                <span class="text-gray space-top">Mantap dah 1 tahun.</span>
                <a href="<?php echo site_url("order/process/$harga[2]/$name[2]"); ?>" class="text-sm space-top" style="color:red">Beli Sekarang</a>
              </td>
              
            </tr>
            <tr>
              <td class="text-gray text-right">Credits (<a target="_blank" style="color:red" href="<?php echo site_url("knowledge"); ?>">Apa itu Credit <i class="fa fa-question fa-lg"></i></a> )</td>
              <td class="text-bold">1 </td>
              <td class="text-bold">6</td>
              <td class="text-bold">12</td>
            </tr>
            <tr>
              <td class="text-gray text-right">Bandwidth</td>
              <td class="text-bold"><span class="infinity"></span></td>
              <td class="text-bold"><span class="infinity"></span></td>
              <td class="text-bold"><span class="infinity"></span></td>
            </tr>
            <tr>
              <td class="text-gray text-right">Streaming Video</td>
              <td class="text-bold"><span class="available"></span></td>
                <td class="text-bold"><span class="available"></span></td>
                <td class="text-bold"><span class="available"></span></td>
            </tr>
            <tr>
              <td class="text-gray text-right">Online Game</td>
              <td class="text-bold"><span class="available"></span></td>
                <td class="text-bold"><span class="available"></span></td>
                <td class="text-bold"><span class="available"></span></td>
            </tr>
            <tr>
                <td class="text-gray text-right">OpenVPN Windows / Linux / Mac</td>
                <td class="text-bold"><span class="available"></span></td>
                <td class="text-bold"><span class="available"></span></td>
                <td class="text-bold"><span class="available"></span></td>
            </tr>
            <tr>
                <td class="text-gray text-right">OpenVPN Android / iOS / Windows Phone</td>
                <td class="text-bold"><span class="available"></span></td>
                <td class="text-bold"><span class="available"></span></td>
                <td class="text-bold"><span class="available"></span></td>
            </tr>
            <tr>
                <td class="text-gray text-right">Pembayaran Via Bank</td>
                <td class="text-bold"><span class="available"></span></td>
                <td class="text-bold"><span class="available"></span></td>
                <td class="text-bold"><span class="available"></span></td>
            </tr>
            <tr>
                <td class="text-gray text-right">Pembayaran Via Pulsa</td>
                <td class="text-bold"><span class="available"></span></td>
                <td class="text-bold"><span class="not-available"></span></td>
                <td class="text-bold"><span class="not-available"></span></td>
            </tr>
            <tr>
              <td class="text-gray text-right">Harga</td>
              <td class="text-bold"><strike>Rp. 40.000</strike><br>Rp. 35.000</td>
              <td class="text-bold"><strike>Rp. 230.000</strike><br>Rp. 200.000</td>
              <td class="text-bold"><strike>Rp. 410.000</strike><br>Rp. 390.000</td>
            </tr>
          </tbody></table><!-- table -->
        </div>
</div>
 