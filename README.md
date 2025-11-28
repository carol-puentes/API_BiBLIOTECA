

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
git clone https://github.com/carol-puentes/API_BiBLIOTECA.git
```

2. Instalar dependencias:
```bash
composer install
```
3. Crear el archivo de entorno:
```bash
cp .env.example .env
```
4.Generar la clave de Laravel:
```bash
php artisan key:generate
```
5. Ejecutar el servidor: 
```bash
php artisan serve
```

La API estará disponible en:
```bash
http://127.0.0.1:8000/

```

## 🧪 Pruebas unitarias
Para ejecutar las pruebas del proyecto:
```bash
php artisan test
```

