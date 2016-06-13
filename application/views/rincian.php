<section class="page-title">
    <div class="container">
        <div class="inner">
          <div class="column">
            <div class="title">
              <h1>Rincian Harga</h1>
            </div><!-- .title -->
          </div><!-- .column -->
          <div class="column">
            <div class="breadcrumbs">
              <a href="<?php echo site_url(); ?>">Home</a>
              <span class="delimiter"><i class="icon-arrow-right"></i></span>
              <span>Rincian Harga</span>
            </div><!-- .breadcrumbs -->
          </div><!-- .column -->
        </div>
    </div>
</section><!-- .page-title -->
<div class="container">
    <div class="pricing-table ">
          <table class="table-hover">
            <tbody>
            <tr>
              <td class="text-gray text-right" width="200px">Invoice : </td>
              <td class="text-bold"><?php if(!empty($invoice)){echo $invoice;}?></td>
            </tr>
            <tr>
              <td class="text-gray text-right" width="200px">Produk : </td>
              <td class="text-bold"><?php if(!empty($product)){echo $product;}?></td>
            </tr>
            <tr>
              <td class="text-gray text-right">Harga :</td>
              <td class="text-bold"><?php if(!empty($price)){echo $price;} ?></td>
            </tr>
            <tr>
              <td class="text-gray text-right">Angka Unik :<br><p style="color:red">*untuk sistem pembayaran otomatis</p></td>
              <td class="text-bold"><?php if(!empty($uniq_number)){echo $uniq_number;} ?></td>
            </tr>
            <tr>
              <td class="text-gray text-right">Total Pembayaran :</td>
              <td class="text-bold"><?php if(!empty($price_total)){echo "<strong style='color:red'>$price_total</strong>";} ?></td>
            </tr>
            <tr>
                <td class="text-gray text-right">Pembayaran</td>
                <td class="text-bold"></td>
            </tr>
            <tr>
                <td class="text-gray text-right">Pulsa XL :<br>0877-3309-2188</td>
                <td class="text-bold"><?php if($product=="Premium Credits"){echo $price + 5000;}else{ echo "Not Available";}?></td>
            </tr>
            <tr>
                <td class="text-gray text-right">Bank Mandiri :<br>a.n. Randy Bastian</td>
                <td class="text-bold">1-350-009-920594</td>
            </tr>
            <tr>
                <td class="text-gray text-right">Bank BNI :<br>a.n. Randy Bastian</td>
                <td class="text-bold">0334-1528-29</td>
            </tr>
          </tbody></table><!-- table -->
    </div>
    <p style="color:red">*Pembayaran melalui pulsa XL hanya berlaku untuk Premium Credits.<br>*Silahkan melakukan konfirmasi pembayaran jika anda melakukan pembayaran melalui pulsa.<br>*Transaksi akan dihapus (cancel) jika anda tidak melakukan pembayaran hingga 2 x 24 berikutnya.</p>
</div>