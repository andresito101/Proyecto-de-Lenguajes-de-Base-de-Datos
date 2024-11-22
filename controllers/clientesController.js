const oracledb = require('oracledb');
const clientesModel = require('../models/clientes');



// Crear un cliente
exports.createCliente = async (req, res) => {
  try {
    const newCliente = await Cliente.create(req.body); // Usa el modelo para insertar en la base de datos
    res.status(201).json(newCliente);
  } catch (error) {
    res.status(500).json({ error: 'Error al crear el cliente' });
  }
};

// Leer todos los clientes
exports.getClientes = async (req, res) => {
  try {
    const clientes = await Cliente.findAll(); // Usa el modelo para obtener datos
    res.status(200).json(clientes);
  } catch (error) {
    res.status(500).json({ error: 'Error al obtener los clientes' });
  }
};

// Leer un cliente por ID
exports.getClienteById = async (req, res) => {
  try {
    const cliente = await Cliente.findById(req.params.id); // Busca por ID en la base de datos
    if (!cliente) return res.status(404).json({ error: 'Cliente no encontrado' });
    res.status(200).json(cliente);
  } catch (error) {
    res.status(500).json({ error: 'Error al obtener el cliente' });
  }
};

// Actualizar un cliente
exports.updateCliente = async (req, res) => {
  try {
    const updatedCliente = await Cliente.update(req.params.id, req.body); // Actualiza en la base de datos
    res.status(200).json(updatedCliente);
  } catch (error) {
    res.status(500).json({ error: 'Error al actualizar el cliente' });
  }
};

// Eliminar un cliente
exports.deleteCliente = async (req, res) => {
  try {
    await Cliente.delete(req.params.id); // Elimina por ID
    res.status(204).send();
  } catch (error) {
    res.status(500).json({ error: 'Error al eliminar el cliente' });
  }
};
