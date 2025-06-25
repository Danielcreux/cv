// Funciones de vista (globales)
function showView(activeView) {
    document.getElementById('dashboardView').style.display = 'none';
    document.getElementById('editorView').style.display = 'none';
    document.getElementById('adminView').style.display = 'none';
    
    if (activeView === 'dashboard') 
        document.getElementById('dashboardView').style.display = 'grid';
    if (activeView === 'editor') 
        document.getElementById('editorView').style.display = 'grid';
    if (activeView === 'admin') 
        document.getElementById('adminView').style.display = 'block';
}

// Funciones de acceso directo
function showDashboard() { showView('dashboard'); }
function showEditor() { showView('editor'); }
function showAdminPanel() { showView('admin'); }

// Download functionality
function downloadResume() {
    const { jsPDF } = window.jspdf;
    
    // Configuración para impresión profesional
    const doc = new jsPDF({
        orientation: 'portrait',
        unit: 'mm',  // Usar milímetros para mejor compatibilidad
        format: 'a4',
        compress: true,
        hotfixes: ["px_scaling"]
    });

    const resumePreview = document.getElementById('resumePreview');
    const clone = resumePreview.cloneNode(true);
    
    // 1. Dimensiones para área segura de impresión (márgenes estándar)
    const safeAreaWidth = 190; // mm (márgenes: 10mm izquierda + 10mm derecha)
    const safeAreaHeight = 277; // mm (márgenes: 15mm arriba + 15mm abajo)
    
    // Convertir a píxeles (1mm ≈ 3.78px)
    const safeWidthPx = safeAreaWidth * 3.78;
    const safeHeightPx = safeAreaHeight * 3.78;
    
    // 2. Aplicar estilos específicos para impresión segura
    clone.style.width = `${safeWidthPx}px`;
    clone.style.padding = '40px';
    clone.style.boxSizing = 'border-box';
    clone.style.position = 'absolute';
    clone.style.left = '-9999px';
    clone.style.fontSize = '16px';
    clone.style.backgroundColor = '#FFFFFF';
    
    // 3. Optimizar elementos para impresión
    clone.querySelectorAll('*').forEach(el => {
        el.style.boxShadow = 'none !important';
        el.style.color = '#000000 !important';
        el.style.backgroundColor = 'transparent !important';
        el.style.border = 'none !important';
        el.style.outline = 'none !important';
    });
    
    document.body.appendChild(clone);

    // 4. Eliminar elementos interactivos
    clone.querySelectorAll('[contenteditable="true"]').forEach(el => {
        el.removeAttribute('contenteditable');
    });
    
    clone.querySelectorAll('button, .no-print').forEach(el => el.remove());

    // 5. Generar imagen con área segura
    html2canvas(clone, {
        scale: 2,
        useCORS: true,
        dpi: 300,
        logging: false,
        backgroundColor: '#FFFFFF',
        ignoreElements: function(element) {
            return element.classList.contains('no-print');
        }
    }).then(canvas => {
        // 6. Ajustar dimensiones para área segura
        const imgWidth = safeAreaWidth;
        const imgHeight = (canvas.height * imgWidth) / canvas.width;
        const imgData = canvas.toDataURL('image/png', 1.0);
        
        const pageWidth = doc.internal.pageSize.getWidth();
        const pageHeight = doc.internal.pageSize.getHeight();
        
        // 7. Calcular número de páginas
        const totalPages = Math.ceil(imgHeight / safeAreaHeight);
        
        // 8. Centrar contenido en el área segura
        const horizontalMargin = (pageWidth - safeAreaWidth) / 2;
        const verticalMargin = (pageHeight - safeAreaHeight) / 2;
        
        let currentHeight = 0;
        
        for (let i = 0; i < totalPages; i++) {
            if (i > 0) doc.addPage();
            
            // Calcular altura para esta página
            const pageContentHeight = Math.min(safeAreaHeight, imgHeight - currentHeight);
            
            // Agregar imagen con posición ajustada
            doc.addImage(
                imgData, 
                'PNG', 
                horizontalMargin, 
                verticalMargin - currentHeight, 
                imgWidth, 
                imgHeight
            );
            
            currentHeight += safeAreaHeight;
        }
        
        // 9. Agregar marcas de corte para impresión profesional
        doc.setProperties({
            title: 'Curriculum Vitae',
            creator: 'Generador de CV Profesional'
        });
        
        // 10. Guardar con nombre profesional
        doc.save('Curriculum_Vitae.pdf');
        document.body.removeChild(clone);
    }).catch(error => {
        console.error('Error al generar PDF:', error);
        document.body.removeChild(clone);
    });
}
// ====================
// 4. Template Selection
// ====================
function initTemplateSelection() {
    document.querySelectorAll('.template-card').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelectorAll('.template-card').forEach(c => 
                c.classList.remove('selected')
            );
            card.classList.add('selected');
        });
    });
}

