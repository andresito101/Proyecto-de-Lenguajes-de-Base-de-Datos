const oracledb = require('oracledb');
const retroalimentacionModel = require('../models/retroalimentacion');



async function obtenerRetroalimentaciones(req, res) {
  try {
    const connection = await oracledb.getConnection({
      user: 'PROYECTO HOTEL',
      password: '123',
      connectString: 'localhost:1521/FREE',
    });

    const result = await connection.execute('SELECT * FROM RETROALIMENTACION');
    res.json(result.rows);
    await connection.close();
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
}

async function crearRetroalimentacion(req, res) {
  const { cliente_id, comentario, fecha } = req.body;
  try {
    const connection = await oracledb.getConnection({
      user: 'PROYECTO HOTEL',
      password: '123',
      connectString: 'localhost:1521/FREE',
    });

    const result = await connection.execute(
      'INSERT INTO RETROALIMENTACION (cliente_id, comentario, fecha) VALUES (:cliente_id, :comentario, :fecha)',
      [cliente_id, comentario, fecha],
      { autoCommit: true }
    );

    res.status(201).json({ message: 'Retroalimentación registrada exitosamente' });
    await connection.close();
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
}

module.exports = { obtenerRetroalimentaciones, crearRetroalimentacion };
