const oracledb = require('oracledb');
const pedidos = require('../models/pedidos');

// Controlador para obtener todos los pedidos de suministros
async function obtenerPedidosSuministros(req, res) {
    try {
        const pedidos = await pedidosSuministrosModel.getAllPedidosSuministros();
        res.json(pedidos);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Controlador para crear un nuevo pedido de suministro
async function crearPedidoSuministro(req, res) {
    const { ID_Pedido, ID_Suministro, Cantidad } = req.body;
    try {
        const pedidoSuministro = { ID_Pedido, ID_Suministro, Cantidad };
        await pedidosSuministrosModel.createPedidoSuministro(pedidoSuministro);
        res.status(201).json({ message: 'Pedido de suministro creado exitosamente' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Controlador para editar un pedido de suministro
async function editarPedidoSuministro(req, res) {
    const { ID_Pedido, ID_Suministro, Cantidad } = req.body;
    try {
        const pedidoSuministro = { ID_Pedido, ID_Suministro, Cantidad };
        await pedidosSuministrosModel.updatePedidoSuministro(pedidoSuministro);
        res.status(200).json({ message: 'Pedido de suministro actualizado exitosamente' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Controlador para eliminar un pedido de suministro
async function eliminarPedidoSuministro(req, res) {
    const { ID_Pedido, ID_Suministro } = req.params;
    try {
        await pedidosSuministrosModel.deletePedidoSuministro(ID_Pedido, ID_Suministro);
        res.status(200).json({ message: 'Pedido de suministro eliminado exitosamente' });
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