// ====================
// 5. Resume Operations
// ====================
function getResumeData() {
    return {
        title: document.getElementById('previewName').textContent,
        content: {
            name: document.getElementById('previewName').textContent,
            jobTitle: document.getElementById('previewTitle').textContent,
            email: document.getElementById('previewEmail').textContent,
            phone: document.getElementById('previewPhone').textContent,
            summary: document.getElementById('previewSummary').textContent,
            workExperiences: [
                {
                    jobTitle: document.getElementById('previewJobTitle1').textContent,
                    companyDate: document.getElementById('previewCompanyDate1').textContent,
                    description: document.getElementById('previewJobDescription1').textContent
                },
                {
                    jobTitle: document.getElementById('previewJobTitle2').textContent,
                    companyDate: document.getElementById('previewCompanyDate2').textContent,
                    description: document.getElementById('previewJobDescription2').textContent
                }
            ],
            educations: [
                {
                    degree: document.getElementById('previewDegree1').textContent,
                    institutionDate: document.getElementById('previewInstitutionDate1').textContent
                },
                {
                    degree: document.getElementById('previewDegree2').textContent,
                    institutionDate: document.getElementById('previewInstitutionDate2').textContent
                }
            ],
            skills: document.getElementById('previewSkills').textContent
        }
    };
}

async function saveResume() {
  const resumeData = getResumeData(); // Your data collection function

  try {
    const response = await fetch('includes/save_resume.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(resumeData)
    });

    // Handle non-2xx responses
    if (!response.ok) throw new Error(`Server error: ${response.status}`);

    const result = await response.json(); // Parse ONCE
    console.log("Saved with ID:", result.id);
    
  } catch (error) {
    console.error("Save failed:", error);
  }
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('createResumeBtn')?.addEventListener('click', showEditor);
    
   // También para otros botones si es necesario
    document.getElementById('dashboardNav')?.addEventListener('click', showDashboard);
    document.getElementById('adminNav')?.addEventListener('click', showAdminPanel);
    document.getElementById('saveDraftBtn')?.addEventListener('click', saveResume);
    document.getElementById('downloadResumeBtn')?.addEventListener('click', downloadResume);

    
    // ====================
    // 1. Profile Image Handling
    // ====================
    function handleProfileImage(e) {
        const file = e.target.files[0];
        if (!file) return;
        
        const reader = new FileReader();
        reader.onload = (event) => {
            document.querySelectorAll('.profile-image').forEach(el => {
                el.innerHTML = `
                    <img src="${event.target.result}" 
                         alt="Profile" 
                         style="width:100%;height:100%;object-fit:cover;">
                `;
            });
        };
        reader.readAsDataURL(file);
    }

    // ====================
    // 2. View Management
    // ====================
    const views = {
        dashboard: document.getElementById('dashboardView'),
        editor: document.getElementById('editorView'),
        admin: document.getElementById('adminView')
    };

// View management

 function showEditor() {
    document.getElementById('dashboardView').style.display = 'none';
    document.getElementById('editorView').style.display = 'grid';
    document.getElementById('adminView').style.display = 'none';
}

function showDashboard() {
    document.getElementById('dashboardView').style.display = 'grid';
    document.getElementById('editorView').style.display = 'none';
    document.getElementById('adminView').style.display = 'none';
}

function showAdminPanel() {
    document.getElementById('dashboardView').style.display = 'none';
    document.getElementById('editorView').style.display = 'none';
    document.getElementById('adminView').style.display = 'block';
}
    
// ====================
// 3. Preview Management
// ====================
const formFields = [
    'resumeTitle', 'fullName', 'jobTitle', 'email', 'phone', 'summary',
    'jobTitle1', 'companyDate1', 'jobDescription1',
    'jobTitle2', 'companyDate2', 'jobDescription2',
    'degree1', 'institutionDate1', 'degree2', 'institutionDate2', 'skills'
];


