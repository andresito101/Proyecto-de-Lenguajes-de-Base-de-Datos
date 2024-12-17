const oracledb = require('oracledb');
const reservacionesCliente = require('../models/reservacionesCliente');

// Obtener todas las reservaciones
async function obtenerReservaciones(req, res) {
    try {
        const reservaciones = await reservacionesModel.getAllReservaciones();
        res.json(reservaciones);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Crear una nueva reservación
async function crearReservacion(req, res) {
    const { ID_Cliente, Fecha, Estado } = req.body;
    try {
        const nuevaReservacion = { ID_Cliente, Fecha, Estado };
        await reservacionesModel.createReservacion(nuevaReservacion);
        res.status(201).json({ message: 'Reservación creada exitosamente' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Editar una reservación existente
async function editarReservacion(req, res) {
    const { ID_Reservacion, ID_Cliente, Fecha, Estado } = req.body;
    try {
        const reservacionActualizada = { ID_Reservacion, ID_Cliente, Fecha, Estado };
        await reservacionesModel.updateReservacion(reservacionActualizada);
        res.status(200).json({ message: 'Reservación actualizada exitosamente' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

// Eliminar una reservación
async function eliminarReservacion(req, res) {
    const { ID_Reservacion } = req.params;
    try {
        await reservacionesModel.deleteReservacion(ID_Reservacion);
        res.status(200).json({ message: 'Reservación eliminada exitosamente' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

module.exports = {
    obtenerReservaciones,
    crearReservacion,
    editarReservacion,
    eliminarReservacion
};
