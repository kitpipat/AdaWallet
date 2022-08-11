<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo language('adawallet/main/main', 'tPayment') . " " . language('adawallet/main/main', 'tAdw') ?></title>

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
                    <?php echo language('adawallet/main/main', 'tProgram') . " : " . language('adawallet/main/main', 'tPayment') . " " . language('adawallet/main/main', 'tAdw') ?>
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

        <div class="container" id="odvNotiGenqr">
            <p id="obpNoti"><?php echo language('adawallet/main/main', 'tNoti') ?></p>
        </div>

        <div class="container" id="odvGenqr">
        <!-- <input type="hidden" class="form-control" name="ohdLineOA" id="ohdLineOA" value="@677trvja"> -->

            <div class="row justify-content-center mb-2 xWBorder" id="odvImgQR">
                <div class="col">
                    <img name="oimQR" id="oimQR" class="rounded mx-auto d-block">
                </div>
            </div>

            <div class="row justify-content-center p-0 xWBorder" id="odvShowOtp">
                <div class="col-10 text-center mx-auto">
                    <h3 id="obhOtp" class="p-1 mb-0">XXXXXX</h3>
                </div>
            </div>

            <div class="row justify-content-center xWBorder">
                <div class="col-10 text-center">
                    <h5 id="obhCardno" class="mb-0"></h5>
                </div>
            </div>

            <div class="row justify-content-center p-0 xWBorder"  id="odvOtpExpire">
                <div class="col-10 text-center mx-auto">
                    <?php echo language('adawallet/main/main', 'tOTPExpireNoti') ?>
                </div>
            </div>

            <div class="row justify-content-center xWBorder" id="odvOTPNoti">
                <div class="col-10 text-center">
                    <p id="obpPaymentNoti"><?php echo language('adawallet/main/main', 'tPaymentNoti') ?></p>
                </div>
            </div>
        </div>

        <div class="container p-0" id="odvOTPRequest">
            <div class="row justify-content-center p-0">
                <div class="col-10 text-center">
                    <?php echo language('adawallet/main/main', 'tOTPNoti') ?>
                    <b>
                        <a href="javascript:void(0);" class="xWOTP" onclick="JStRequestOTP();"><?php echo language('adawallet/main/main', 'tOTPClickhere') ?></a>
                    </b>
                </div>
            </div>
        </div>

        <!-- <div class="container mb-3 p-0" id="odvOTPResult">
            <div class="row justify-content-center p-0">
                <div class="col-10 text-center">
                    <h3 id="obhOtp" class=" p-1 mb-0">XXXXXX</h3>
                </div>
            </div>

            <div class="row justify-content-center xWBorder">
                <div class="col-10 mt-2 text-center">
                    <h5 id="obhCardno" class="mb-0"></h5>
                </div>
            </div>
            
            <div class="row justify-content-center p-0 mb-3">
                <div class="col-10 text-center p-0">
                    <?php echo language('adawallet/main/main', 'tOTPExpireNoti') ?>
                </div>
            </div>
        </div> -->

        <div class="row justify-content-center xWBorder" id="odvOTPButton">
            <div class="col-10 mx-auto">
                <input type="submit" name="osmFinish" id="osmFinish" value="<?php echo language('adawallet/main/main', 'tFinish') ?>" class="btn xWBtnMain mx-auto" onclick="liff.closeWindow();">
            </div>
        </div>


        <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            document.getElementById('odvGenqr').style.display = "none";
            document.getElementById('odvNotiGenqr').style.display = "none";
            document.getElementById('odvOTPRequest').style.display = "none";
            document.getElementById('odvOTPButton').style.display = "none";

            var tUserid = '';
            // var tLineoa = document.getElementById("ohdLineOA").value;
            var tCardno = '';

            async function JSaADWCheckBalance() {
            // const profile = await liff.getProfile()
            //     tUserid = profile.userId;
                tUserid = "Ua8123e603500c93fc05b40ae4fc5f58a";

                $.ajax({
                    url: "<?php echo base_url('adwADWEventPayment/') ?>",
                    type: "POST",
                    data: {
                        "ptCstLineID": tUserid,
                        // "ptOAID": tLineoa,
                    },
                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        if(data['rtDesc'] == "Success") {
                            console.log(data['roInfo']['rtCrdCode'])
                            tCardno = data['roInfo']['rtCrdCode'];  

                            document.getElementById('obhCardno').innerHTML = "<?php echo language('adawallet/main/main', 'tRefNo') ?>" + " : " + tCardno; 

                            JStADWGenQR();                   
                        }else{
                            document.getElementById('odvNotiGenqr').style.display = "inline";
                            document.getElementById('odvOTPButton').style.display = "inline";
                        }
                    }
                });
            }

            async function main() {
                // await liff.init({liffId: "1657332267-Xp2E4kEv", withLoginOnExternalBrower: true})
                // if(liff.isLoggedIn()) {
                    JSaADWCheckBalance()
                // }else {
                //     liff.login();
                // }
            }

            main()

            function JStADWGenQR(){ 
                // const tValue = [tCardno, tUserid, tLineoa];

                document.getElementById("oimQR").src = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data='+tCardno;
                document.getElementById('odvGenqr').style.display = "inline";
                document.getElementById('odvShowOtp').style.display = "none";
                document.getElementById('odvOtpExpire').style.display = "none";
                document.getElementById('odvOTPRequest').style.display = "inline";
                document.getElementById('odvOTPButton').style.display = "inline";
            }

            function JStRequestOTP() {
                document.getElementById('odvShowOtp').style.display = "inline";
                document.getElementById('odvOtpExpire').style.display = "inline";

                document.getElementById('odvImgQR').style.display = "none";
                document.getElementById('odvOTPNoti').style.display = "none";
                document.getElementById('odvOTPRequest').style.display = "none";
            }

        </script>
    </body>

</html>