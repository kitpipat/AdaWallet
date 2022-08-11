<html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo language('adawallet/main/main', 'tRegis') . " " . language('adawallet/main/main', 'tAdw') ?></title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>node_modules/jquery/dist/jquery.slim.min.js">
    <link rel="stylesheet" href="<?php echo base_url(); ?>node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>node_modules/bootstrap/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="<?php echo base_url(); ?>node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/modules/common/assets/css/localcss/ada.fonts.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>node_modules/@line/liff/dist/lib/index.js">
    <link rel="stylesheet" href="<?php echo base_url('application/modules/adawallet/assets/css/localcss/Ada.Navbar.css'); ?>" />

    <style>
      #opictureUrl {
        display: block;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <div class="container mt-3 mb-2">
      <div class="row">
        <div class="col align-self-center">
          <?php echo language('adawallet/main/main', 'tProgram') . " : " . language('adawallet/main/main', 'tRegis') . " " . language('adawallet/main/main', 'tAdw') ?>
        </div>
        <div class="col-auto mt-2">
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

    <div class="container">
      <div class="row">
        <div class="col-md-12" id="odvGetProfile">

          <img id="opictureUrl" width="25%">

          <label for="oetName"><?php echo language('adawallet/main/main', 'tName') ?></label>
          <input type="text" class="form-control mb-3 xWInput" name="oetName" id="oetName" disabled>

          <label for="oetEmail"><?php echo language('adawallet/main/main', 'tEmail') ?></label>
          <input type="text" class="form-control mb-3 xWInput" name="oetEmail" id="oetEmail" disabled>

          <label for="onbTel"><?php echo language('adawallet/main/main', 'tTel') ?></label>
          <input type="number" class="form-control mb-3 xWInput" name="onbTel" id="onbTel">

          <!-- <input type="hidden" class="form-control mb-3" name="ohdLineOA" id="ohdLineOA" value="@677trvja"> -->

          <input type="submit" name="osmRegis" id="osmRegis" value="<?php echo language('adawallet/main/main', 'tRegis') ?>" class="btn xWBtnMain" >
        </div>
      </div>

      <div class="row" id="odvResult">
        <div class="row justify-content-center mt-3">
          <div class="col-md-12 text-center">
            <h2 id="obhResult" class="mb-1"><?php echo language('adawallet/main/main', 'tRegisSuccess') ?></h2>
            <p id="obpNoti"><?php echo language('adawallet/main/main', 'tNoti') ?></p>
            <p id="obpCardno"><?php echo language('adawallet/main/main', 'tRefNo') ?> : </p>
            <p id="obpCardtype"><?php echo language('adawallet/main/main', 'tCardTyp') ?></p>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-8">
            <input type="submit" name="osmBack" id="osmBack" value="<?php echo language('adawallet/main/main', 'tBack') ?> " class="btn xWBtnMain" onclick="liff.closeWindow();">
          </div>
        </div>
      </div>

    </div>

    <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

      document.getElementById('odvGetProfile').style.display = "none";
      document.getElementById('odvResult').style.display = "none";

      var tUserid = '';
      var tTel = '';
      // var tLineoa = document.getElementById("ohdLineOA").value;

      $(document).ready(function() {
        $('#osmRegis').on('click', function(event) {
          tTel = document.getElementById("onbTel").value;
          event.preventDefault();

          $.ajax({
            url: "<?php echo base_url('adwADWRegister/') ?>",
            type: "POST",
            data: {
              "ptCstLineID": tUserid,
              "ptCstTel": tTel,
              // "ptOAID": tLineoa,
            },
            dataType: "json",
            cache: false,
            success: function(data) {

              console.log(data);
              if(data['rtDesc'] == "Success") {
                if(data['rtCode'] == "04") {
                  JSaADWRegister("ptRegis")
                }else {
                  document.getElementById('odvResult').style.display = "inline";
                  document.getElementById('obhResult').innerHTML = "<?php echo language('adawallet/main/main', 'tRegisSuccess') ?>"; 
                  document.getElementById('obpCardno').innerHTML = "<?php echo language('adawallet/main/main', 'tRefNo') ?>" + " : " + data['roInfo']['rtCrdCode']; 
                  document.getElementById('obpCardtype').innerHTML = "<?php echo language('adawallet/main/main', 'tCardTyp') ?>" + " : " +  data['roInfo']['rtCtyName'];      
                  document.getElementById('obpNoti').style.display = "none";
                }

              }else{
                document.getElementById('obhResult').innerHTML = "<?php echo language('adawallet/main/main', 'tRegisFail') ?>"; 
                document.getElementById('obpCardno').style.display = "none";
                document.getElementById('obpCardtype').style.display = "none";
              }

            }
          });
        });
      });

      async function JSaADWRegister(Regis) {
        // const profile = await liff.getProfile()
        // document.getElementById("opictureUrl").src = profile.pictureUrl;

        // document.getElementById("oetName").value = profile.displayName;
        // document.getElementById("oetEmail").value = liff.getDecodedIDToken().email;
        // tUserid = profile.userId;
        // console.log(liff.getLanguage());
        // console.log(liff.getVersion());
        // console.log(liff.isInClient());
        // console.log(liff.isLoggedIn());
        // console.log(liff.getOS());
        // console.log(liff.getLineVersion());
        
        tUserid = "Ua8123e603500c93fc05b40ae4fc5f58a";
          $.ajax({
            url: "<?php echo base_url('adwADWCheckBalance/') ?>",
            type: "POST",
            data: {
              "ptCstLineID": tUserid,
              // "ptOAID": tLineoa,
            },
            dataType: "json",
            cache: false,
            success: function(data) {

              if(data['rtDesc'] == "Success") {
                if(data['rtCode'] == "04") {
                  document.getElementById('odvGetProfile').style.display = "inline";
                } else if(Regis == "ptRegis") {
                  document.getElementById('odvGetProfile').style.display = "none";
                  document.getElementById('odvResult').style.display = "inline";
                  document.getElementById('obhResult').innerHTML = "<?php echo language('adawallet/main/main', 'tRegisSuccess') ?>"; 
                  document.getElementById('obpCardno').innerHTML = "<?php echo language('adawallet/main/main', 'tRefNo') ?>" + " : " + data['roInfo']['rtCrdCode']; 
                  document.getElementById('obpCardtype').innerHTML = "<?php echo language('adawallet/main/main', 'tCardTyp') ?>" + " : " +  data['roInfo']['rtCtyName'];      
                  document.getElementById('obpNoti').style.display = "none";
                } else {
                  console.log(data);
                  document.getElementById('odvResult').style.display = "inline";
                  document.getElementById('obhResult').innerHTML = "<?php echo language('adawallet/main/main', 'tRegisAlready') ?>"; 
                  document.getElementById('obpCardno').innerHTML = "<?php echo language('adawallet/main/main', 'tRefNo') ?>" + " : " + data['roInfo']['rtCrdCode']; 
                  document.getElementById('obpCardtype').innerHTML = "<?php echo language('adawallet/main/main', 'tCardTyp') ?>" + " : " +  data['roInfo']['rtCtyName'];      
                  document.getElementById('obpNoti').style.display = "none";
                }

              }else{
                document.getElementById('odvGetProfile').style.display = "inline";
              }

            }
          });
        }

        async function main() {
          // await liff.init({liffId: "1657332267-RQLWjEW6", withLoginOnExternalBrower: true})
          // if(liff.isLoggedIn()) {
            JSaADWRegister()
          // }else {
          //   liff.login();
          // }
        }

        main()
    </script>
  </body>

</html>