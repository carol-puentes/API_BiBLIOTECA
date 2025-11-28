<p align="center">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/build-passing-brightgreen" alt="Build"></a>
<a href="#"><img src="https://img.shields.io/badge/tests-PHPUnit-blue" alt="Tests"></a>
<a href="#"><img src="https://img.shields.io/badge/status-completed-success" alt="Status"></a>
<a href="#"><img src="https://img.shields.io/badge/license-MIT-lightgrey" alt="License"></a>
</p>

# 📚 API de Gestión de Préstamos — Prueba Técnica

Este proyecto corresponde a la implementación de una API desarrollada en **PHP con Laravel**, cuyo objetivo es gestionar el proceso de préstamo de libros.  
El sistema aplica reglas de negocio específicas dependiendo del tipo de usuario, calcula fechas de devolución excluyendo fines de semana y utiliza una **base de datos en memoria**, siguiendo una arquitectura organizada con separación de responsabilidades (Controllers, Services y Repositories).

Incluye además una pequeña interfaz web para consultar los préstamos registrados.

---

## 🚀 Funcionalidades principales

- ✔ Crear préstamos con validación de reglas de negocio  
- ✔ Usuarios tipo 3 (invitado) solo pueden tener **un préstamo activo**  
- ✔ Cálculo automático de la fecha máxima de devolución  
- ✔ Almacenamiento en memoria mediante un array estático  
- ✔ Consultar préstamo por ID  
- ✔ Listar todos los préstamos  
- ✔ Pruebas unitarias con PHPUnit  

---

## 🔌 Endpoints principales

### **POST /api/prestamo**
Crear un nuevo préstamo.

### **GET /api/prestamo/{id}**
Obtener un préstamo por su ID.

### **GET /api/prestamos**
Listar todos los préstamos existentes.

---

## ▶️ Instrucciones de ejecución

1. Clonar el repositorio:
```bash
git clone <URL_DEL_REPOSITORIO>
