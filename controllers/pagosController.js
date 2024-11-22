const oracledb = require('oracledb');
const pagosModel = require('../models/pagos');


async function obtenerPagos(req, res) {
  try {
    const connection = await oracledb.getConnection({
      user: 'PROYECTO HOTEL',
      password: '123',
      connectString: 'localhost:1521/FREE',
    });

    const result = await connection.execute('SELECT * FROM PAGOS');
    res.json(result.rows);
    await connection.close();
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
}

async function crearPago(req, res) {
  const { cliente_id, monto, fecha_pago } = req.body;
  try {
    const connection = await oracledb.getConnection({
      user: 'PROYECTO HOTEL',
      password: '123',
      connectString: 'localhost:1521/FREE',
    });

    const result = await connection.execute(
      'INSERT INTO PAGOS (cliente_id, monto, fecha_pago) VALUES (:cliente_id, :monto, :fecha_pago)',
      [cliente_id, monto, fecha_pago],
      { autoCommit: true }
    );

    res.status(201).json({ message: 'Pago registrado exitosamente' });
    await connection.close();
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
}

module.exports = { obtenerPagos, crearPago };
