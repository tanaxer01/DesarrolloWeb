const mongoose = require('mongoose')
const db = require("../models");
const Peliculas = db.Peliculas;
const Categorias = db.Categorias;
const Ordenes = db.Ordenes;

exports.getCategorias = (req,res) => {
	Categorias.find()
	.exec((err, categorias) => {
		if(err)
		{
			res.status(500).send({ message: err });
			return;
		}
		
		if(!categorias)
		{
			res.status(404).send({ message: "No hay categorias, F" });
			return;
		}

		res.status(200).send({categorias});
	})
};

exports.productosCat = (req,res) => {
	Categorias.findOne({ "nombre": req.params.cat })
	.exec((err, categoria) => {
		if(err)
		{
			res.status(500).send({ message: err });
			return;
		}

		if(!categoria)
		{
			res.status(404).send({ message: "Categoria no encontrada" });
		}

		Peliculas.find({ "genero": String(categoria["_id"]) })
		.exec((err, peliculas) => {
			res.status(200).send({ peliculas });
		});
	});
};

exports.getProducto = (req,res) => {
	Peliculas.findOne({"_id": mongoose.Types.ObjectId(req.params.prod) })
	.exec((err,pelicula) => {
		if(err)
		{
			res.status(500).send({ message: err });
			return;
		}
		if(!pelicula)
		{
			res.status(404).send({ message: "Producto no se encuentra dentro de la base de datos"});
			return;
		}

		res.status(200).send({pelicula});
	
	});
};

exports.agregarCarro = (req,res) => { 
	req.session.carrito = "asdsad";

};

exports.getOrdenes = (req,res) => {
	Ordenes.find()
	.exec((err,ordenes) => {
		if(err)
		{
			res.status(500).send({ message: err});
			return;
		}

		if(!ordenes)
		{
			res.status(404).send({ message: "No hay Compras registradas" });
			return;
		}

		res.status(200).send({ordenes});

	});
};

exports.getOrden = (req,res) => {
	Ordenes.findOne({"_id": mongoose.Types.ObjectId(req.params.id) })
	.exec((err, orden) => {
		if(err)
		{
			res.status(500).send({ message: err});
			return;
		}

		if(!orden)
		{
			res.status(404).send({ message: "No existe orden con este id"});
			return;
		}

		res.status(200).send({ orden });

	});

}
