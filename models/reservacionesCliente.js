const oracledb = require('oracledb');

// Función para obtener una conexión
async function getConnection() {
    try {
        return await oracledb.getConnection({
            user: 'C##HOTEL_PROYECTO',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });
    } catch (err) {
        throw new Error('Error al conectar a la base de datos: ' + err.message);
    }
}

// Obtener todas las reservaciones del restaurante
async function getAllReservacionesRestaurante() {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute('SELECT * FROM RESERVACIONES_RESTAURANTE');
        return result.rows;
    } catch (err) {
        throw new Error('Error al obtener reservaciones: ' + err.message);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Crear una nueva reservación
async function createReservacionRestaurante(reservacion) {
    let connection;
    try {
        connection = await getConnection();
        const query = `
    INSERT INTO RESERVACIONES_RESTAURANTE (ID_RESERVACION, ID_CLIENTE, FECHA, ESTADO)
    VALUES (:idReservacion, :idCliente, TO_DATE(:fecha, 'YYYY-MM-DD'), :estado)
    `;
        const params = [
            reservacion.idReservacion,
            reservacion.idCliente,
            reservacion.fecha,
            reservacion.estado,
        ];
        await connection.execute(query, params, { autoCommit: true });
        return { message: 'Reservación creada con éxito' };
    } catch (err) {
        throw new Error('Error al crear reservación: ' + err.message);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Eliminar una reservación por ID
async function deleteReservacionRestaurante(idReservacion) {
    let connection;
    try {
        connection = await getConnection();
        const query = 'DELETE FROM RESERVACIONES_RESTAURANTE WHERE ID_RESERVACION = :idReservacion';
        await connection.execute(query, [idReservacion], { autoCommit: true });
        return { message: 'Reservación eliminada con éxito' };
    } catch (err) {
        throw new Error('Error al eliminar reservación: ' + err.message);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

module.exports = {
    getAllReservacionesRestaurante,
    createReservacionRestaurante,
    deleteReservacionRestaurante,
};
