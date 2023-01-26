<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/css/cheque.css">
</head>

<body>
    <div class="check">
        <div class="border">
            <div class="container-cheque">
                <div class="content">
                    <div class="one">
                        <div class="title">
                            <div id="bold">OWNERS NAME </div>
                            <div class="name">COMPANY NAME <br>COMPANY ADDRESS<br> CITY, STATE ZIP</div>
                        </div>
                        <table class="following">
                            <tr>
                                <td class="line">This check is in payment of the following</td>
                            <tr>
                                <td class="empty line"><input type="text" name="reason" placeholder="INSERT_MEMO"
                                        size="13"></td>
                            <tr>
                                <td class="empty line"><input type="text" name="reason2" size="13"></td>

                        </table>

                        <div class="number">0000</div>
                    </div>




                    <div class="orderof"><input type="text" placeholder="INSERT_AMOUNT" name="amount" size="15"><span
                            class="dollar"><span class="bd">*********************</span>dollars</span></div>
                    <table class="info">
                        <thead>
                            <tr>

                                <th class="chart">date</th>
                                <th class="chart">to the order of</th>
                                <th class="chart">check no.</th>
                                <th class="chart">description</th>
                                <th class="chart" id="discount">discount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td class="blank short"><input type="text" PLACEHOLDER="  /  /  " name="date" size="15">
                                </td>
                                <td class="blank long"><input type="text" PLACEHOLDER="INSERT_NAME" name="name"
                                        size="15"></td>
                                <td class="blank short"><input type="text" PLACEHOLDER="0000" name="num" size="15"></td>
                                <td class="blank long des"><input type="text" PLACEHOLDER="INSERT_MEMO"
                                        name="description" size="15"></td>
                                <td class="short" id="discount"><input type="text" PLACEHOLDER="INSERT" name="discount"
                                        size="15"></td>
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
                            $</div>
                        <div class="box">
                            <div class="whole"><input type="text" name="whole" placeholder="0000" size="13"><input
                                    type="text" placeholder="00" name="cent" size="13"></div>
                            <div class="cent"></div>
                        </div>
                    </div>
                    <table class="add">
                        <td class="lines"><input type="text" PLACEHOLDER="INSERT_ADDRESS" name="address" size="13"></td>
                        <tr>
                            <td class="lines"><input type="text" PLACEHOLDER="CITY, STATE ZIP" name="citystate"
                                    size="13"></td>
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