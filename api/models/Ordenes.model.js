const mongoose = require('mongoose');

const Ordenes = mongoose.model("Ordenes",
	new mongoose.Schema({
		total: Number,
		productos: {type: Map, of: Number}
	})
);

module.exports = Ordenes;
