const express = require("express");
const app = express();

app.set("view engine", "ejs")
app.set('views', './views');

app.get("/name/:name", (req, res) => {
    if (req.query.age !== undefined)
        res.render("index", { name: "Hello " + req.params.name + ", you have " + req.query.age + " yo" });
    else res.render("index", { name: "Hello " + req.params.name + ", i don't know your age" });
});

app.get("/name/", (req, res) => {
    if (req.query.age !== undefined)
        res.render("index", { name: "Hello unknown, you have " + req.query.age + " yo" })
    else res.render("index", { name: "Hello unknown, i don't know your age" });
});

app.listen(4242, () => {
    console.log("serveur lance sur le port 4242");
});