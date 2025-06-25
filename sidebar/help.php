<?php
require_once __DIR__ . '/../includes/auth_check.php';


$pageTitle = "Ayuda y Soporte";

?>

<div class="content-header">
    <h2>Ayuda y Soporte</h2>
    <p>Encuentra respuestas y soporte para tu cuenta</p>
</div>

<div class="help-container">
    <div class="help-search">
        <input type="text" placeholder="Buscar en preguntas frecuentes...">
        <button><i class="fas fa-search"></i></button>
    </div>
    
    <div class="help-sections">
        <div class="help-cards">
            <div class="help-card">
                <i class="fas fa-book"></i>
                <h3>Centro de Ayuda</h3>
                <p>Documentación completa y guías paso a paso</p>
                <a href="#" class="btn-help">Ver Artículos</a>
            </div>
            
            <div class="help-card">
                <i class="fas fa-comments"></i>
                <h3>Preguntas Frecuentes</h3>
                <p>Respuestas a las preguntas más comunes</p>
                <a href="#" class="btn-help">Ver Preguntas</a>
            </div>
            
            <div class="help-card">
                <i class="fas fa-headset"></i>
                <h3>Soporte en Vivo</h3>
                <p>Chatea con nuestro equipo de soporte</p>
                <a href="#" class="btn-help">Iniciar Chat</a>
            </div>
        </div>
    </div>
    
    <div class="faq-section">
        <h3>Preguntas Frecuentes</h3>
        
        <div class="faq-item">
            <div class="faq-question">
                <h4>¿Cómo puedo descargar mi currículum en PDF?</h4>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Para descargar tu currículum en formato PDF:</p>
                <ol>
                    <li>Accede a "Mis Currículums"</li>
                    <li>Selecciona el currículum que deseas descargar</li>
                    <li>Haz clic en el botón "Descargar"</li>
                    <li>Selecciona el formato PDF</li>
                    <li>Tu currículum se generará y descargará automáticamente</li>
                </ol>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                <h4>¿Puedo cambiar de plantilla después de crear mi currículum?</h4>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Sí, puedes cambiar la plantilla en cualquier momento:</p>
                <ol>
                    <li>Accede a "Mis Currículums"</li>
                    <li>Selecciona el currículum que deseas modificar</li>
                    <li>Haz clic en "Editar"</li>
                    <li>En la barra lateral, selecciona "Cambiar plantilla"</li>
                    <li>Elige la nueva plantilla que prefieras</li>
                    <li>Guarda los cambios</li>
                </ol>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                <h4>¿Cómo actualizo mi plan a Premium?</h4>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Para actualizar a Premium:</p>
                <ol>
                    <li>Accede a "Configuración"</li>
                    <li>Selecciona la pestaña "Facturación"</li>
                    <li>Haz clic en "Actualizar Plan"</li>
                    <li>Selecciona el plan Premium</li>
                    <li>Completa los detalles de pago</li>
                    <li>Confirma la actualización</li>
                </ol>
                <p>Tu cuenta se actualizará inmediatamente con todas las funciones Premium.</p>
            </div>
        </div>
    </div>
    
    <div class="contact-support">
        <h3>¿No encuentras lo que buscas?</h3>
        <p>Contacta a nuestro equipo de soporte para obtener ayuda personalizada</p>
        <div class="contact-options">
            <a href="#" class="contact-option">
                <i class="fas fa-envelope"></i>
                <span>Enviar Email</span>
            </a>
            <a href="#" class="contact-option">
                <i class="fas fa-comment-dots"></i>
                <span>Chat en Vivo</span>
            </a>
            <a href="#" class="contact-option">
                <i class="fas fa-phone"></i>
                <span>Llamar por Teléfono</span>
            </a>
        </div>
    </div>
</div>