function updateElement(previewId, inputId, defaultValue = '') {
    const inputEl = document.getElementById(inputId);
    const previewEl = document.getElementById(previewId);

    if (inputEl && previewEl) {
        previewEl.textContent = inputEl.value.trim() || defaultValue;
    }
}

// Función mejorada que verifica si los elementos existen
function updatePreview() {
        // Personal Information
        updateElement('previewName', 'fullName', 'John Doe');
        updateElement('previewTitle', 'jobTitle', 'Senior Software Engineer');
        updateElement('previewEmail', 'email', 'john.doe@example.com');
        updateElement('previewPhone', 'phone', '(555) 123-4567');
        updateElement('previewSummary', 'summary', 'Experienced software engineer...');
        
        // Work Experience
        updateElement('previewJobTitle1', 'jobTitle1', 'Senior Software Engineer');
        updateElement('previewCompanyDate1', 'companyDate1', 'Tech Solutions Inc. | Jan 2020 - Present');
        updateElement('previewJobDescription1', 'jobDescription1', 'Lead development...');
        
        updateElement('previewJobTitle2', 'jobTitle2', 'Software Developer');
        updateElement('previewCompanyDate2', 'companyDate2', 'Innovate Software | Mar 2018 - Dec 2019');
        updateElement('previewJobDescription2', 'jobDescription2', 'Developed and maintained...');
        
        // Education
        updateElement('previewDegree1', 'degree1', 'Master of Computer Science');
        updateElement('previewInstitutionDate1', 'institutionDate1', 'University of Technology | 2016 - 2018');
        updateElement('previewDegree2', 'degree2', 'Bachelor of Software Engineering');
        updateElement('previewInstitutionDate2', 'institutionDate2', 'State University | 2012 - 2016');
        
        // Skills
        updateElement('previewSkills', 'skills', 'JavaScript, React, Node.js...');
    }






function formatTimeAgo(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const seconds = Math.floor((now - date) / 1000);

    if (seconds < 60) return 'Just now';
    if (seconds < 3600) return `${Math.floor(seconds/60)} min ago`;
    if (seconds < 86400) return `${Math.floor(seconds/3600)} hours ago`;

    const days = Math.floor(seconds/86400);
    return days === 1 ? 'Yesterday' : `${days} days ago`;
}

async function loadResumes() {
    try {
        const response = await fetch('includes/get_resumes.php');
        const resumes = await response.json();
        const container = document.getElementById('resumes-list');

        container.innerHTML = '';
        resumes.forEach(resume => {
            const li = document.createElement('li');
            li.className = 'resume-item';

            li.innerHTML = `
                <div class="resume-header">
                    <span>${resume.title}</span>
                    <span>Last edited: ${formatTimeAgo(resume.created_at)}</span>
                </div>
            `;

            li.addEventListener('click', () => loadResumeData(resume.id));
            container.appendChild(li);
        });
    } catch (error) {
        console.error('Failed to load resumes:', error);
    }
}

// ====================
    // 7. Initialization
    // ====================
    function initEventListeners() {
        // Profile image
        document.getElementById('profileImage')?.addEventListener('change', handleProfileImage);
        
        // Form fields
        formFields.forEach(field => {
            const el = document.getElementById(field);
            el?.addEventListener('input', updatePreview);
        });
        
        // Buttons
        document.querySelector('.btn-outline')?.addEventListener('click', saveResume);
        document.getElementById('downloadBtn')?.addEventListener('click', downloadResume);
        
        // Navigation
        document.getElementById('editorNav')?.addEventListener('click', () => showView('editor'));
        document.getElementById('dashboardNav')?.addEventListener('click', () => showView('dashboard'));
        document.getElementById('adminNav')?.addEventListener('click', () => showView('admin'));
    }

    function initApp() {
        // Load initial view
        showView('dashboard');
        
        // Initialize components
        initTemplateSelection();
        initEventListeners();
        updatePreview();
        loadResumes();
        
        // Load templates
        loadTemplate('templates/header.php', 'header-placeholder');
        loadTemplate('templates/sidebar.php', 'sidebar-placeholder');
    }

    initApp();
});

// External template loader (keep as is)
function loadTemplate(url, elementId) {
    fetch(url)
        .then(response => response.text())
        .then(html => {
            document.getElementById(elementId).innerHTML = html;
        })
        .catch(console.error);
}