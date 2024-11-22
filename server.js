const express = require('express');
const path = require('path');
const oracledb = require('oracledb'); // Requiere el módulo oracledb

// Crear una instancia de Express
const app = express();

// Configurar el puerto
const PORT = 3000;

// Configurar Oracle Database
const dbConfig = {
  user: 'C##HOTEL_PROYECTO',
  password: '123',
  connectString: '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521)))(CONNECT_DATA=(SID=FREE)))'
};

// Middleware para servir archivos estáticos desde la carpeta 'public'
app.use(express.static(path.join(__dirname, 'public')));

// Ruta principal
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

// Ruta para probar la conexión a la base de datos (manual)
app.get('/db-test', async (req, res) => {
  let connection;

  try {
    // Establecer conexión con la base de datos
    connection = await oracledb.getConnection(dbConfig);
    console.log("Conexión a la base de datos exitosa!");

    // Realizar una consulta simple
    const result = await connection.execute('SELECT SYSDATE FROM DUAL');
    res.send(`Fecha actual de la base de datos: ${result.rows[0][0]}`);
  } catch (err) {
    console.error("Error al conectar a la base de datos:", err);
    res.status(500).send("Error al conectar a la base de datos");
  } finally {
    // Cerrar la conexión si está abierta
    if (connection) {
      try {
        await connection.close();
      } catch (closeErr) {
        console.error("Error al cerrar la conexión:", closeErr);
      }
    }
  }
});

// Probar la conexión al inicio del servidor
async function testDatabaseConnection() {
  let connection;

  try {
    connection = await oracledb.getConnection(dbConfig);
    console.log("Conexión a la base de datos exitosa al iniciar el servidor!");
    await connection.close();
  } catch (err) {
    console.error("Error al conectar a la base de datos al iniciar el servidor:", err);
  }
}

// Llamar a la función de prueba de conexión al inicio
testDatabaseConnection();

// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
