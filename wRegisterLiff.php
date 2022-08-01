<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My LIFF Register</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    
  <style>
    #opictureUrl { display: block; margin: 0 auto }
  </style>
</head>
<body>

<div class="container">
  <div class="row"> 
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Get Profile By Liff Line</div>
        <div class="card-body">
          <img id="opictureUrl" width="25%">
          <!-- <p id="tuserId"></p>
          <p id="tdisplayName"></p> -->
          <!-- <p id="statusMessage"></p> -->
          <!-- <p id="tgetDecodedIDToken"></p> -->

          <form action="" method="post">
            <label for="oetUserId">UserId</label> 
            <input type="text" class="form-control" name="oetUserId" id="oetUserId" disabled>

            <label for="oetName">Display name</label> 
            <input type="text" class="form-control" name="oetName" id="oetName" disabled>

            <label for="oetEmail">Email</label> 
            <input type="text" class="form-control" name="oetEmail" id="oetEmail" disabled>

            <br>
            <input type="submit" value="ลงทะเบียน" class="btn btn-success">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- <script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script> -->
  <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
  <script>

    async function getUserProfile() {
      const profile = await liff.getProfile()
      document.getElementById("opictureUrl").src = profile.pictureUrl;
      // document.getElementById("tuserId").innerHTML = '<b>UserId:</b> ' + profile.userId;
      // document.getElementById("tdisplayName").innerHTML = '<b>DisplayName:</b> ' + profile.displayName;
      // document.getElementById("statusMessage").innerHTML = '<b>StatusMessage:</b> ' + profile.statusMessage;
      // document.getElementById("tgetDecodedIDToken").innerHTML = '<b>Email:</b> ' + liff.getDecodedIDToken().email;

      document.getElementById("oetUserId").value = profile.userId;
      document.getElementById("oetName").value = profile.displayName;
      document.getElementById("oetEmail").value = liff.getDecodedIDToken().email;
    }

    async function main() {
      await liff.init({liffId: "1657332267-RQLWjEW6", withLoginOnExternalBrower: true})
      if(liff.isLoggedIn()) {
        getUserProfile()
      }else {
        liff.login();
      }
    }

    main()
  </script>
</body>
</html>