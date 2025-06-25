<?php
require_once __DIR__ . '/../includes/auth_check.php';

$pageTitle = "Configuración";

?>

<div class="content-header">
    <h2>Configuración</h2>
    <p>Personaliza tu experiencia en la plataforma</p>
</div>

<div class="settings-container">
    <div class="settings-tabs">
        <button class="tab-btn active" data-tab="account">Cuenta</button>
        <button class="tab-btn" data-tab="privacy">Privacidad</button>
        <button class="tab-btn" data-tab="notifications">Notificaciones</button>
        <button class="tab-btn" data-tab="preferences">Preferencias</button>
        <button class="tab-btn" data-tab="billing">Facturación</button>
    </div>
    
    <div class="settings-content">
        <div id="account" class="tab-content active">
            <h3>Configuración de Cuenta</h3>
            <div class="setting-item">
                <div class="setting-info">
                    <h4>Eliminar cuenta</h4>
                    <p>Eliminar permanentemente tu cuenta y todos los datos asociados</p>
                </div>
                <button class="btn-delete-account">Eliminar Cuenta</button>
            </div>
            
            <div class="setting-item">
                <div class="setting-info">
                    <h4>Exportar datos</h4>
                    <p>Descargar todos tus datos en formato ZIP</p>
                </div>
                <button class="btn-export">Exportar Datos</button>
            </div>
        </div>
        
        <div id="privacy" class="tab-content">
            <h3>Configuración de Privacidad</h3>
            <div class="setting-item">
                <div class="setting-info">
                    <h4>Perfil público</h4>
                    <p>Permitir que otros usuarios vean tu perfil</p>
                </div>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="setting-item">
                <div class="setting-info">
                    <h4>Mostrar actividad</h4>
                    <p>Compartir tus actividades recientes</p>
                </div>
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
        
        <div id="notifications" class="tab-content">
            <h3>Configuración de Notificaciones</h3>
            <div class="setting-item">
                <div class="setting-info">
                    <h4>Notificaciones por correo</h4>
                    <p>Recibir notificaciones importantes por correo electrónico</p>
                </div>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="setting-item">
                <div class="setting-info">
                    <h4>Recordatorios</h4>
                    <p>Recibir recordatorios para actualizar tu currículum</p>
                </div>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
            </div>
        </div>
        
        <div id="preferences" class="tab-content">
            <h3>Preferencias de Usuario</h3>
            <div class="form-group">
                <label for="language">Idioma</label>
                <select id="language">
                    <option value="es">Español</option>
                    <option value="en">English</option>
                    <option value="fr">Français</option>
                    <option value="de">Deutsch</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="theme">Tema</label>
                <select id="theme">
                    <option value="light">Claro</option>
                    <option value="dark">Oscuro</option>
                    <option value="system">Sistema</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="density">Densidad de contenido</label>
                <select id="density">
                    <option value="compact">Compacto</option>
                    <option value="normal" selected>Normal</option>
                    <option value="comfortable">Cómodo</option>
                </select>
            </div>
        </div>
        
        <div id="billing" class="tab-content">
            <h3>Facturación y Suscripción</h3>
            <div class="subscription-card">
                <div class="subscription-info">
                    <h4>Plan Actual: Gratuito</h4>
                    <p>Acceso limitado a plantillas y funciones</p>
                    <ul>
                        <li><i class="fas fa-check"></i> 2 currículums activos</li>
                        <li><i class="fas fa-check"></i> Plantillas básicas</li>
                        <li><i class="fas fa-times"></i> Exportación PDF ilimitada</li>
                        <li><i class="fas fa-times"></i> Plantillas premium</li>
                    </ul>
                </div>
                <div class="subscription-actions">
                    <h4>Actualiza a Premium</h4>
                    <p class="price">$9.99<span>/mes</span></p>
                    <button class="btn-upgrade">Actualizar Plan</button>
                </div>
            </div>
        </div>
    </div>
</div>