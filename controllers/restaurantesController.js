const oracledb = require('oracledb');
const restaurantes = require('../models/restaurantes');

// Obtener todos los restaurantes
async function obtenerRestaurantes(req, res) {
    try {
        const connection = await oracledb.getConnection({
            user: 'PROYECTO HOTEL',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });

        const result = await connection.execute('SELECT * FROM RESTAURANTES');
        res.json(result.rows);
        await connection.close();
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Crear un restaurante
async function crearRestaurante(req, res) {
    const { ID_Hotel, Nombre, TipoDeComida, HoraApertura, HoraCierre } = req.body;
    try {
        const connection = await oracledb.getConnection({
            user: 'PROYECTO HOTEL',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });

        await connection.execute(
            `INSERT INTO RESTAURANTES (ID_Hotel, Nombre, TipoDeComida, HoraApertura, HoraCierre) 
    VALUES (:ID_Hotel, :Nombre, :TipoDeComida, :HoraApertura, :HoraCierre)`,
            [ID_Hotel, Nombre, TipoDeComida, HoraApertura, HoraCierre],
            { autoCommit: true }
        );

        res.status(201).json({ message: 'Restaurante creado exitosamente' });
        await connection.close();
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Editar un restaurante
async function editarRestaurante(req, res) {
    const { ID_Restaurante, ID_Hotel, Nombre, TipoDeComida, HoraApertura, HoraCierre } = req.body;
    try {
        const connection = await oracledb.getConnection({
            user: 'PROYECTO HOTEL',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });

        await connection.execute(
            `UPDATE RESTAURANTES 
    SET ID_Hotel = :ID_Hotel, Nombre = :Nombre, TipoDeComida = :TipoDeComida, 
        HoraApertura = :HoraApertura, HoraCierre = :HoraCierre
    WHERE ID_Restaurante = :ID_Restaurante`,
            [ID_Hotel, Nombre, TipoDeComida, HoraApertura, HoraCierre, ID_Restaurante],
            { autoCommit: true }
        );

        res.json({ message: 'Restaurante actualizado exitosamente' });
        await connection.close();
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Eliminar un restaurante
async function eliminarRestaurante(req, res) {
    const { ID_Restaurante } = req.body;
    try {
        const connection = await oracledb.getConnection({
            user: 'PROYECTO HOTEL',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });

        await connection.execute(
            `DELETE FROM RESTAURANTES WHERE ID_Restaurante = :ID_Restaurante`,
            [ID_Restaurante],
            { autoCommit: true }
        );

        res.json({ message: 'Restaurante eliminado exitosamente' });
        await connection.close();
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

module.exports = {
    obtenerRestaurantes,
    crearRestaurante,
    editarRestaurante,
    eliminarRestaurante,
};
