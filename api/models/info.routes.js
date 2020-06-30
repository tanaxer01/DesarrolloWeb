const controller = require('../controllers/info.controller');

module.exports = (app) => {
	app.use((req,res,next) => {
		res.header(
		"Access-Control-Allow-Header"
		);
		next();
	});

	app.get("/api/categorias");

};
