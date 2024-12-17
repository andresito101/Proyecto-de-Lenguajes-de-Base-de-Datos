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

// Obtener todos los hoteles
async function getAllHoteles() {
    let connection;
    try {
        connection = await getConnection();
        const query = 'SELECT * FROM hotel';
        const result = await connection.execute(query);
        return result.rows;
    } catch (err) {
        throw new Error('Error al obtener hoteles: ' + err);
    } finally {
        if (connection) await connection.close();
    }
}

// Obtener un hotel por ID
async function getHotelById(ID_Hotel) {
    let connection;
    try {
        connection = await getConnection();
        const query = 'SELECT * FROM hotel WHERE ID_Hotel = :ID_Hotel';
        const result = await connection.execute(query, [ID_Hotel]);
        return result.rows[0];
    } catch (err) {
        throw new Error('Error al obtener el hotel: ' + err);
    } finally {
        if (connection) await connection.close();
    }
}

// Crear un hotel
async function createHotel(data) {
    let connection;
    try {
        connection = await getConnection();
        const query = `
            INSERT INTO hotel (Nombre, Ciudad, Pais, CantidadEstrellas, Telefono)
            VALUES (:Nombre, :Ciudad, :Pais, :CantidadEstrellas, :Telefono)`;
        const result = await connection.execute(query, data, { autoCommit: true });
        return result;
    } catch (err) {
        throw new Error('Error al crear el hotel: ' + err);
    } finally {
        if (connection) await connection.close();
    }
}

// Actualizar un hotel
async function updateHotel(ID_Hotel, data) {
    let connection;
    try {
        connection = await getConnection();
        const query = `
            UPDATE hotel
            SET Nombre = :Nombre,
                Ciudad = :Ciudad,
                Pais = :Pais,
                CantidadEstrellas = :CantidadEstrellas,
                Telefono = :Telefono
            WHERE ID_Hotel = :ID_Hotel`;
        const result = await connection.execute({ ...data, ID_Hotel }, { autoCommit: true });
        return result;
    } catch (err) {
        throw new Error('Error al actualizar el hotel: ' + err);
    } finally {
        if (connection) await connection.close();
    }
}

// Eliminar un hotel
async function deleteHotel(ID_Hotel) {
    let connection;
    try {
        connection = await getConnection();
        const query = 'DELETE FROM hotel WHERE ID_Hotel = :ID_Hotel';
        const result = await connection.execute(query, [ID_Hotel], { autoCommit: true });
        return result;
    } catch (err) {
        throw new Error('Error al eliminar el hotel: ' + err);
    } finally {
        if (connection) await connection.close();
    }
}

module.exports = {
    getAllHoteles,
    getHotelById,
    createHotel,
    updateHotel,
    deleteHotel,
};
