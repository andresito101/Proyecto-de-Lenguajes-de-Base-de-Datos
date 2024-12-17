const oracledb = require('oracledb');
const pedidosSuministros = require('../models/pedidosSuministros');

async function obtenerPedidosSuministros(req, res) {
    try {
        const connection = await oracledb.getConnection({
            user: 'PROYECTO HOTEL',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });

        const result = await connection.execute('SELECT * FROM PEDIDOS_SUMINISTROS');
        res.json(result.rows);
        await connection.close();
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

async function crearPedidoSuministro(req, res) {
    const { ID_Pedido, ID_Suministro, Cantidad } = req.body;
    try {
        const connection = await oracledb.getConnection({
            user: 'PROYECTO HOTEL',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });

        const result = await connection.execute(
            'INSERT INTO PEDIDOS_SUMINISTROS (ID_Pedido, ID_Suministro, Cantidad) VALUES (:ID_Pedido, :ID_Suministro, :Cantidad)',
            [ID_Pedido, ID_Suministro, Cantidad],
            { autoCommit: true }
        );

        res.status(201).json({ message: 'Pedido de suministro creado exitosamente' });
        await connection.close();
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

async function editarPedidoSuministro(req, res) {
    const { ID_Pedido, ID_Suministro, Cantidad } = req.body;
    try {
        const connection = await oracledb.getConnection({
            user: 'PROYECTO HOTEL',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });

        const result = await connection.execute(
            'UPDATE PEDIDOS_SUMINISTROS SET Cantidad = :Cantidad WHERE ID_Pedido = :ID_Pedido AND ID_Suministro = :ID_Suministro',
            [Cantidad, ID_Pedido, ID_Suministro],
            { autoCommit: true }
        );

        res.status(200).json({ message: 'Pedido de suministro actualizado exitosamente' });
        await connection.close();
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

async function eliminarPedidoSuministro(req, res) {
    const { ID_Pedido, ID_Suministro } = req.params;
    try {
        const connection = await oracledb.getConnection({
            user: 'PROYECTO HOTEL',
            password: '123',
            connectString: 'localhost:1521/FREE',
        });

        const result = await connection.execute(
            'DELETE FROM PEDIDOS_SUMINISTROS WHERE ID_Pedido = :ID_Pedido AND ID_Suministro = :ID_Suministro',
            [ID_Pedido, ID_Suministro],
            { autoCommit: true }
        );

        res.status(200).json({ message: 'Pedido de suministro eliminado exitosamente' });
        await connection.close();
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

module.exports = {
    obtenerPedidosSuministros,
    crearPedidoSuministro,
    editarPedidoSuministro,
    eliminarPedidoSuministro,
};
