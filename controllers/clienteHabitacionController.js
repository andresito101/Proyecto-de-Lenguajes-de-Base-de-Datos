const oracledb = require('oracledb');
const clienteHabitacion = require('../models/clienteHabitacion');

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

// Crear o actualizar cliente-habitación
exports.guardarClienteHabitacion = async (req, res) => {
    const { ID_Cliente, Num_Habitacion, Fecha_Entrada, Fecha_Salida, accion } = req.body;
    let query;
    let params;

    if (accion === 'crear') {
        query = `INSERT INTO cliente_habitacion (ID_Cliente, Num_Habitacion, Fecha_Entrada, Fecha_Salida)
            VALUES (:ID_Cliente, :Num_Habitacion, TO_DATE(:Fecha_Entrada, 'YYYY-MM-DD'), TO_DATE(:Fecha_Salida, 'YYYY-MM-DD'))`;
        params = { ID_Cliente, Num_Habitacion, Fecha_Entrada, Fecha_Salida };
    } else {
        query = `UPDATE cliente_habitacion
            SET Num_Habitacion = :Num_Habitacion,
                Fecha_Entrada = TO_DATE(:Fecha_Entrada, 'YYYY-MM-DD'),
                Fecha_Salida = TO_DATE(:Fecha_Salida, 'YYYY-MM-DD')
            WHERE ID_Cliente = :ID_Cliente`;
        params = { Num_Habitacion, Fecha_Entrada, Fecha_Salida, ID_Cliente };
    }

    try {
        const connection = await getConnection();
        const result = await connection.execute(query, params, { autoCommit: true });
        res.status(200).json({ success: true, rowsAffected: result.rowsAffected });
        await connection.close();
    } catch (err) {
        console.error('Error al guardar cliente-habitación:', err);
        res.status(500).json({ error: 'Error al guardar cliente-habitación' });
    }
};

// Eliminar cliente-habitación
exports.eliminarClienteHabitacion = async (req, res) => {
    const { ID_Cliente } = req.params;

    const query = `DELETE FROM cliente_habitacion WHERE ID_Cliente = :ID_Cliente`;

    try {
        const connection = await getConnection();
        const result = await connection.execute(query, { ID_Cliente }, { autoCommit: true });
        res.status(200).json({ success: true, rowsAffected: result.rowsAffected });
        await connection.close();
    } catch (err) {
        console.error('Error al eliminar cliente-habitación:', err);
        res.status(500).json({ error: 'Error al eliminar cliente-habitación' });
    }
};

// Listar todos los registros de cliente-habitación
exports.listarClienteHabitacion = async (req, res) => {
    const query = `
    SELECT c.ID_Cliente, c.Nombre AS Nombre_Cliente, h.Num_Habitacion, ch.Fecha_Entrada, ch.Fecha_Salida
    FROM cliente_habitacion ch
    JOIN cliente c ON ch.ID_Cliente = c.ID_Cliente
    JOIN habitacion h ON ch.Num_Habitacion = h.Num_Habitacion`;

    try {
        const connection = await getConnection();
        const result = await connection.execute(query);
        res.status(200).json(result.rows);
        await connection.close();
    } catch (err) {
        console.error('Error al listar cliente-habitación:', err);
        res.status(500).json({ error: 'Error al listar cliente-habitación' });
    }
};
