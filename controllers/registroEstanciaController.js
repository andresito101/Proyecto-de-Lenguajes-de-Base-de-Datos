const oracledb = require('oracledb');
const registroEstancia = require('../models/registroEstancia');


// Controlador para obtener todas las estancias
async function obtenerEstancias(req, res) {
    try {
        const estancias = await registroEstanciasModel.getAllEstancias();
        res.json(estancias);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Controlador para crear una nueva estancia
async function crearEstancia(req, res) {
    const { ID_Cliente, ID_Habitacion, Fecha_Entrada, Fecha_Salida } = req.body;
    try {
        const nuevaEstancia = { ID_Cliente, ID_Habitacion, Fecha_Entrada, Fecha_Salida };
        await registroEstanciasModel.createEstancia(nuevaEstancia);
        res.status(201).json({ message: 'Estancia creada exitosamente' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Controlador para actualizar una estancia existente
async function actualizarEstancia(req, res) {
    const { ID_Estancia, ID_Cliente, ID_Habitacion, Fecha_Entrada, Fecha_Salida } = req.body;
    try {
        const estanciaActualizada = { ID_Estancia, ID_Cliente, ID_Habitacion, Fecha_Entrada, Fecha_Salida };
        await registroEstanciasModel.updateEstancia(estanciaActualizada);
        res.status(200).json({ message: 'Estancia actualizada exitosamente' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Controlador para eliminar una estancia
async function eliminarEstancia(req, res) {
    const { ID_Estancia } = req.params;
    try {
        await registroEstanciasModel.deleteEstancia(ID_Estancia);
        res.status(200).json({ message: 'Estancia eliminada exitosamente' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

module.exports = {
    obtenerEstancias,
    crearEstancia,
    actualizarEstancia,
    eliminarEstancia,
};
