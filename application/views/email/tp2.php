<!DOCTYPE html>
<html>
<head>
    <title>Header Email Taman Pintar</title>

</head>
<body style="font-family: arial; font-size: 14px;">

<div class="container" style="width: 480px; text-align: center; border-top-color: #1c7a8a; padding: 10px; border-style: solid dashed dashed; border-width: 5px 1px 1px; @media (max-width:768px){width: 99%;} " align="center">
    <header style="text-align: center;">
        <h2>Selamat, Pemesanan Tiket Berhasil</h2>
    </header>
    <section class="box-kode" style="text-align: center;">
        <table align="center">
            <tr>
                <td class="">
                    <img src="{logo_tamanpintar}" alt="logo taman pintar">
                </td>
            </tr>
            <tr>
                <td class="">Kode Transaksi Tiket :</td>
            </tr>
            <tr>
                <td class="border" style="background-color: #e8e8e8; font-size: 26px; padding: 10px 20px; border: 1px solid #e8e8e8;" bgcolor="#e8e8e8"><b>{kode_transaksi}</b></td>
            </tr>
        </table>
    </section>

    <section style="text-align: center;">
        <h4 style="margin-bottom: 5px; font-weight: 100;">Detail Transaksi Tiket :</h4>
        <table align="center" class="detail" width="100%">
            <thead>
            <tr class="head">
                <td style="border-collapse: collapse; background-color: #e8e8e8; padding: 5px; border: 1px solid #e8e8e8;" bgcolor="#e8e8e8">No</td>
                <td style="border-collapse: collapse; background-color: #e8e8e8; padding: 5px; border: 1px solid #e8e8e8;" bgcolor="#e8e8e8">Nama Wahana</td>
                <td style="border-collapse: collapse; background-color: #e8e8e8; padding: 5px; border: 1px solid #e8e8e8;" bgcolor="#e8e8e8">Jenis</td>
                <td style="border-collapse: collapse; background-color: #e8e8e8; padding: 5px; border: 1px solid #e8e8e8;" bgcolor="#e8e8e8">jumlah</td>
                <td style="border-collapse: collapse; background-color: #e8e8e8; padding: 5px; border: 1px solid #e8e8e8;" bgcolor="#e8e8e8">Harga</td>
            </tr>
            </thead>
            <tbody>
            {detail_transaksi}
            <tr>
                <td style="border-collapse: collapse; padding: 5px; border: 0;">{no}</td>
                <td align="left" style="border-collapse: collapse; padding: 5px; border: 0;">{nama_jenis_wahana}</td>
                <td style="border-collapse: collapse; padding: 5px; border: 0;">{tipe_tiket}</td>
                <td style="border-collapse: collapse; padding: 5px; border: 0;">{jumlah}</td>
                <td style="border-collapse: collapse; padding: 5px; border: 0;">Rp {harga_format}</td>
            </tr>
            {/detail_transaksi}
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4" align="right" style="border-collapse: collapse; padding: 5px; border: 0;">Sub Total</td>
                <td style="border-collapse: collapse; padding: 5px; border: 0;">Rp {total_transaksi}</td>
            </tr>
            <?php if($biaya_tambahan > 0):?>
                <tr>
                    <td colspan="4" align="right" style="border-collapse: collapse; padding: 5px; border: 0;"><b>Biaya Administrasi</b></td>
                    <td style="border-collapse: collapse; padding: 5px; border: 0;">
                        <b>Rp {biaya_tambahan}</b></td>
                </tr>
            <?php endif;?>
            <tr>
                <td colspan="4" align="right" style="border-collapse: collapse; padding: 5px; border: 0;"><b>Total Yang Harus dibayar</b></td>
                <td style="border-collapse: collapse; padding: 5px; border: 0;">
                    <b>Rp {total_bayar}</b></td>
            </tr>
            </tfoot>
        </table>
    </section>
    <br><hr>
    <p>{pesan_tranfer_rekening}</p>
    <br><hr>
    <br>
    <footer>
        <div style="float: left;">
            <a href="{company_facebook}"><img src="{logo_facebook}" height="36px"></a>
            <a href="{company_twitter}"><img src="{logo_twitter}" height="36px"></a>
            <a href="{company_telephone}"><img src="{logo_telpon}" height="36px"></a>
            <a href="{company_email}"><img src="{logo_sms}" height="36px"></a>
        </div>
        <div style="float: right;">
            <a href="{company_google_playstore}"><img src="{logo_playstore}" height="36px;"></a>
        </div>
        <br><br><br>
        <p>Alamat : {company_address}<br><a href="https://tamanpintar.co.id">tamanpintar.co.id</a></p>
    </footer>
</div>
</body>
</html>
