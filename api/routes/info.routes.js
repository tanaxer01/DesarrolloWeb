const controller = require('../controllers/info.controller');

module.exports = function(app) {
	app.use(function (req, res, next){
		res.header(
			"Access-Controll-Allow-Headers",
		);
		next();
	});

//categorias
	app.get("/api/categorias", controller.getCategorias);
//productosCat
	app.post("/api/productosCat/:cat", controller.productosCat);
//producto
	app.post("/api/producto/:prod", controller.getProducto);
//agregarCarro
	app.post("/api/agregarCarro/:prod&:cant", controller.agregarCarro);
//delCarri

//compraCarro

//ordenesdeCompra
	app.get("/api/ordenesdeCompra", controller.getOrdenes);
//orden
//	app.get("/api/orden/:id", controller.getOrden);
};
