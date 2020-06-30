const mongoose = require("mongoose");
const db = require("../models");
const Peliculas = db.Peliculas;
const Categorias = db.Categorias;
const Ordenes = db.Ordenes;

exports.getCategorias = (req,res) => {
	Categorias.find()
	.exec((err, peliculas) => {
		if(err)
		{
			res.status(500).send({ message : err });
		}
	
		if(!peliculas)
		{
			return res.status(404).send({ message : "No hay productos"});
		}

		res.status(200).send({peliculas});	
	})
};

exports.productosCat = (req,res) => {
	Categorias.findOne({ "nombre": req.params.cat })
	.exec((err,match) => {
		if(err)
		{
			res.status(500).send({ message: err });
			return;
		}

		if(!match)
		{
			res.status(404).send({ message: "No hay peliculas de esa categoria"});
			return;
		}

		Peliculas.find({"genero" : String(match["_id"]) }).exec((errPeli,matches) => {
			if(errPeli)
			{
				res.status(500).send({message: err});
				return;
			}


			res.status(200).send({matches});
		});
	});
};


exports.getProducto = (req, res) => {
	Peliculas.findOne({ "_id" : mongoose.Types.ObjectId(req.params.prod)})
	.exec((err, match) => {
		if(err)
		{
			res.status(500).send({ message: err });
			return;
		}

		res.status(200).send({match });
	});
};

exports.agregarCarro = (req, res) => {

};

exports.getOrdenes = (req,res) => {
	Ordenes.find()
	.exec((err, ordenes) => {
		if(err)
		{
			res.status(500).send({ message : err });
		}
	
		if(!ordenes)
		{
			return res.status(404).send({ message : "No hay productos"});
		}

		res.status(200).send({ordenes});	
	});
}

