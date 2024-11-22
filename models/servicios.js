const oracledb = require('oracledb');

// Función para obtener una conexión
async function getConnection() {
  try {
    return await oracledb.getConnection({
      user: 'C##HOTEL_PROYECTO',
      password: '123',
      connectString: 'localhost:1521/FREE',
    });
  } catch (err) {
    throw new Error('Error al conectar a la base de datos: ' + err);
  }
}

// Model para obtener todos los servicios
async function getAllServicios() {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute('SELECT * FROM SERVICIOS');
    return result.rows;
  } catch (err) {
    throw new Error('Error al obtener servicios: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

// Model para crear un nuevo servicio
async function createServicio(servicio) {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute(
      'INSERT INTO SERVICIOS (ID, NOMBRE, DESCRIPCION) VALUES (:id, :nombre, :descripcion)',
      [servicio.id, servicio.nombre, servicio.descripcion],
      { autoCommit: true }
    );
    return result;
  } catch (err) {
    throw new Error('Error al crear servicio: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

module.exports = {
  getAllServicios,
  createServicio,
};
