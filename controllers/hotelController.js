const express = require('express');
const clientesModel = require('../models/hotel');

// Obtener todos los hoteles
router.get('/hoteles', async (req, res) => {
    try {
        const hoteles = await hotelModel.getAllHoteles();
        res.json(hoteles);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// Obtener un hotel por ID
router.get('/hoteles/:id', async (req, res) => {
    try {
        const hotel = await hotelModel.getHotelById(req.params.id);
        res.json(hotel);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// Crear un nuevo hotel
router.post('/hoteles', async (req, res) => {
    try {
        const result = await hotelModel.createHotel(req.body);
        res.json({ message: 'Hotel creado exitosamente', result });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// Actualizar un hotel
router.put('/hoteles/:id', async (req, res) => {
    try {
        const result = await hotelModel.updateHotel(req.params.id, req.body);
        res.json({ message: 'Hotel actualizado exitosamente', result });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// Eliminar un hotel
router.delete('/hoteles/:id', async (req, res) => {
    try {
        const result = await hotelModel.deleteHotel(req.params.id);
        res.json({ message: 'Hotel eliminado exitosamente', result });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

module.exports = router;
