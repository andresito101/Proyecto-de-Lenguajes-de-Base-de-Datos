
const oracledb = require('oracledb');
const opinion = require('../models/opinion');


const Opinion = {
    // Crear una nueva opinión
    create: async (data) => {
        const sql = `INSERT INTO Opiniones (Fecha_Opinion, Calificacion, Comentarios, ID_Cliente) VALUES (:Fecha_Opinion, :Calificacion, :Comentarios, :ID_Cliente)`;
        const binds = {
            Fecha_Opinion: data.Fecha_Opinion,
            Calificacion: data.Calificacion,
            Comentarios: data.Comentarios,
            ID_Cliente: data.ID_Cliente
        };
        const options = { autoCommit: true };
        const result = await connection.execute(sql, binds, options);
        return result;
    },

    // Obtener todas las opiniones
    findAll: async () => {
        const sql = `SELECT * FROM Opiniones`;
        const result = await connection.execute(sql);
        return result.rows;
    },

    // Obtener una opinión por ID
    findById: async (id) => {
        const sql = `SELECT * FROM Opiniones WHERE ID_Opinion = :id`;
        const binds = { id };
        const result = await connection.execute(sql, binds);
        return result.rows[0];
    },

    // Actualizar una opinión
    update: async (id, data) => {
        const sql = `UPDATE Opiniones SET Fecha_Opinion = :Fecha_Opinion, Calificacion = :Calificacion, Comentarios = :Comentarios, ID_Cliente = :ID_Cliente WHERE ID_Opinion = :id`;
        const binds = {
            Fecha_Opinion: data.Fecha_Opinion,
            Calificacion: data.Calificacion,
            Comentarios: data.Comentarios,
            ID_Cliente: data.ID_Cliente,
            id
        };
        const options = { autoCommit: true };
        const result = await connection.execute(sql, binds, options);
        return result;
    },

    // Eliminar una opinión
    delete: async (id) => {
        const sql = `DELETE FROM Opiniones WHERE ID_Opinion = :id`;
        const binds = { id };
        const options = { autoCommit: true };
        const result = await connection.execute(sql, binds, options);
        return result;
    }
};

module.exports = Opinion;

// Controlador: opinionController.js
const Opinion = require('../models/opinionModel');

// Crear una opinión
exports.createOpinion = async (req, res) => {
    try {
        const newOpinion = await Opinion.create(req.body);
        res.status(201).json({ message: 'Opinión creada exitosamente', newOpinion });
    } catch (error) {
        res.status(500).json({ error: 'Error al crear la opinión' });
    }
};

// Obtener todas las opiniones
exports.getOpinions = async (req, res) => {
    try {
        const opinions = await Opinion.findAll();
        res.status(200).json(opinions);
    } catch (error) {
        res.status(500).json({ error: 'Error al obtener las opiniones' });
    }
};

// Obtener una opinión por ID
exports.getOpinionById = async (req, res) => {
    try {
        const opinion = await Opinion.findById(req.params.id);
        if (!opinion) return res.status(404).json({ error: 'Opinión no encontrada' });
        res.status(200).json(opinion);
    } catch (error) {
        res.status(500).json({ error: 'Error al obtener la opinión' });
    }
};

// Actualizar una opinión
exports.updateOpinion = async (req, res) => {
    try {
        const updatedOpinion = await Opinion.update(req.params.id, req.body);
        res.status(200).json({ message: 'Opinión actualizada exitosamente', updatedOpinion });
    } catch (error) {
        res.status(500).json({ error: 'Error al actualizar la opinión' });
    }
};

// Eliminar una opinión
exports.deleteOpinion = async (req, res) => {
    try {
        await Opinion.delete(req.params.id);
        res.status(204).send();
    } catch (error) {
        res.status(500).json({ error: 'Error al eliminar la opinión' });
    }
};
