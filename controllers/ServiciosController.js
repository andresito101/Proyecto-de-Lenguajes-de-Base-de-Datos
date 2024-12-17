const oracledb = require('oracledb');
const servicios = require('../models/servicios');



async function obtenerServicios(req, res) {
  try {
    const connection = await oracledb.getConnection({
      user: 'PROYECTO HOTEL',
      password: '123',
      connectString: 'localhost:1521/FREE',
    });

    const result = await connection.execute('SELECT * FROM SERVICIOS');
    res.json(result.rows);
    await connection.close();
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
}

async function crearServicio(req, res) {
  const { nombre, descripcion, precio } = req.body;
  try {
    const connection = await oracledb.getConnection({
      user: 'PROYECTO HOTEL',
      password: '123',
      connectString: 'localhost:1521/FREE',
    });

    const result = await connection.execute(
      'INSERT INTO SERVICIOS (nombre, descripcion, precio) VALUES (:nombre, :descripcion, :precio)',
      [nombre, descripcion, precio],
      { autoCommit: true }
    );

    res.status(201).json({ message: 'Servicio creado exitosamente' });
    await connection.close();
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
}

module.exports = { obtenerServicios, crearServicio };
