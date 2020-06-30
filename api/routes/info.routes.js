const controller = require('../controllers/info.controller');

module.exports = (app) => {
	app.use((req,res,next) => {
		res.header("Access-Control-Allow-Headers");
		next();	
	});

// categorias
	app.get("/api/categorias", controller.getCategorias);
// productosCat
	app.get("/api/productosCat/:cat", controller.productosCat);
// producto
	app.get("/api/producto/:prod", controller.getProducto);	
// agregarCarro
	app.get("/api/agregarCarro/:prod&:cant", controller.agregarCarro);
// delCarro

// comprarCarro

// ordenesdeCompra
	app.get("/api/ordenesdeCompra", controller.getOrdenes);
// ordenes
	app.get("/api/orden/:id", controller.getOrden);

};
