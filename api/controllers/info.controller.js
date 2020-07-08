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
	if(!req.session.carro){ req.session.carro = { costo: 0, productos: {}}; }
	
	Peliculas.findOne({"_id" : mongoose.Types.ObjectId(req.params.prod) })
	.exec((err, found) => {
		if(err)
		{
			res.status(500).send({ message: err });
			return;
		}
		if(!found)
		{
			res.statud(404).send({ message: "Producto no encontrado"});
			return;
		}
	
		if(!parseInt(req.params.cant,10))
		{
			res.status(500).send({ message: "Cantidad debe ser un numero"});
			return;
		}

		if(req.session.carro.productos[req.params.prod]){
			req.session.carro.productos[req.params.prod] += parseInt(req.params.cant,10);
		}else{
			req.session.carro.productos[req.params.prod] = parseInt(req.params.cant,10);
		}
		req.session.carro.costo += parseInt(req.params.cant,10)*found['precio'];
	
		res.status(200).send({ carro : req.session.carro })
	})

};

exports.delCarro = (req,res) => {
	if(!req.session.carro){
		res.status(500).send({ message: "carrito no iniciado"});
		return;
	}
	if( !req.session.carro.productos[req.params.prod]){
		res.status(500).send({ message: "Producto no se encuentra en el carrito"})
		return;
	}
	
	Peliculas.findOne({ "_id": mongoose.Types.ObjectId(req.params.prod)})
	.exec((err,prod) => {
	
		req.session.carro.costo -= req.session.carro.productos[req.params.prod]*prod["precio"];
		
		delete req.session.carro.productos[req.params.prod];
		res.status(500).send({ message: req.session.carro });
	});	
};

exports.comprarCarro = async (req,res) => {
	if(!req.session.carro){
		res.status(404).send({ message: "Carrito no definido"});
		return;
	}

	if(req.session.carro.costo == 0)
	{
		res.status(500).send({ message: "Nada que vender", total });
		return;
	}

	const orden = new Ordenes({
		total: req.session.carro.costo,
		productos: req.session.carro.productos
	});
	
	orden.save((err,orden) => {
		if(err){
			res.status(500).send({ message: err});
			return;
		}

		delete req.session.carro;
		res.status(201).send({ orden, message: "Orden creada" });
	
	})	
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
