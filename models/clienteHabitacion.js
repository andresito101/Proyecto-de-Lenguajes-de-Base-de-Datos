const oracledb = require('oracledb');

// Crear una conexión a la base de datos
async function getConnection() {
    try {
        return await oracledb.getConnection({
            user: 'C##HOTEL_PROYECTO',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });
    } catch (err) {
        throw new Error('Error al conectar con la base de datos: ' + err);
    }
}

// Obtener todos los registros de cliente-habitación
async function getAllClienteHabitacion() {
    let connection;
    try {
        connection = await getConnection();
        const query = `
    SELECT ch.ID_Cliente, c.Nombre AS Nombre_Cliente, h.Num_Habitacion, ch.Fecha_Entrada, ch.Fecha_Salida
    FROM cliente_habitacion ch
    JOIN cliente c ON ch.ID_Cliente = c.ID_Cliente
    JOIN habitacion h ON ch.Num_Habitacion = h.Num_Habitacion`;
        const result = await connection.execute(query);
        return result.rows;
    } catch (err) {
        throw new Error('Error al obtener registros de cliente-habitación: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Obtener un registro específico de cliente-habitación por ID de cliente
async function getClienteHabitacionById(ID_Cliente) {
    let connection;
    try {
        connection = await getConnection();
        const query = `
    SELECT ch.ID_Cliente, c.Nombre AS Nombre_Cliente, h.Num_Habitacion, ch.Fecha_Entrada, ch.Fecha_Salida
    FROM cliente_habitacion ch
    JOIN cliente c ON ch.ID_Cliente = c.ID_Cliente
    JOIN habitacion h ON ch.Num_Habitacion = h.Num_Habitacion
    WHERE ch.ID_Cliente = :ID_Cliente`;
        const result = await connection.execute(query, [ID_Cliente]);
        return result.rows[0];
    } catch (err) {
        throw new Error('Error al obtener cliente-habitación por ID: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Crear un nuevo registro en cliente-habitación
async function createClienteHabitacion(data) {
    let connection;
    try {
        connection = await getConnection();
        const query = `
    INSERT INTO cliente_habitacion (ID_Cliente, Num_Habitacion, Fecha_Entrada, Fecha_Salida)
    VALUES (:ID_Cliente, :Num_Habitacion, TO_DATE(:Fecha_Entrada, 'YYYY-MM-DD'), TO_DATE(:Fecha_Salida, 'YYYY-MM-DD'))`;
        const result = await connection.execute(query, {
            ID_Cliente: data.ID_Cliente,
            Num_Habitacion: data.Num_Habitacion,
            Fecha_Entrada: data.Fecha_Entrada,
            Fecha_Salida: data.Fecha_Salida,
        }, { autoCommit: true });
        return result;
    } catch (err) {
        throw new Error('Error al crear cliente-habitación: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Actualizar un registro de cliente-habitación
async function updateClienteHabitacion(ID_Cliente, data) {
    let connection;
    try {
        connection = await getConnection();
        const query = `
    UPDATE cliente_habitacion
    SET Num_Habitacion = :Num_Habitacion,
        Fecha_Entrada = TO_DATE(:Fecha_Entrada, 'YYYY-MM-DD'),
        Fecha_Salida = TO_DATE(:Fecha_Salida, 'YYYY-MM-DD')
    WHERE ID_Cliente = :ID_Cliente`;
        const result = await connection.execute(query, {
            Num_Habitacion: data.Num_Habitacion,
            Fecha_Entrada: data.Fecha_Entrada,
            Fecha_Salida: data.Fecha_Salida,
            ID_Cliente: ID_Cliente,
        }, { autoCommit: true });
        return result;
    } catch (err) {
        throw new Error('Error al actualizar cliente-habitación: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Eliminar un registro de cliente-habitación
async function deleteClienteHabitacion(ID_Cliente) {
    let connection;
    try {
        connection = await getConnection();
        const query = `DELETE FROM cliente_habitacion WHERE ID_Cliente = :ID_Cliente`;
        const result = await connection.execute(query, [ID_Cliente], { autoCommit: true });
        return result;
    } catch (err) {
        throw new Error('Error al eliminar cliente-habitación: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

module.exports = {
    getAllClienteHabitacion,
    getClienteHabitacionById,
    createClienteHabitacion,
    updateClienteHabitacion,
    deleteClienteHabitacion,
};
