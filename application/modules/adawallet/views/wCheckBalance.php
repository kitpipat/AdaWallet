<html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo language('adawallet/main/main', 'tCheckBal') . " / " . language('adawallet/main/main', 'tTopup'). " " . language('adawallet/main/main', 'tAdw') ?></title>

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
          <?php echo language('adawallet/main/main', 'tProgram') . " : " . language('adawallet/main/main', 'tCheckBal') . " / " . language('adawallet/main/main', 'tTopup') . " " . language('adawallet/main/main', 'tAdw') ?>
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

      <div id="odvTopup">
        <div class="row xWBorder">
              <h5><?php echo language('adawallet/main/main', 'tTopup') ?></h5>
        </div>

        <div class="row justify-content-center xWBorder">
          <div class="col xWBorder">
            <input type="submit" name="oetMoney" id="oetMoney" class="btn xWBtnMoney" value="20" onclick="JStADWMoney(this.value)"/>
          </div>
          <div class="col xWBorder">
            <input type="submit" name="oetMoney" id="oetMoney" class="btn xWBtnMoney" value="50" onclick="JStADWMoney(this.value)" />
          </div>

          <div class="col xWBorder">
            <input type="submit" name="oetMoney" id="oetMoney" class="btn xWBtnMoney" value="100" onclick="JStADWMoney(this.value)"/>
          </div>

          <div class="col xWBorder">
            <input type="button" name="oetMoney" id="oetMoney" class="btn xWBtnMoney" value="150" onclick="JStADWMoney(this.value)"/>
          </div>
        </div>

        <div class="row justify-content-center xWBorder">
          <div class="col xWBorder">
            <input type="submit" name="oetMoney" id="oetMoney" class="btn xWBtnMoney" value="200" onclick="JStADWMoney(this.value)"/>
          </div>
          <div class="col xWBorder">
            <input type="submit" name="oetMoney" id="oetMoney" class="btn xWBtnMoney" value="300" onclick="JStADWMoney(this.value)" />
          </div>

          <div class="col xWBorder">
            <input type="submit" name="oetMoney" id="oetMoney" class="btn xWBtnMoney" value="500" onclick="JStADWMoney(this.value)"/>
          </div>

          <div class="col xWBorder">
            <input type="button" name="oetMoney" id="oetMoney" class="btn xWBtnMoney" value="1000" onclick="JStADWMoney(this.value)"/>
          </div>
        </div>

        <div class="row xWBorder">
          <input type="number" class="form-control xWInput xWTopup" name="onbMoney" id="onbMoney" placeholder="0">
        </div>

        <div class="row xWBorder">
          <input type="submit" name="osmNext" id="osmNext" value="<?php echo language('adawallet/main/main', 'tNext') ?>" class="btn xWBtnMain" >
        </div>
      </div>

    </div>

    <div class="container" id="odvGenqr">

      <div class="row justify-content-center xWBorder" id="oImgQR">
        <div class="col">
          <img name="oimQR" id="oimQR" class="rounded mx-auto d-block">
        </div>
      </div>

      <div class="row justify-content-center xWBorder">
        <div class="col-10 mt-2 text-center">
          <p id="obpTopupNoti"></p>
          <p id="obpTopupTest"></p>
          <p id="obpTopupTest2"></p>
        </div>
      </div>

      <div class="row justify-content-center xWBorder">
        <div class="col-3 text-center mb-5">

          <a id='oahDownload' hidden>
            <i class="bi bi-download btn xWBtnDownload mx-auto" ></i>
          </a>

        </div>
      </div>

      <div class="row justify-content-center xWBorder">
        <div class="col-8 xWBorder">
          <input type="submit" name="osmFinish" id="osmFinish" value="<?php echo language('adawallet/main/main', 'tFinish') ?>" class="btn xWBtnMain mx-auto" onclick="liff.closeWindow();">
        </div>
      </div>
    </div>

    

    <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      document.getElementById('odvCheckbalance').style.display = "none";
      document.getElementById('odvTopup').style.display = "none";
      document.getElementById('odvGenqr').style.display = "none";

      var tUserid = '';
      // var tLineoa = document.getElementById("ohdLineOA").value;
      var tMoney = '';
      var nRandom = '';
      var nRandom2 = '';
      var tInvoiceID = '';
      var tDate = '';
      var nRef = '';

      async function JSaADWCheckBalance() {
        // const profile = await liff.getProfile()
        //   tUserid = profile.userId;
          
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
                document.getElementById('odvCheckbalance').style.display = "inline";
                document.getElementById('odvTopup').style.display = "inline";

                // console.log(data)
                if(data['rtDesc'] == "Success") {
                  document.getElementById('obpCardno').innerHTML = "<?php echo language('adawallet/main/main', 'tRefNo') ?>" + " : " + data['roInfo']['rtCrdCode']; 
                  document.getElementById('obpCardtype').innerHTML = data['roInfo']['rtCtyName'];  
                  document.getElementById('obpBalance').innerHTML = data['roInfo']['rcCardTotal'];    
                  document.getElementById('obpNoti').style.display = "none";
                  
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
        // await liff.init({liffId: "1657332267-Wyargqr8", withLoginOnExternalBrower: true})
        //   if(liff.isLoggedIn()) {
            JSaADWCheckBalance()
          // }else {
          //   liff.login();
          // }
      }

      main()

      function JStADWMoney(money) {
        document.getElementById("onbMoney").value = money;
      }

      // function JSoADWdownloadURI(ptUri, ptImgName) {
      //   var oahLink = document.createElement("a");
      //   oahLink.download = ptImgName;
      //   oahLink.href = ptUri;
      //   document.body.appendChild(oahLink);
      //   oahLink.click();
      //   document.body.removeChild(oahLink);
      //   delete oahLink;
      // };

      $(document).ready(function() {
        $('#osmNext').on('click', function(event) {
          tMoney = parseInt(document.getElementById("onbMoney").value).toFixed(2);
          nRef = Math.floor(100000 + Math.random() * 900000);
          nRandom = Math.floor(100000000000 + Math.random() * 900000000000);
          nRandom2 = Math.floor(100000 + Math.random() * 900000);
          tInvoiceID = "S" + nRandom + "-" + nRandom2;

          console.log( tInvoiceID, "/" , nRef);
          event.preventDefault();

          $.ajax({
            url: "<?php echo base_url('adwADWGenQR/') ?>",
            type: "POST",
            data: {
              "ptCstLineID": tUserid,
              // "ptOAID": tLineoa,
              "ptAmount": tMoney,
              "ptInvoiceID": tInvoiceID,
              "pnREF2": nRef
            },
            dataType: "json",
            cache: false,
            success: function(data) {
              console.log(data['ptInvoiceDate']);
              if(data['Resp_Code'] == "00") {
                document.getElementById('odvCheckbalance').style.display = "none";
                document.getElementById('odvTopup').style.display = "none";
                document.getElementById('odvGenqr').style.display = "inline";

                document.getElementById("oimQR").src = 'data:image/png;base64,'+ data['QRStrImg'];
                tDate = data['ptInvoiceDate']
                
                JStADWTopup();

                // setTimeout(() => {
                //   let tImgID = document.querySelector('#oimQR')
                //   let tLink = document.querySelector('#oahDownload')
                //   let tPath = tImgID.getAttribute('src');
                //   tLink.setAttribute('href', tPath);
                //   tLink.setAttribute('download', 'qrcode.jpeg');
                //   tLink.removeAttribute('hidden');


                //   let tDataUrl = document.querySelector('#oimQR').src;
                //   JSoADWdownloadURI(tDataUrl, 'qrcode.jpeg');
                // }, 500); 

              }
            }
          });
        });
      });

      function JStADWTopup() {
        $.ajax({
          url: "<?php echo base_url('adwADWTopup/') ?>",
          type: "POST",
          data: {
            "ptCstLineID": tUserid,
            // "ptOAID": tLineoa,
            "ptAmount": tMoney,
            "ptInvoiceID": tInvoiceID,
            "ptInvoiceDate": tDate
          },
          dataType: "json",
          cache: false,
          success: function(data) {
            console.log(data);
            if(data['rtDesc'] == 'success.') {
              document.getElementById('obpTopupTest').innerHTML = data['ptCstLineID'] + "/" + data['ptOAID'] + "/" + data['ptAmount'];
              document.getElementById('obpTopupTest2').innerHTML = data['ptInvoiceID'];
              document.getElementById('obpTopupNoti').innerHTML = "<?php echo language('adawallet/main/main', 'tTopupNoti') ?>";
            }
          }
        });
      }

    </script>
  </body>

</html>