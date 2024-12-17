const oracledb = require('oracledb');

class RestaurantesModel {
    constructor() {
        this.connectionConfig = {
            user: 'PROYECTO HOTEL',
            password: '123',
            connectString: 'localhost:1521/FREE',
        };
    }

    async obtenerTodos() {
        const connection = await oracledb.getConnection(this.connectionConfig);
        const result = await connection.execute('SELECT * FROM RESTAURANTES');
        await connection.close();
        return result.rows;
    }

    async crear(data) {
        const connection = await oracledb.getConnection(this.connectionConfig);
        await connection.execute(
            `INSERT INTO RESTAURANTES (ID_Hotel, Nombre, TipoDeComida, HoraApertura, HoraCierre) 
    VALUES (:ID_Hotel, :Nombre, :TipoDeComida, :HoraApertura, :HoraCierre)`,
            [data.ID_Hotel, data.Nombre, data.TipoDeComida, data.HoraApertura, data.HoraCierre],
            { autoCommit: true }
        );
        await connection.close();
    }

    async editar(data) {
        const connection = await oracledb.getConnection(this.connectionConfig);
        await connection.execute(
            `UPDATE RESTAURANTES 
    SET ID_Hotel = :ID_Hotel, Nombre = :Nombre, TipoDeComida = :TipoDeComida, 
        HoraApertura = :HoraApertura, HoraCierre = :HoraCierre
    WHERE ID_Restaurante = :ID_Restaurante`,
            [data.ID_Hotel, data.Nombre, data.TipoDeComida, data.HoraApertura, data.HoraCierre, data.ID_Restaurante],
            { autoCommit: true }
        );
        await connection.close();
    }

    async eliminar(ID_Restaurante) {
        const connection = await oracledb.getConnection(this.connectionConfig);
        await connection.execute(
            `DELETE FROM RESTAURANTES WHERE ID_Restaurante = :ID_Restaurante`,
            [ID_Restaurante],
            { autoCommit: true }
        );
        await connection.close();
    }
}

module.exports = new RestaurantesModel();
