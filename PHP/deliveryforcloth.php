<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="delivery.css" />

</head>
<body>
  <div class="itm">
    <p>"Your donation will be immediately collected and sent to needy people."</p>
    <img src="img/delivery.gif" alt="Delivery GIF" width="400" height="400" />
    <div class="pdf-btn">
      <button id="downloadBtn">Download Invoice</button>
    </div>
    <p><a href="home.html">Return to home page</a></p>
  </div>
  <br />

  <script>
    document
      .getElementById("downloadBtn")
      .addEventListener("click", function () {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "generatepdfforclothdonate.php", true);
        xhr.responseType = "blob";

        xhr.onload = function () {
          if (this.status === 200) {
            var blob = new Blob([xhr.response], { type: "application/pdf" });
            var objectUrl = URL.createObjectURL(blob);
            window.open(objectUrl);
          }
        };

        xhr.send();
      });
  </script>
</body>
</html>
