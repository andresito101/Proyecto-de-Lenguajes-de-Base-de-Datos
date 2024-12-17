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

// Obtener todas las habitaciones
async function getAllHabitaciones() {
    let connection;
    try {
        connection = await getConnection();
        const query = `
        SELECT Num_Habitacion, Tipo, Precio, Estado
        FROM habitacion`;
        const result = await connection.execute(query);
        return result.rows;
    } catch (err) {
        throw new Error('Error al obtener las habitaciones: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Obtener una habitación específica por número
async function getHabitacionByNumero(Num_Habitacion) {
    let connection;
    try {
        connection = await getConnection();
        const query = `
        SELECT Num_Habitacion, Tipo, Precio, Estado
        FROM habitacion
        WHERE Num_Habitacion = :Num_Habitacion`;
        const result = await connection.execute(query, [Num_Habitacion]);
        return result.rows[0];
    } catch (err) {
        throw new Error('Error al obtener la habitación: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Crear una nueva habitación
async function createHabitacion(data) {
    let connection;
    try {
        connection = await getConnection();
        const query = `
        INSERT INTO habitacion (Num_Habitacion, Tipo, Precio, Estado)
        VALUES (:Num_Habitacion, :Tipo, :Precio, :Estado)`;
        const result = await connection.execute(query, {
            Num_Habitacion: data.Num_Habitacion,
            Tipo: data.Tipo,
            Precio: data.Precio,
            Estado: data.Estado,
        }, { autoCommit: true });
        return result;
    } catch (err) {
        throw new Error('Error al crear la habitación: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Actualizar una habitación
async function updateHabitacion(Num_Habitacion, data) {
    let connection;
    try {
        connection = await getConnection();
        const query = `
        UPDATE habitacion
        SET Tipo = :Tipo,
            Precio = :Precio,
            Estado = :Estado
        WHERE Num_Habitacion = :Num_Habitacion`;
        const result = await connection.execute(query, {
            Tipo: data.Tipo,
            Precio: data.Precio,
            Estado: data.Estado,
            Num_Habitacion: Num_Habitacion,
        }, { autoCommit: true });
        return result;
    } catch (err) {
        throw new Error('Error al actualizar la habitación: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Eliminar una habitación
async function deleteHabitacion(Num_Habitacion) {
    let connection;
    try {
        connection = await getConnection();
        const query = `DELETE FROM habitacion WHERE Num_Habitacion = :Num_Habitacion`;
        const result = await connection.execute(query, [Num_Habitacion], { autoCommit: true });
        return result;
    } catch (err) {
        throw new Error('Error al eliminar la habitación: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

module.exports = {
    getAllHabitaciones,
    getHabitacionByNumero,
    createHabitacion,
    updateHabitacion,
    deleteHabitacion,
};
