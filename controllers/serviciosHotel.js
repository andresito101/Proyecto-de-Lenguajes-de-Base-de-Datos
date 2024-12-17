const oracledb = require('oracledb');
const servicios = require('../models/servicios'); // Asegúrate de tener este archivo en la carpeta 'models'

// Obtener todos los servicios
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

// Crear un nuevo servicio
async function crearServicio(req, res) {
    const { Nombre_Servicio } = req.body;
    try {
        const connection = await oracledb.getConnection({
            user: 'PROYECTO HOTEL',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });

        const sql = 'INSERT INTO SERVICIOS (Nombre_Servicio) VALUES (:Nombre_Servicio)';
        await connection.execute(sql, [Nombre_Servicio], { autoCommit: true });

        res.status(201).json({ message: 'Servicio creado exitosamente' });
        await connection.close();
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Editar un servicio existente
async function editarServicio(req, res) {
    const { ID_Servicio, Nombre_Servicio } = req.body;
    try {
        const connection = await oracledb.getConnection({
            user: 'PROYECTO HOTEL',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });

        const sql = 'UPDATE SERVICIOS SET Nombre_Servicio = :Nombre_Servicio WHERE ID_Servicio = :ID_Servicio';
        await connection.execute(sql, [Nombre_Servicio, ID_Servicio], { autoCommit: true });

        res.json({ message: 'Servicio actualizado exitosamente' });
        await connection.close();
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Eliminar un servicio
async function eliminarServicio(req, res) {
    const { ID_Servicio } = req.params;
    try {
        const connection = await oracledb.getConnection({
            user: 'PROYECTO HOTEL',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });

        const sql = 'DELETE FROM SERVICIOS WHERE ID_Servicio = :ID_Servicio';
        await connection.execute(sql, [ID_Servicio], { autoCommit: true });

        res.json({ message: 'Servicio eliminado exitosamente' });
        await connection.close();
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

module.exports = { obtenerServicios, crearServicio, editarServicio, eliminarServicio };
