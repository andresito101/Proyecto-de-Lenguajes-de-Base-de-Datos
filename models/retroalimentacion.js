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

// Model para obtener todas las retroalimentaciones
async function getAllRetroalimentacion() {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute('SELECT * FROM RETROALIMENTACION');
    return result.rows;
  } catch (err) {
    throw new Error('Error al obtener retroalimentaciones: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

// Model para crear una retroalimentación
async function createRetroalimentacion(feedback) {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute(
      'INSERT INTO RETROALIMENTACION (ID, CLIENTE_ID, PUNTUACION, COMENTARIO) VALUES (:id, :cliente_id, :puntaje, :comentario)',
      [feedback.id, feedback.clienteId, feedback.puntuacion, feedback.comentario],
      { autoCommit: true }
    );
    return result;
  } catch (err) {
    throw new Error('Error al crear retroalimentación: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

module.exports = {
  getAllRetroalimentacion,
  createRetroalimentacion,
};
