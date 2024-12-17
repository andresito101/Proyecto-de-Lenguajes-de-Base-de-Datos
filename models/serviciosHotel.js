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

// Model para obtener todos los servicios
async function getAllServicios() {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute('SELECT * FROM SERVICIOS');
        return result.rows;
    } catch (err) {
        throw new Error('Error al obtener servicios: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Model para crear un nuevo servicio
async function createServicio(servicio) {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            'INSERT INTO SERVICIOS (ID_SERVICIO, NOMBRE_SERVICIO) VALUES (:id_servicio, :nombre_servicio)',
            [servicio.idServicio, servicio.nombreServicio],
            { autoCommit: true }
        );
        return result;
    } catch (err) {
        throw new Error('Error al crear servicio: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Model para editar un servicio existente
async function editServicio(servicio) {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            'UPDATE SERVICIOS SET NOMBRE_SERVICIO = :nombre_servicio WHERE ID_SERVICIO = :id_servicio',
            [servicio.nombreServicio, servicio.idServicio],
            { autoCommit: true }
        );
        return result;
    } catch (err) {
        throw new Error('Error al editar servicio: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Model para eliminar un servicio
async function deleteServicio(idServicio) {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            'DELETE FROM SERVICIOS WHERE ID_SERVICIO = :id_servicio',
            [idServicio],
            { autoCommit: true }
        );
        return result;
    } catch (err) {
        throw new Error('Error al eliminar servicio: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

module.exports = {
    getAllServicios,
    createServicio,
    editServicio,
    deleteServicio,
};
