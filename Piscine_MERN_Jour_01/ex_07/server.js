const myMERN_module = require("../ex_06/myMERN_module");
const express = require("express");
const app = express();

app.get("/files/:name", async (req, res) => {
    if (req.params.name !== undefined) {
        const data = await myMERN_module.read(req.params.name);
        res.send(data);
    }
    else res.send("Ko");
});

app.post("/files/:name", async (req, res) => {
    if (req.params.name !== undefined) {
        const data = await myMERN_module.create(req.params.name);
        res.send(data);
    }
    else res.send("Ko");
});

app.put("/files/:name/:content", async (req, res) => {
    if (req.params.name !== undefined) {
        const data = await myMERN_module.update(req.params.name, req.params.content);
        res.send(data);
    }
    else res.send("Ko");
});

app.delete("/files/:name", async (req, res) => {
    if (req.params.name !== undefined) {
        const data = await myMERN_module.delete(req.params.name);
        res.send(data);
    }
    else res.send("Ko");
});

app.listen(4242, () => {
    console.log("serveur lance sur le port 4242");
});