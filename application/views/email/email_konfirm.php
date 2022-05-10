<!DOCTYPE html>
<html lang="id"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>TIKET ID {tiket_id}</title>
</head>
<body>

<div style="width: 596px; border: 1px solid #000;">
    <table style="table-layout: fixed; border-collapse: collapse; border-spacing: 0; font-weight: bold;">
        <colgroup>
            <col style="width: 60%;">
            <col style="width: 30%;">
            <col style="width: 10%;">
        </colgroup>
        <tbody>
        <tr>
            <th rowspan="2" style="text-align: left; font-family: OneSlot; font-size: 14px; font-weight: normal; overflow: hidden; word-break: normal; padding: 10px 5px;" align="left">
              <img src="<?php echo base_url().'assets/uploads/files/images-removebg-preview.png';?>" width="250" alt="logo">
            </th>
            <th style="font-family: OneSlot; font-size: 14px; font-weight: normal; overflow: hidden; word-break: normal; vertical-align: top; padding: 10px 5px;" valign="top">
                <div style="width: 50%; float: right; text-align: center; padding: 10px 0; border: 2px solid #000;" align="center"><b>sfdfd</b></div>
            </th>
            <th rowspan="5" style="text-align: left; font-family: OneSlot; font-size: 14px; font-weight: normal; overflow: hidden; word-break: normal; padding: 10px 5px;" align="left">
                
                <div style="margin-right: 10px; margin-left: 25px;">
                    <img src="<?=$barcode?>" height="150px" width="150px">
                </div>
            </th>
        </tr>
        <tr>
            <td style="text-align: right; font-family: OneSlot; font-size: 14px; overflow: hidden; word-break: normal; vertical-align: top; padding: 10px 5px;" align="right" valign="top">{tanggal}</td>
        </tr>
        <tr>
            <td colspan="2" style="font-family: OneSlot; font-size: 14px; overflow: hidden; word-break: normal; padding: 10px 5px;">Tiket wahana : <h2>{wahana}</h2>
            </td>
        </tr>
        <tr>
            <td style="font-family: OneSlot; font-size: 14px; overflow: hidden; word-break: normal; vertical-align: top; padding: 10px 5px;" valign="top">Nama kelompok : <br>
                <h3>{nama}</h3>
            </td>
            <td rowspan="2" style="font-family: OneSlot; font-size: 14px; overflow: hidden; word-break: normal; vertical-align: top; padding: 10px 5px;" valign="top">
                <div style="text-align: right;" align="right">Jumlah Orang</div>
                <br>
                <div style="width: 50%; float: right; text-align: center; padding: 10px 0; border: 2px solid #000;" align="center"> {jumlah}</div>
            </td>
        </tr>
        <tr>
            <td style="font-family: OneSlot; font-size: 14px; overflow: hidden; word-break: normal; vertical-align: top; padding: 10px 5px;" valign="top">Tiket yang sudah dibeli tidak dapat ditukar</td>
        </tr>
        </tbody>
    </table>
</div>


</body></html>