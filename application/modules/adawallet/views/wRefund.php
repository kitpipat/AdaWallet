<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo language('adawallet/main/main', 'tRefund') . " " . language('adawallet/main/main', 'tAdw') ?></title>

        <link rel="stylesheet" href="<?php echo base_url(); ?>node_modules/jquery/dist/jquery.slim.min.js">
        <link rel="stylesheet" href="<?php echo base_url(); ?>node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>node_modules/bootstrap/dist/js/bootstrap.bundle.min.js">
        <link rel="stylesheet" href="<?php echo base_url(); ?>node_modules/bootstrap-icons/font/bootstrap-icons.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/modules/common/assets/css/localcss/ada.fonts.css">
        <link rel="stylesheet" href="<?php echo base_url('application/modules/adawallet/assets/css/localcss/Ada.Navbar.css'); ?>" />

    </head>

    <body>
        <div class="container mt-3 mb-2">
            <div class="row">
            <div class="col align-self-center">
                <?php echo language('adawallet/main/main', 'tProgram') . " : " . language('adawallet/main/main', 'tRefund') . " " . language('adawallet/main/main', 'tAdw') ?>
            </div>
            <div class="col-auto">
                <div class="sl-nav">
                <ul>
                    <li><i class="bi bi-globe"></i>
                    <div class="triangle"></div>
                    <ul>
                        <li>
                        <a href="?lang=th"> <?php echo language('adawallet/main/main', 'tthai') ?> </a>
                        </li>
                        <li>
                        <a href="?lang=en"> <?php echo language('adawallet/main/main', 'teng') ?> </a>
                        </li>
                    </ul>
                    </li>
                </ul>
                </div>
            </div>
            </div>
        </div>

        <div class="container" id="odvCheckandTop">
            <div class="row justify-content-center">
                <!-- <input type="hidden" class="form-control" name="ohdLineOA" id="ohdLineOA" value="@677trvja"> -->

                <div class="col-md-12 mb-2" id="odvCheckbalance">
                    <div class="card mt-2">
                        <div class="card-body xWCard">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto">
                                    <h3 class="card-text"><?php echo language('adawallet/main/main', 'tAdw') ?></h3>
                                </div>
                                <div class="col-auto "> 
                                    <p id="obpCardtype" class="card-subtitle text-muted"><?php echo language('adawallet/main/main', 'tCardTyp') ?></p>
                                </div>
                            </div>
                            <p id="obpNoti"><?php echo language('adawallet/main/main', 'tNoti') ?></p>
                            <p id="obpCardno" class="card-subtitle mb-1 text-muted"><?php echo language('adawallet/main/main', 'tRefNo') ?></p>
                            <p id="obpBal" class="card-subtitle mt-1 text-muted"><?php echo language('adawallet/main/main', 'tBalance') ?> (<?php echo language('adawallet/main/main', 'tTHB') ?>) </p>
                            <h3 id="obpBalance" class="card-text"></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center xWBorder">
                <div class="col-8">
                    <input type="submit" name="osmConfirm" id="osmConfirm" value="<?php echo language('adawallet/main/main', 'tConfirmRefund') ?>" class="btn xWBtnMain mx-auto">
                </div>
            </div>
        </div>

        <div class="container" id="odvResult">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h2 id="obhResult" class="mb-1"><?php echo language('adawallet/main/main', 'tRefundSuccess') ?></h2>
                    <label id="obpNotiResult"><b><?php echo language('adawallet/main/main', 'tRefundNoti') ?></b></label>
                    <br>
                    <label id="obpCardResult"><?php echo language('adawallet/main/main', 'tRefNo') ?> : </label>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-8">
                    <input type="submit" name="osmFinish" id="osmFinish" value="<?php echo language('adawallet/main/main', 'tFinish') ?> " class="btn xWBtnMain mx-auto" onclick="liff.closeWindow();">
                </div>
            </div>
        </div>


        

        <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>

            document.getElementById('odvCheckbalance').style.display = "none";
            document.getElementById('osmConfirm').style.display = "none";              
            document.getElementById('odvResult').style.display = "none";

            var tUserid = '';
            // var tLineoa = document.getElementById("ohdLineOA").value;
            var tBalance = '';
            var tRandom = '';
            var tRandom2 = '';
            var tInvoiceID = '';

            async function JSaADWCheckBalance() {
            // const profile = await liff.getProfile()
            //     tUserid = profile.userId;
                tUserid = "Ua8123e603500c93fc05b40ae4fc5f58a";

                $.ajax({
                    url: "<?php echo base_url('adwADWShowRefund/') ?>",
                    type: "POST",
                    data: {
                        "ptCstLineID": tUserid,
                        // "ptOAID": tLineoa,
                    },
                    dataType: "json",
                    cache: false,
                    success: function(data) {

                        document.getElementById('odvCheckbalance').style.display = "inline";
                        document.getElementById('osmConfirm').style.display = "inline"; 
                        console.log(data)
                        if(data['rtDesc'] == "Success") {
                            document.getElementById('obpCardno').innerHTML = "<?php echo language('adawallet/main/main', 'tRefNo') ?>" + " : " + data['roInfo']['rtCrdCode']; 
                            document.getElementById('obpCardtype').innerHTML = data['roInfo']['rtCtyName'];     
                            document.getElementById('obpBalance').innerHTML = data['roInfo']['rcCardTotal'];    
                            document.getElementById('obpNoti').style.display = "none";
                            
                            tBalance = data['roInfo']['rcCardTotal']; 
                            
                            document.getElementById('obpCardResult').innerHTML =  data['roInfo']['rtCtyName'] + " : " + "<?php echo language('adawallet/main/main', 'tRefNo') ?>" + " " + data['roInfo']['rtCrdCode']; 
                            
                        }else{
                            document.getElementById('obpCardno').style.display = "none";
                            document.getElementById('obpCardtype').style.display = "none";
                            document.getElementById('obpBalance').style.display = "none";
                            document.getElementById('obpBal').style.display = "none";                           
                        }
                    }
                });
            }

            async function main() {
                // await liff.init({liffId: "1657332267-K55Av9A4", withLoginOnExternalBrower: true})
                // if(liff.isLoggedIn()) {
                    JSaADWCheckBalance()
                // }else {
                //     liff.login();
                // }
            }

            main()

            $(document).ready(function() {
                $('#osmConfirm').on('click', function(event) {
                    tRandom = Math.floor(100000000000 + Math.random() * 900000000000);
                    tRandom2 = Math.floor(100000 + Math.random() * 900000);
                    tInvoiceID = "S" + tRandom + "-" + tRandom2;

                    console.log( tInvoiceID);
                    event.preventDefault();

                    $.ajax({
                        url: "<?php echo base_url('adwADWEventRefund/') ?>",
                        type: "POST",
                        data: {
                            "ptCstLineID": tUserid,
                            // "ptOAID": tLineoa,
                            "ptAmount": tBalance,
                            "ptInvoiceID": tInvoiceID
                        },
                        dataType: "json",
                        cache: false,
                        success: function(data) {
                            document.getElementById('odvCheckbalance').style.display = "none";
                            document.getElementById('osmConfirm').style.display = "none"; 
                            document.getElementById('odvResult').style.display = "inline";
                        }
                    });
                });
            });
        </script>
    </body>

</html>