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

// Obtener todas las estancias
async function getAllEstancias() {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute('SELECT * FROM REGISTRO_ESTANCIAS');
        return result.rows; // Devuelve las filas como un arreglo
    } catch (err) {
        throw new Error('Error al obtener las estancias: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Crear una nueva estancia
async function createEstancia(data) {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            `INSERT INTO REGISTRO_ESTANCIAS 
    (ID_ESTANCIA, ID_CLIENTE, ID_HABITACION, FECHA_ENTRADA, FECHA_SALIDA)
    VALUES (:idEstancia, :idCliente, :idHabitacion, :fechaEntrada, :fechaSalida)`,
            {
                idEstancia: data.ID_Estancia,
                idCliente: data.ID_Cliente,
                idHabitacion: data.ID_Habitacion,
                fechaEntrada: data.Fecha_Entrada,
                fechaSalida: data.Fecha_Salida,
            },
            { autoCommit: true }
        );
        return result;
    } catch (err) {
        throw new Error('Error al crear la estancia: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Actualizar una estancia existente
async function updateEstancia(data) {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            `UPDATE REGISTRO_ESTANCIAS
    SET ID_CLIENTE = :idCliente,
        ID_HABITACION = :idHabitacion,
        FECHA_ENTRADA = :fechaEntrada,
        FECHA_SALIDA = :fechaSalida
    WHERE ID_ESTANCIA = :idEstancia`,
            {
                idEstancia: data.ID_Estancia,
                idCliente: data.ID_Cliente,
                idHabitacion: data.ID_Habitacion,
                fechaEntrada: data.Fecha_Entrada,
                fechaSalida: data.Fecha_Salida,
            },
            { autoCommit: true }
        );
        return result;
    } catch (err) {
        throw new Error('Error al actualizar la estancia: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Eliminar una estancia
async function deleteEstancia(idEstancia) {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            'DELETE FROM REGISTRO_ESTANCIAS WHERE ID_ESTANCIA = :idEstancia',
            { idEstancia },
            { autoCommit: true }
        );
        return result;
    } catch (err) {
        throw new Error('Error al eliminar la estancia: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

module.exports = {
    getAllEstancias,
    createEstancia,
    updateEstancia,
    deleteEstancia,
};
