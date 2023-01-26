<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Connect Mind</title>
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/css/cheque.css">
</head>

<body>
    <div class="check">
        <div class="border">
            <div class="container-cheque">
                <div class="content">
                    <div class="one">
                        <div class="title">
                            <div id="bold">MY CONNECT MIND</div>
                            <div class="name">My Connect Mind <br></div>
                        </div>
                        <table class="following">
                            <tr>
                                <td class="line">This check is in payment of the following</td>
                            <tr>
                                <td class="empty line"><input type="text" name="reason" PLACEHOLDER="<?=$retiro->nombre?>"
                                        size="13" readonly></td>
                            <tr>
                                <td class="empty line"><input type="text" name="reason2" PLACEHOLDER="<?=$retiro->apellido1?>" size="13" readonly></td>

                        </table>

                        <div class="number"><?=$retiro->id?></div>
                    </div>




                    <div class="orderof"><input type="text" PLACEHOLDER="$<?=$retiro->valor?>" name="amount" size="15" readonly><span
                            class="dollar"><span class="bd">*********************</span>dollars</span></div>
                    <table class="info">
                        <thead>
                            <tr>

                                <th class="chart">Fecha</th>
                                <th class="chart">a nombre de</th>
                                <th class="chart">check no.</th>
                                <th class="chart">Descripcion</th>
                                <th class="chart" id="discount">discount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td class="blank short"><input type="text" PLACEHOLDER="<?=$retiro->fecha?>" name="date" readonly>
                                </td>
                                <td class="blank long"><input type="text" PLACEHOLDER="<?=$retiro->nombre?> <?=$retiro->apellido1?>" name="name"
                                        size="15" readonly></td>
                                <td class="blank short"><input type="text" PLACEHOLDER="<?=$retiro->id?>" name="num" size="15" readonly></td>
                                <td class="blank long des"><input type="text" PLACEHOLDER="Retiro Billetera Principal"
                                        name="description" size="15" readonly></td>
                                <td class="short" id="discount"><input type="text" PLACEHOLDER="null" name="discount"
                                        size="15" readonly></td>
                            </tr>
                        </tbody>
                        </tr>
                        </tbody>
                    </table>

                    <div class="amount">
                        <span class="amounts">
                            <p>check</p>
                            <p>amount</p>
                        </span>
                        <div class="sign">
                            </div>
                        <div class="box">
                            <div class="whole"><input type="text" name="whole" placeholder="$  <?=$retiro->valor?>" size="13" readonly><input
                                    type="text" placeholder="00" name="cent" size="13" readonly></div>
                            <div class="cent"></div>
                        </div>
                    </div>
                    <table class="add">
                        <td class="lines"><input type="text" PLACEHOLDER="######" name="address" size="13" readonly></td>
                        <tr>
                            <td class="lines"><input type="text" PLACEHOLDER="######" name="citystate"
                                    size="13" readonly></td>
                        <tr>
                            <td class="bank">Bank Name, N.A.</td>
                    </table>
                    <table class="signature">
                        <td class="sig"></td>
                        <tr>
                            <td class="mp"></td>
                    </table>



                </div>


            </div>
        </div>
    </div>


</body>

</html>