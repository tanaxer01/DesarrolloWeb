const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");

const app = express();

var corsOptions = { origin : "http://localhost:3010" };

app.use(cors(corsOptions));
app.use(bodyParser.json());

app.use(bodyParser.urlencoded({extended: true}));

//db
const db = require('./models');
const dbConfig = require('./config/db.config');

db.mongoose.connect(`mongodb://${dbConfig.HOST}:${dbConfig.PORT}/${dbConfig.DB}`,{
	useNewUrlParser: true,
	useUnifiedTopology: true
	}).then(() => {
		console.log("Connectado a la base de datos ");
	}).catch((err) => {
		console.log("Error de coneccion", err);
		process.exit();
	});

//endpoints
app.get('/', (req,res) => {
	res.status(200).json({message: "working"});
});

require("./routes/info.routes")(app);

//set Port & Listen
const PORT = process.env.PORT || 3010;
app.listen(PORT, () => {
	console.log(`Server running in port ${PORT}`
);
});
