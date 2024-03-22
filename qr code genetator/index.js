const express = require("express");
const qrcode = require("qrcode-generator");
const cors = require("cors");
const { json } = require("express/lib/response");
const app = express();

app.use(cors({ origin: "*" }));
app.get("/generate/:id", (req, res) => {
  var typeNumber = 4;
  var errorCorrectionLevel = "L";
  var qr = qrcode(typeNumber, errorCorrectionLevel);
  qr.addData(
    "http://172.20.10.2/parking-management/gatekeeper/dashboard/index.php?id=" +
      req.params.id
  );
  qr.make();
  res.json(qr.createDataURL(7));
});

app.listen(3001);
