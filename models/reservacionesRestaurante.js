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

// Modelo para obtener todas las reservaciones de restaurantes
async function getAllReservacionesRestaurante() {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            `SELECT 
        R.ID_RESERVACION,
        R.ID_RESTAURANTE,
        REST.NOMBRE AS NOMBRE_RESTAURANTE,
        R.ID_CLIENTE,
        CLI.NOMBRE || ' ' || CLI.APELLIDO AS NOMBRE_CLIENTE,
        R.FECHA,
        R.ESTADO
       FROM RESERVACIONES_RESTAURANTES R
       JOIN RESTAURANTES REST ON R.ID_RESTAURANTE = REST.ID_RESTAURANTE
       JOIN CLIENTES CLI ON R.ID_CLIENTE = CLI.ID_CLIENTE`
        );
        return result.rows;
    } catch (err) {
        throw new Error('Error al obtener reservaciones de restaurantes: ' + err.message);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Modelo para crear una nueva reservación de restaurante
async function createReservacionRestaurante(reservacion) {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            `INSERT INTO RESERVACIONES_RESTAURANTES 
        (ID_RESERVACION, ID_RESTAURANTE, ID_CLIENTE, FECHA, ESTADO)
       VALUES (:id_reservacion, :id_restaurante, :id_cliente, :fecha, :estado)`,
            [
                reservacion.idReservacion,
                reservacion.idRestaurante,
                reservacion.idCliente,
                reservacion.fecha,
                reservacion.estado,
            ],
            { autoCommit: true }
        );
        return result;
    } catch (err) {
        throw new Error('Error al crear reservación de restaurante: ' + err.message);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Modelo para eliminar una reservación de restaurante
async function deleteReservacionRestaurante(idReservacion) {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            `DELETE FROM RESERVACIONES_RESTAURANTES WHERE ID_RESERVACION = :id_reservacion`,
            [idReservacion],
            { autoCommit: true }
        );
        return result;
    } catch (err) {
        throw new Error('Error al eliminar reservación de restaurante: ' + err.message);
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
