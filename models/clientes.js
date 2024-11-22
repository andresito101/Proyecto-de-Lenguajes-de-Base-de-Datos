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

// Model para obtener todos los clientes
async function getAllClientes() {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute('SELECT * FROM CLIENTES');
    return result.rows;
  } catch (err) {
    throw new Error('Error al obtener clientes: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

// Model para obtener un cliente por ID
async function getClienteById(clienteId) {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute(
      'SELECT * FROM CLIENTES WHERE CLIENTE_ID = :id',
      [clienteId]
    );
    return result.rows[0];
  } catch (err) {
    throw new Error('Error al obtener cliente: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

// Model para crear un cliente
async function createCliente(cliente) {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute(
      'INSERT INTO CLIENTES (CLIENTE_ID, NOMBRE, EMAIL, TELEFONO) VALUES (:id, :nombre, :email, :telefono)',
      [cliente.id, cliente.nombre, cliente.email, cliente.telefono],
      { autoCommit: true }
    );
    return result;
  } catch (err) {
    throw new Error('Error al crear cliente: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

// Model para actualizar un cliente
async function updateCliente(clienteId, cliente) {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute(
      'UPDATE CLIENTES SET NOMBRE = :nombre, EMAIL = :email, TELEFONO = :telefono WHERE CLIENTE_ID = :id',
      [cliente.nombre, cliente.email, cliente.telefono, clienteId],
      { autoCommit: true }
    );
    return result;
  } catch (err) {
    throw new Error('Error al actualizar cliente: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

// Model para eliminar un cliente
async function deleteCliente(clienteId) {
  let connection;
  try {
    connection = await getConnection();
    const result = await connection.execute(
      'DELETE FROM CLIENTES WHERE CLIENTE_ID = :id',
      [clienteId],
      { autoCommit: true }
    );
    return result;
  } catch (err) {
    throw new Error('Error al eliminar cliente: ' + err);
  } finally {
    if (connection) {
      await connection.close();
    }
  }
}

module.exports = {
  getAllClientes,
  getClienteById,
  createCliente,
  updateCliente,
  deleteCliente,
};
