const oracledb = require('oracledb');
const reservacionesRestaurante = require('../models/reservacionesRestaurante');

// Función para obtener una conexión
async function getConnection() {
    try {
        return await oracledb.getConnection({
            user: 'C##HOTEL_PROYECTO',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });
    } catch (err) {
        throw new Error('Error al conectar a la base de datos: ' + err);
    }
}

// Obtener todas las reservaciones de restaurantes
async function getAllReservaciones() {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(`SELECT * FROM RESERVACIONES_RESTAURANTES`);
        return result.rows;
    } catch (err) {
        throw new Error('Error al obtener las reservaciones: ' + err);
    } finally {
        if (connection) await connection.close();
    }
}

// Crear una nueva reservación
async function createReservacion(data) {
    let connection;
    try {
        connection = await getConnection();
        const query = `
            INSERT INTO RESERVACIONES_RESTAURANTES 
            (ID_RESTAURANTE, ID_CLIENTE, FECHA, ESTADO)
            VALUES (:idRestaurante, :idCliente, :fecha, :estado)
        `;
        await connection.execute(query, {
            idRestaurante: data.ID_Restaurante,
            idCliente: data.ID_Cliente,
            fecha: data.Fecha,
            estado: data.Estado
        }, { autoCommit: true });
        return { message: 'Reservación creada correctamente.' };
    } catch (err) {
        throw new Error('Error al crear la reservación: ' + err);
    } finally {
        if (connection) await connection.close();
    }
}

// Actualizar una reservación existente
async function updateReservacion(data) {
    let connection;
    try {
        connection = await getConnection();
        const query = `
            UPDATE RESERVACIONES_RESTAURANTES
            SET ID_RESTAURANTE = :idRestaurante, 
                ID_CLIENTE = :idCliente, 
                FECHA = :fecha, 
                ESTADO = :estado
            WHERE ID_RESERVACION = :idReservacion
        `;
        await connection.execute(query, {
            idReservacion: data.ID_Reservacion,
            idRestaurante: data.ID_Restaurante,
            idCliente: data.ID_Cliente,
            fecha: data.Fecha,
            estado: data.Estado
        }, { autoCommit: true });
        return { message: 'Reservación actualizada correctamente.' };
    } catch (err) {
        throw new Error('Error al actualizar la reservación: ' + err);
    } finally {
        if (connection) await connection.close();
    }
}

// Eliminar una reservación
async function deleteReservacion(idReservacion) {
    let connection;
    try {
        connection = await getConnection();
        const query = `DELETE FROM RESERVACIONES_RESTAURANTES WHERE ID_RESERVACION = :idReservacion`;
        await connection.execute(query, { idReservacion }, { autoCommit: true });
        return { message: 'Reservación eliminada correctamente.' };
    } catch (err) {
        throw new Error('Error al eliminar la reservación: ' + err);
    } finally {
        if (connection) await connection.close();
    }
}

module.exports = {
    getAllReservaciones,
    createReservacion,
    updateReservacion,
    deleteReservacion
};
