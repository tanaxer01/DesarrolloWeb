const mongoose = require('mongoose');

const Peliculas = mongoose.model("Peliculas",
	new mongoose.Schema({
		link: String,
		nombre: String,
		descrip: String,
		foto: String,
		precio: Number,
		genero: String
	})
);

module.exports = Peliculas;
