// db.js
const sql = require('mssql');

const config = {
    user: 'tu_usuario',
    password: 'tu_contraseña',
    server: 'localhost', 
    database: 'tu_base_de_datos',
    options: {
        encrypt: true, 
        trustServerCertificate: true 
    }
};

async function connect() {
    try {
        await sql.connect(config);
        console.log('Conectado a SQL Server');
    } catch (err) {
        console.error('Error conectando a la base de datos: ', err);
    }
}

module.exports = { sql, connect };