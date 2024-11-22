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

// Model para obtener todas las reservaciones
async function getAllReservaciones() {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute('SELECT * FROM RESERVACIONES');
    return result.rows;
  } catch (err) {
    throw new Error('Error al obtener reservaciones: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

// Model para crear una nueva reservación
async function createReservacion(reservacion) {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute(
      'INSERT INTO RESERVACIONES (ID, CLIENTE_ID, FECHA_INICIO, FECHA_FIN, ESTADO) VALUES (:id, :cliente_id, :fecha_inicio, :fecha_fin, :estado)',
      [reservacion.id, reservacion.clienteId, reservacion.fechaInicio, reservacion.fechaFin, reservacion.estado],
      { autoCommit: true }
    );
    return result;
  } catch (err) {
    throw new Error('Error al crear reservación: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

// Model para eliminar una reservación
async function deleteReservacion(id) {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute(
      'DELETE FROM RESERVACIONES WHERE ID = :id',
      [id],
      { autoCommit: true }
    );
    return result;
  } catch (err) {
    throw new Error('Error al eliminar reservación: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

module.exports = {
  getAllReservaciones,
  createReservacion,
  deleteReservacion,
};
