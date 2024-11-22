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

// Model para obtener todos los pagos
async function getAllPagos() {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute('SELECT * FROM PAGOS');
    return result.rows;
  } catch (err) {
    throw new Error('Error al obtener pagos: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

// Model para crear un pago
async function createPago(pago) {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute(
      'INSERT INTO PAGOS (ID, CLIENTE_ID, MONTO, FECHA, ESTADO) VALUES (:id, :cliente_id, :monto, :fecha, :estado)',
      [pago.id, pago.clienteId, pago.monto, pago.fecha, pago.estado],
      { autoCommit: true }
    );
    return result;
  } catch (err) {
    throw new Error('Error al crear pago: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

module.exports = {
  getAllPagos,
  createPago,
};
