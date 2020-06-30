const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");
const session = require('express-session');

const app = express();

var corsOptions = {
	origin: 'http://localhost:3010'
};

app.use(cors(corsOptions));
app.use(bodyParser.json());
app.use(session(
	{ secret: 'mira este secreto super secreto el secreto',
	  resave: false,
	}));
app.use(bodyParser.urlencoded({ extended : true }));

//DB
const db = require('./models');
const dbConfig = require('./config/db.config');

db.mongoose
	.connect(`mongodb://${dbConfig.HOST}:${dbConfig.PORT}/${dbConfig.DB}`,{
		useNewUrlParser: true,
		useUnifiedTopology: true,
	})
	.then(() => {
		console.log("Conectado a la base de datos");
	})
	.catch((err) => {
		console.error("Connection error", err);
		process.exit();
	});

//endpoints
app.get('/', (req,res) => {
	res.status(200).json({ message: "Working" });
});

require('./routes/info.routes')(app);

//set Port & Listen
const PORT = process.env.PORT || 3010;
app.listen(PORT, () => {
	console.log(`Server running on port ${PORT}`);
});
	
