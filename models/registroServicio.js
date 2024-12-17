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
        throw new Error('Error al conectar a la base de datos: ' + err);
    }
}

// Obtener todos los registros de servicios
async function getAllServicios() {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute('SELECT * FROM REGISTRO_SERVICIOS');
        return result.rows; // Devuelve las filas como un arreglo
    } catch (err) {
        throw new Error('Error al obtener los registros de servicios: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Crear un nuevo registro de servicio
async function createServicio(data) {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            `INSERT INTO REGISTRO_SERVICIOS 
    (ID_SERVICIO, ID_REGISTRO, ESTADO)
    VALUES (:idServicio, :idRegistro, :estado)`,
            {
                idServicio: data.ID_Servicio,
                idRegistro: data.ID_Registro,
                estado: data.Estado,
            },
            { autoCommit: true }
        );
        return result;
    } catch (err) {
        throw new Error('Error al crear el registro de servicio: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Actualizar un registro de servicio existente
async function updateServicio(data) {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            `UPDATE REGISTRO_SERVICIOS
    SET ID_REGISTRO = :idRegistro,
        ESTADO = :estado
    WHERE ID_SERVICIO = :idServicio`,
            {
                idServicio: data.ID_Servicio,
                idRegistro: data.ID_Registro,
                estado: data.Estado,
            },
            { autoCommit: true }
        );
        return result;
    } catch (err) {
        throw new Error('Error al actualizar el registro de servicio: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Eliminar un registro de servicio
async function deleteServicio(idServicio) {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            'DELETE FROM REGISTRO_SERVICIOS WHERE ID_SERVICIO = :idServicio',
            { idServicio },
            { autoCommit: true }
        );
        return result;
    } catch (err) {
        throw new Error('Error al eliminar el registro de servicio: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

module.exports = {
    getAllServicios,
    createServicio,
    updateServicio,
    deleteServicio,
};
