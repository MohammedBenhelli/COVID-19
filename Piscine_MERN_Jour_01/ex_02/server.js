const express = require("express");
const app = express();

app.get("/", (req, res) => res.send("Great !It works."))

app.listen(4242, () => {
    console.log("serveur lance sur le port 4242");
});