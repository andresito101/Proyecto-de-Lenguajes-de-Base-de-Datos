const oracledb = require('oracledb');
const checkinCheckout = require('../models/checkinCheckout');


// Crear un registro de check-in/check-out
exports.createRecord = async (req, res) => {
  try {
    const newRecord = await CheckinCheckout.create(req.body);
    res.status(201).json(newRecord);
  } catch (error) {
    res.status(500).json({ error: 'Error al crear el registro' });
  }
};

// Leer todos los registros
exports.getRecords = async (req, res) => {
  try {
    const records = await CheckinCheckout.findAll();
    res.status(200).json(records);
  } catch (error) {
    res.status(500).json({ error: 'Error al obtener los registros' });
  }
};

// Leer un registro específico por ID
exports.getRecordById = async (req, res) => {
  try {
    const record = await CheckinCheckout.findById(req.params.id);
    if (!record) return res.status(404).json({ error: 'Registro no encontrado' });
    res.status(200).json(record);
  } catch (error) {
    res.status(500).json({ error: 'Error al obtener el registro' });
  }
};

// Actualizar un registro
exports.updateRecord = async (req, res) => {
  try {
    const updatedRecord = await CheckinCheckout.update(req.params.id, req.body);
    res.status(200).json(updatedRecord);
  } catch (error) {
    res.status(500).json({ error: 'Error al actualizar el registro' });
  }
};

// Eliminar un registro
exports.deleteRecord = async (req, res) => {
  try {
    await CheckinCheckout.delete(req.params.id);
    res.status(204).send();
  } catch (error) {
    res.status(500).json({ error: 'Error al eliminar el registro' });
  }
};
