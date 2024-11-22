const oracledb = require('oracledb');
const reservacionesModel = require('../models/reservaciones');



async function obtenerReservaciones(req, res) {
  try {
    const connection = await oracledb.getConnection({
      user: 'PROYECTO HOTEL',
      password: '123',
      connectString: 'localhost:1521/FREE',
    });

    const result = await connection.execute('SELECT * FROM RESERVACIONES');
    res.json(result.rows);
    await connection.close();
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
}

async function crearReservacion(req, res) {
  const { cliente_id, habitacion_id, fecha_reserva, fecha_ingreso } = req.body;
  try {
    const connection = await oracledb.getConnection({
      user: 'PROYECTO HOTEL',
      password: '123',
      connectString: 'localhost:1521/FREE',
    });

    const result = await connection.execute(
      'INSERT INTO RESERVACIONES (cliente_id, habitacion_id, fecha_reserva, fecha_ingreso) VALUES (:cliente_id, :habitacion_id, :fecha_reserva, :fecha_ingreso)',
      [cliente_id, habitacion_id, fecha_reserva, fecha_ingreso],
      { autoCommit: true }
    );

    res.status(201).json({ message: 'Reservación creada exitosamente' });
    await connection.close();
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
}

module.exports = { obtenerReservaciones, crearReservacion };
