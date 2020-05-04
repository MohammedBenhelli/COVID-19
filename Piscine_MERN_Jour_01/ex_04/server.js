const express = require("express");
const app = express();

app.set("view engine", "ejs")
app.set('views', './views');

app.get("/name/:name", (req, res) => res.render("index", { name: "Hello "+req.params.name }));

app.get("/name/", (req, res) => res.render("index", { name: "Hello unknown" }));

app.listen(4242, () => {
    console.log("serveur lance sur le port 4242");
});