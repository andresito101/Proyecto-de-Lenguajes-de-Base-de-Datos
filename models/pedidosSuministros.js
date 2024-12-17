const oracledb = require('oracledb');

// Función para obtener una conexión
async function getConnection() {
    try {
        return await oracledb.getConnection({
            user: 'PROYECTO HOTEL',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });
    } catch (err) {
        throw new Error('Error al conectar a la base de datos: ' + err);
    }
}

// Model para obtener todos los pedidos de suministros
async function getAllPedidosSuministros() {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute('SELECT * FROM PEDIDOS_SUMINISTROS');
        return result.rows;
    } catch (err) {
        throw new Error('Error al obtener pedidos de suministros: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Model para crear un nuevo pedido de suministro
async function createPedidoSuministro(pedidoSuministro) {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            'INSERT INTO PEDIDOS_SUMINISTROS (ID_Pedido, ID_Suministro, Cantidad) VALUES (:ID_Pedido, :ID_Suministro, :Cantidad)',
            [pedidoSuministro.ID_Pedido, pedidoSuministro.ID_Suministro, pedidoSuministro.Cantidad],
            { autoCommit: true }
        );
        return result;
    } catch (err) {
        throw new Error('Error al crear pedido de suministro: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Model para editar un pedido de suministro
async function updatePedidoSuministro(pedidoSuministro) {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            'UPDATE PEDIDOS_SUMINISTROS SET Cantidad = :Cantidad WHERE ID_Pedido = :ID_Pedido AND ID_Suministro = :ID_Suministro',
            [pedidoSuministro.Cantidad, pedidoSuministro.ID_Pedido, pedidoSuministro.ID_Suministro],
            { autoCommit: true }
        );
        return result;
    } catch (err) {
        throw new Error('Error al actualizar pedido de suministro: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

// Model para eliminar un pedido de suministro
async function deletePedidoSuministro(ID_Pedido, ID_Suministro) {
    let connection;
    try {
        connection = await getConnection();
        const result = await connection.execute(
            'DELETE FROM PEDIDOS_SUMINISTROS WHERE ID_Pedido = :ID_Pedido AND ID_Suministro = :ID_Suministro',
            [ID_Pedido, ID_Suministro],
            { autoCommit: true }
        );
        return result;
    } catch (err) {
        throw new Error('Error al eliminar pedido de suministro: ' + err);
    } finally {
        if (connection) {
            await connection.close();
        }
    }
}

module.exports = {
    getAllPedidosSuministros,
    createPedidoSuministro,
    updatePedidoSuministro,
    deletePedidoSuministro,
};
