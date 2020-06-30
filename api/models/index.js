const mongoose = require("mongoose");
mongoose.Pormise = global.Promise;

const db = {};

db.mongoose = mongoose;
db.Peliculas = require("./Peliculas.model");
db.Categorias = require("./Categorias.model");
db.Ordenes = require("./Ordenes.model");

module.exports = db;
