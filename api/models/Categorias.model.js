const mongoose = require('mongoose');

const Categorias = mongoose.model("Categorias",
	new mongoose.Schema({
		nombre: String
	})
);

module.exports = Categorias;
