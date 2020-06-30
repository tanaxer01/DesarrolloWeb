const db = require('../models');
const Cat = db.Categorias;

checkCat = (req,res,next) => {
	Cat.findOne({nombre: req.params.cat}).exec((err,cat) => {
		if(err){
			res.status(500).send({ message : err});
			return
		}

		if(!cat){
			re.status(404).send({ message : "No se encuentra la categoria"});
			return;
		}

		console.log(match);
		next(match['_id']);


	});


}
