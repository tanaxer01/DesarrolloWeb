const mongoose = require('mongoose');

const Usuarios = mongoose.model("User",
	new mongoose.Schema({
		username: String,
		email: String,
		password: String
	})
);

module.exports = Usuarios;
