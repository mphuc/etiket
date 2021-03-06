<!DOCTYPE html>
<html>
<head>
    <title>Email Tiket Museum Nasional Indonesia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body style="font-family: arial; font-size: 14px;">

<div class="container" style="width: 480px; text-align: center; border-top-color: #1c7a8a; padding: 10px; border-style: solid dashed dashed; border-width: 5px 1px 1px; @media (max-width:768px){width: 99%;} " align="center">
    <header style="text-align: center;">
        <h2>Selamat, Pemesanan tiket Anda berhasil</h2>
    </header>
    <section class="box-kode" style="text-align: center;">
        <table align="center">
            <tr>
                <td class="">
                    <img width="100%" src="https://lpmp-sumut.kemdikbud.go.id/wp-content/uploads/2020/04/Logo-Kemdikbud.png" alt="logo kemendikbud">
                </td>
            </tr>
            <tr>
                <td class="">Invoice Tiket :</td>
            </tr>
            <tr>
                <td class="border" style="background-color: #e8e8e8; font-size: 26px; padding: 10px 20px; border: 1px solid #e8e8e8;" bgcolor="#e8e8e8"><b><a href="<?=$invoice?>"><?=$kode?></a></b></td>
            </tr>
        </table>
    </section>

    <section style="text-align: center;">
        <h4 style="margin-bottom: 5px; font-weight: 100;">Detail Pemesanan Tiket :</h4>
        <table align="center" class="detail" width="100%">
            <thead>
            <tr class="head">
                <td style="border-collapse: width: 25%; collapse; background-color: #e8e8e8; padding: 5px; border: 1px solid #e8e8e8;" bgcolor="#e8e8e8">No</td>
                <td style="border-collapse: width: 25%; collapse; background-color: #e8e8e8; padding: 5px; border: 1px solid #e8e8e8;" bgcolor="#e8e8e8">Jenis</td>
                <td style="border-collapse: width: 25%; collapse; background-color: #e8e8e8; padding: 5px; border: 1px solid #e8e8e8;" bgcolor="#e8e8e8">jumlah</td>
                <td style="border-collapse: width: 25%; collapse; background-color: #e8e8e8; padding: 5px; border: 1px solid #e8e8e8;" bgcolor="#e8e8e8">Harga</td>
            </tr>
            </thead>
            <tbody>
            <!-- {detail_transaksi}
            <tr>
                <td style="border-collapse: collapse; padding: 5px; border: 0;">{no}</td>
                <td style="border-collapse: collapse; padding: 5px; border: 0;">{tipe_tiket}</td>
                <td style="border-collapse: collapse; padding: 5px; border: 0;">{jumlah}</td>
                <td style="border-collapse: collapse; padding: 5px; border: 0;">Rp {harga_format}</td>
            </tr>
            {/detail_transaksi} -->
            
            <?php
                $i = 1;
                foreach ($detail as $key => $value) {
                    # code...
                    ?>
                        <tr>
                            <td style="border-collapse: collapse; padding: 5px; border: 0;"><?=$i++?></td>
                            <td style="border-collapse: collapse; padding: 5px; border: 0;"><?=$value->product_title?></td>
                            <td style="border-collapse: collapse; padding: 5px; border: 0;"><?=$value->transaction_detail_qty?></td>
                            <td style="border-collapse: collapse; padding: 5px; border: 0;"><?=$value->transaction_detail_subtotal?></td>
                        </tr>
                    <?php
                }

            ?>

            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" align="right" style="border-collapse: collapse; padding: 5px; border: 0;">Sub Total</td>
                <td style="border-collapse: collapse; padding: 5px; border: 0;"><?=$total?></td>
            </tr>
            <tr>
                <td colspan="3" align="right" style="border-collapse: collapse; padding: 5px; border: 0;"><b>Total Yang Harus dibayar</b></td>
                <td style="border-collapse: collapse; padding: 5px; border: 0;">
                    <b><?=$total?></b></td>
            </tr>
            </tfoot>
        </table>
    </section>
    <br><hr>
    <br>
    <footer>
        <p>Jl. Medan Merdeka Barat No.12, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta, Indonesia<br><a href="https://www.museumnasional.or.id/">www.museumnasional.or.id</a></p>
    </footer>
</div>
</body>
</html>
