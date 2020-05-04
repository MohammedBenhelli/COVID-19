const express = require("express");
const app = express();

app.listen(4242, () => {
    console.log("serveur lance sur le port 4242");
});