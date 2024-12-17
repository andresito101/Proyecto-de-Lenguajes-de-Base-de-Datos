const oracledb = require('oracledb');
const registroServicio = require('../models/registroServicio');

// Controlador para obtener todos los registros de servicios
async function obtenerRegistros(req, res) {
    try {
        const registros = await registroServiciosModel.getAllRegistros();
        res.json(registros);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Controlador para crear un nuevo registro de servicio
async function crearRegistro(req, res) {
    const { ID_Registro, Estado } = req.body;
    try {
        const nuevoRegistro = { ID_Registro, Estado };
        await registroServiciosModel.createRegistro(nuevoRegistro);
        res.status(201).json({ message: 'Registro de servicio creado exitosamente' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Controlador para actualizar un registro de servicio existente
async function actualizarRegistro(req, res) {
    const { ID_Servicio, ID_Registro, Estado } = req.body;
    try {
        const registroActualizado = { ID_Servicio, ID_Registro, Estado };
        await registroServiciosModel.updateRegistro(registroActualizado);
        res.status(200).json({ message: 'Registro de servicio actualizado exitosamente' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Controlador para eliminar un registro de servicio
async function eliminarRegistro(req, res) {
    const { ID_Servicio } = req.params;
    try {
        await registroServiciosModel.deleteRegistro(ID_Servicio);
        res.status(200).json({ message: 'Registro de servicio eliminado exitosamente' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

module.exports = {
    obtenerRegistros,
    crearRegistro,
    actualizarRegistro,
    eliminarRegistro,
};
