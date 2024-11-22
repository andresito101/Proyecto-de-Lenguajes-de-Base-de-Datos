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

// Model para obtener todos los registros de check-in y check-out
async function getAllCheckins() {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute('SELECT * FROM CHECKIN_CHECKOUT');
    return result.rows;
  } catch (err) {
    throw new Error('Error al obtener registros: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

// Model para registrar un nuevo check-in o check-out
async function createCheckinCheckout(data) {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute(
      'INSERT INTO CHECKIN_CHECKOUT (ID, CLIENTE_ID, FECHA_CHECKIN, FECHA_CHECKOUT) VALUES (:id, :cliente_id, :checkin, :checkout)',
      [data.id, data.clienteId, data.fechaCheckin, data.fechaCheckout],
      { autoCommit: true }
    );
    return result;
  } catch (err) {
    throw new Error('Error al registrar check-in/check-out: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

// Model para eliminar un registro de check-in o check-out
async function deleteCheckinCheckout(id) {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute(
      'DELETE FROM CHECKIN_CHECKOUT WHERE ID = :id',
      [id],
      { autoCommit: true }
    );
    return result;
  } catch (err) {
    throw new Error('Error al eliminar registro: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

module.exports = {
  getAllCheckins,
  createCheckinCheckout,
  deleteCheckinCheckout,
};
