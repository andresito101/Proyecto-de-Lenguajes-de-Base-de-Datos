const oracledb = require('oracledb');
const habitaciones = require('../models/habitaciones');

// Crear una conexión a la base de datos
const getConnection = async () => {
    try {
        return await oracledb.getConnection({
            user: 'your_username',
            password: 'your_password',
            connectString: 'your_connection_string'
        });
    } catch (err) {
        console.error('Error al conectar con la base de datos:', err);
        throw err;
    }
};

// Guardar o actualizar habitación
exports.guardarHabitacion = async (req, res) => {
    const { Num_Habitacion, ID_Hotel, Tipo_de_Habitacion, Precio_por_noche, accion } = req.body;
    let query;
    let params;

    if (accion === 'crear') {
        query = `INSERT INTO habitacion (Num_Habitacion, ID_Hotel, Tipo_de_Habitacion, Precio_por_noche)
                VALUES (:Num_Habitacion, :ID_Hotel, :Tipo_de_Habitacion, :Precio_por_noche)`;
        params = { Num_Habitacion, ID_Hotel, Tipo_de_Habitacion, Precio_por_noche };
    } else if (accion === 'editar') {
        query = `UPDATE habitacion
                SET ID_Hotel = :ID_Hotel,
                    Tipo_de_Habitacion = :Tipo_de_Habitacion,
                    Precio_por_noche = :Precio_por_noche
                WHERE Num_Habitacion = :Num_Habitacion`;
        params = { Num_Habitacion, ID_Hotel, Tipo_de_Habitacion, Precio_por_noche };
    } else {
        return res.status(400).json({ error: 'Acción no reconocida' });
    }

    try {
        const connection = await getConnection();
        const result = await connection.execute(query, params, { autoCommit: true });
        res.status(200).json({ success: true, rowsAffected: result.rowsAffected });
        await connection.close();
    } catch (err) {
        console.error('Error al guardar habitación:', err);
        res.status(500).json({ error: 'Error al guardar habitación' });
    }
};

// Eliminar habitación
exports.eliminarHabitacion = async (req, res) => {
    const { Num_Habitacion } = req.params;

    const query = `DELETE FROM habitacion WHERE Num_Habitacion = :Num_Habitacion`;

    try {
        const connection = await getConnection();
        const result = await connection.execute(query, { Num_Habitacion }, { autoCommit: true });
        res.status(200).json({ success: true, rowsAffected: result.rowsAffected });
        await connection.close();
    } catch (err) {
        console.error('Error al eliminar habitación:', err);
        res.status(500).json({ error: 'Error al eliminar habitación' });
    }
};

// Listar todas las habitaciones
exports.listarHabitaciones = async (req, res) => {
    const query = `SELECT Num_Habitacion, ID_Hotel, Tipo_de_Habitacion, Precio_por_noche FROM habitacion`;

    try {
        const connection = await getConnection();
        const result = await connection.execute(query);
        res.status(200).json(result.rows);
        await connection.close();
    } catch (err) {
        console.error('Error al listar habitaciones:', err);
        res.status(500).json({ error: 'Error al listar habitaciones' });
    }
};
