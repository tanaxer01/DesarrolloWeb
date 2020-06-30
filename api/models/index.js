const mongoose = require("mongoose");
mongoose.Promise = global.Promise;

const db = {};

db.mongoose = mongoose;
db.Usuarios = require("./Usuarios.model");
db.Peliculas = require("./Peliculas.model");
db.Categorias = require("./Categorias.model");
db.Ordenes = require("./Ordenes.model");

module.exports = db;
