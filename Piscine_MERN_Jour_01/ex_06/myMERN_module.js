const fs = require("fs");
const { promisify } = require('util')

const myMERN_module = {

    create: async (name) => {
        const write = promisify(fs.writeFile);
        return await write(name, "");
    },

    read: async (name) => {
        const read = promisify(fs.readFile);
        return await read(name, "utf8");
    },

    update: async (name, content) => {
        const write = promisify(fs.writeFile);
        return await write(name, content);
    },

    delete: async (name) => {
        const unlink = promisify(fs.unlink);
        return await unlink(name);
    }
};

module.exports = myMERN_module;