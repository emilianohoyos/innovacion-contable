# Docker Setup for Innovación Contable

Este proyecto incluye configuración completa de Docker para ejecutar tanto el frontend (React) como el backend (Laravel) con base de datos MySQL.

## Estructura de Archivos Docker

```
template/
├── Dockerfile                    # Imagen del frontend React
├── docker-compose.yml           # Orquestación completa
├── nginx.conf                   # Configuración Nginx para frontend
├── .dockerignore                # Archivos excluidos del build
└── docker/
    ├── nginx/
    │   └── backend.conf         # Configuración Nginx para Laravel
    ├── php/
    │   └── php.ini              # Configuración PHP
    └── mysql/
        └── init.sql             # Script inicial de base de datos
```

## Servicios Incluidos

- **Frontend**: React app servida con Nginx (Puerto 3000)
- **Backend**: Laravel con PHP-FPM (Puerto 8000)
- **Database**: MySQL 8.0 (Puerto 3306)
- **Redis**: Cache opcional (Puerto 6379)

## Comandos de Uso

### Construcción y Ejecución

```bash
# Construir y ejecutar todos los servicios
docker-compose up --build

# Ejecutar en segundo plano
docker-compose up -d

# Ver logs
docker-compose logs -f

# Parar servicios
docker-compose down
```

### Comandos Individuales

```bash
# Solo frontend
docker-compose up frontend

# Solo backend y base de datos
docker-compose up backend database nginx

# Reconstruir un servicio específico
docker-compose up --build frontend
```

### Gestión de Base de Datos

```bash
# Acceder a MySQL
docker-compose exec database mysql -u innovacion_user -p innovacion_contable

# Ejecutar migraciones de Laravel
docker-compose exec backend php artisan migrate

# Ejecutar seeders
docker-compose exec backend php artisan db:seed
```

## Variables de Entorno

### Base de Datos
- **Database**: innovacion_contable
- **User**: innovacion_user
- **Password**: innovacion_password
- **Root Password**: root_password

### URLs de Acceso
- **Frontend**: http://localhost:3000
- **Backend API**: http://localhost:8000
- **Database**: localhost:3306

## Configuración de Desarrollo

Para desarrollo, puedes montar volúmenes para hot-reload:

```yaml
# Agregar a docker-compose.yml en el servicio frontend
volumes:
  - .:/app
  - /app/node_modules
```

## Producción

El Dockerfile usa multi-stage build optimizado para producción:
1. **Stage 1**: Instala dependencias y construye la aplicación
2. **Stage 2**: Sirve archivos estáticos con Nginx

## Troubleshooting

### Problemas Comunes

1. **Puerto ocupado**: Cambiar puertos en docker-compose.yml
2. **Permisos**: Ejecutar con `sudo` si es necesario
3. **Cache**: Usar `docker-compose build --no-cache`

### Logs Útiles

```bash
# Ver logs de un servicio específico
docker-compose logs frontend
docker-compose logs backend
docker-compose logs database

# Seguir logs en tiempo real
docker-compose logs -f frontend
```

## Limpieza

```bash
# Parar y eliminar contenedores
docker-compose down

# Eliminar volúmenes también
docker-compose down -v

# Limpiar imágenes no utilizadas
docker system prune
```
