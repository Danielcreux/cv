<?php 
$path = __DIR__ . '/../includes/db_config.php';
$authPath = __DIR__ . '/../includes/auth_check.php';
?>
<?php
session_start();

// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header('Location: login.php');
    exit;
}

// Si el usuario ha iniciado sesión, continuar con el contenido de index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Builder Pro</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    
</head>
<body>
    <!-- Header -->
    <header
        id="header-placeholder">
    </header>

    <div class="container">
        <!-- Dashboard View -->
        <div class="main-content" id="dashboardView">
            <aside class="sidebar" id="sidebar-placeholder">
                
            </aside>
            
            <main>
                <h1 style="margin-bottom: 20px;">Dashboard</h1>
                
                <div class="dashboard">
                    <div class="dashboard-card">
                        <h2>Create New Resume</h2>
                        <p>Start building your professional resume with our easy-to-use editor.</p>
                        <button class="btn btn-primary" style="margin-top: 20px;" id="createResumeBtn">
                            <i class="fas fa-plus"></i> Create Resume
                        </button>
                    </div>
                    
                    <div class="dashboard-card">
                        <h2>Recent Resumes</h2>
                        <ul id="resumes-list" style="list-style: none;">
                            <li style="padding: 10px 0; border-bottom: 1px solid var(--wp-border);">
                                <div style="display: flex; justify-content: space-between;">
                                    <span>Software Engineer Resume</span>
                                    <span>Last edited: 2 days ago</span>
                                </div>
                            </li>
                            <li style="padding: 10px 0; border-bottom: 1px solid var(--wp-border);">
                                <div style="display: flex; justify-content: space-between;">
                                    <span>Product Manager Resume</span>
                                    <span>Last edited: 1 week ago</span>
                                </div>
                            </li>
                            <li style="padding: 10px 0;">
                                <div style="display: flex; justify-content: space-between;">
                                    <span>UX Designer Resume</span>
                                    <span>Last edited: 2 weeks ago</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="dashboard-card">
                        <h2>Template Gallery</h2>
                        <p>Browse our professionally designed templates to get started.</p>
                        <div style="display: flex; gap: 15px; margin-top: 20px;">
                            <div style="width: 80px; height: 100px; background-color: #e9ecef; border: 1px solid var(--wp-border);"></div>
                            <div style="width: 80px; height: 100px; background-color: #e9ecef; border: 1px solid var(--wp-border);"></div>
                            <div style="width: 80px; height: 100px; background-color: #e9ecef; border: 1px solid var(--wp-border);"></div>
                        </div>
                    </div>
                    
                    <div class="dashboard-card">
                        <h2>Account Status</h2>
                        <p>You're on the <strong>Pro Plan</strong> with unlimited resumes.</p>
                        <div style="margin-top: 20px; background-color: #e6f4ea; padding: 15px; border-radius: 4px;">
                            <p><i class="fas fa-check-circle" style="color: var(--wp-success);"></i> All features enabled</p>
                            <p><i class="fas fa-check-circle" style="color: var(--wp-success);"></i> Unlimited templates</p>
                            <p><i class="fas fa-check-circle" style="color: var(--wp-success);"></i> Priority support</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
        <!-- Resume Editor View (Initially Hidden) -->
        <div class="editor-container" id="editorView" style="display: none;">
            <aside class="editor-sidebar">
                <h2 style="margin-bottom: 20px;">Resume Details</h2>
                
                <div class="form-group">
                    <label for="resumeTitle">Resume Title</label>
                    <input type="text" id="resumeTitle" class="form-control" placeholder="e.g., Software Engineer Resume" value="Software Engineer Resume">
                </div>
                
                <div class="form-group">
                    <label>Template Selection</label>
                    <div class="templates-grid">
                        <div class="template-card selected">
                            <div class="template-preview">
                                <div style="width: 100%; height: 100%; background: linear-gradient(45deg, #2271b1, #72aee6);"></div>
                            </div>
                            <div class="template-name">Professional</div>
                        </div>
                        <div class="template-card">
                            <div class="template-preview">
                                <div style="width: 100%; height: 100%; background: linear-gradient(45deg, #d63638, #f86368);"></div>
                            </div>
                            <div class="template-name">Modern</div>
                        </div>
                        <div class="template-card">
                            <div class="template-preview">
                                <div style="width: 100%; height: 100%; background: linear-gradient(45deg, #00a32a, #5ad15f);"></div>
                            </div>
                            <div class="template-name">Creative</div>
                        </div>
                        <div class="template-card">
                            <div class="template-preview">
                                <div style="width: 100%; height: 100%; background: linear-gradient(45deg, #dba617, #f0c33c);"></div>
                            </div>
                            <div class="template-name">Executive</div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="profileImage">Profile Photo</label>
                    <input type="file" id="profileImage" class="form-control">
                    <div style="margin-top: 10px; text-align: center;">
                        <div class="profile-image" style="margin: 0 auto;">
                            <i class="fas fa-user" style="font-size: 40px; color: #aaa;"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" class="form-control" placeholder="John Doe" value="John Doe">
                </div>
                
                <div class="form-group">
                    <label for="jobTitle">Job Title</label>
                    <input type="text" id="jobTitle" class="form-control" placeholder="Software Engineer" value="Senior Software Engineer">
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="john.doe@example.com" value="john.doe@example.com">
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" class="form-control" placeholder="(123) 456-7890" value="(555) 123-4567">
                </div>
                
                <div class="form-group">
                    <label for="summary">Professional Summary</label>
                    <textarea id="summary" class="form-control">Experienced software engineer with 5+ years of expertise in developing scalable web applications. Proficient in JavaScript, React, Node.js, and cloud technologies. Passionate about creating efficient, user-friendly solutions.</textarea>
                </div>
                
               <!-- Work Experience - Corregir IDs -->
                <div class="form-group">
                    <label for="jobTitle1">Work Experience</label>
                    <input type="text" id="jobTitle1" class="form-control" placeholder="Job Title" value="Senior Software Engineer">
                    <input type="text" id="companyDate1" class="form-control" placeholder="Company & Date" value="Tech Solutions Inc. | Jan 2020 - Present">
                    <textarea id="jobDescription1" class="form-control">Lead development of customer-facing applications using React and Node.js. Improved application performance by 40% through optimization techniques.</textarea>

                    <input type="text" id="jobTitle2" class="form-control" placeholder="Job Title" value="Software Developer">
                    <input type="text" id="companyDate2" class="form-control" placeholder="Company & Date" value="Innovate Software | Mar 2018 - Dec 2019">
                    <textarea id="jobDescription2" class="form-control">Developed and maintained RESTful APIs using Express.js. Collaborated with cross-functional teams to deliver new features.</textarea>
                </div>
                
              <!-- Education - Corregir IDs -->
                <div class="form-group">
                    <label for="degree1">Education</label>
                    <input type="text" id="degree1" class="form-control" placeholder="Degree" value="Master of Computer Science">
                    <input type="text" id="institutionDate1" class="form-control" placeholder="Institution & Date" value="University of Technology | 2016 - 2018">

                    <input type="text" id="degree2" class="form-control" placeholder="Degree" value="Bachelor of Software Engineering">
                    <input type="text" id="institutionDate2" class="form-control" placeholder="Institution & Date" value="State University | 2012 - 2016">
                </div>
            
            <div class="form-group">
                <label for="skills">Skills</label>
                <textarea id="skills" class="form-control">JavaScript, React, Node.js, Express, MongoDB, AWS, Git, Agile Methodologies, RESTful APIs, Docker</textarea>
                </div>
                <div class="resume-actions">
                    <button class="btn btn-outline" id="saveDraftBtn">
                        <i class="fas fa-save"></i> Save Draft
                    </button>
                    <button class="btn btn-primary" id="downloadResumeBtn">
                        <i class="fas fa-download"></i> Download
                    </button>
                </div>
            </aside>
            
            <main class="editor-main">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2>Resume Preview</h2>
                    <div>
                        <button class="btn btn-outline">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                    </div>
                </div>
                
                <div class="resume-preview">
                    <div id="resumePreview" class="resume-template">
                        <div class="resume-header">
                            <div class="profile-info">
                                <div class="section">
                                    <h1 id="previewName">John Doe</h1>
                                    <p id="previewTitle">Senior Software Engineer</p>
                                    <div style="margin-top: 10px;">
                                        <p id="previewEmail">john.doe@example.com</p>
                                        <p id="previewPhone">(555) 123-4567</p>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-image">
                                <i class="fas fa-user" style="font-size: 40px; color: #aaa;"></i>
                            </div>
                        </div>
                        
                        <div class="resume-section">
                            <div class="section">
                                <h2>Professional Summary</h2>
                                <p id="previewSummary">Experienced software engineer with 5+ years of expertise in developing scalable web applications. Proficient in JavaScript, React, Node.js, and cloud technologies. Passionate about creating efficient, user-friendly solutions.</p>
                            </div>
                        </div>
                        
                        <div class="resume-section">
                            <div class="section">
                                <h2>Work Experience</h2>
                                <div class="resume-item">
                                    <h3 id="previewJobTitle1">Senior Software Engineer</h3>
                                    <div id="previewCompanyDate1">Tech Solutions Inc. | Jan 2020 - Present</div>
                                    <p id="previewJobDescription1" >Lead development of customer-facing applications using React and Node.js. Improved application performance by 40% through optimization techniques.</p>
                                </div>
                                <div class="resume-item">
                                    <h3 id="previewJobTitle2" >Software Developer</h3>
                                    <div id="previewCompanyDate2">Innovate Software | Mar 2018 - Dec 2019</div>
                                    <p id="previewJobDescription2">Developed and maintained RESTful APIs using Express.js. Collaborated with cross-functional teams to deliver new features.</p>
                            </div>
                            </div>
                        </div>

                        <div class="resume-section">
                            <div class="section">
                                <h2>Education</h2>
                                <div class="resume-item">
                                    <h3 id="previewDegree1">Master of Computer Science</h3>
                                    <div id="previewInstitutionDate1">University of Technology | 2016 - 2018</div>
                                </div>
                                <div class="resume-item">
                                    <h3 id="previewDegree2">Bachelor of Software Engineering</h3>
                                    <div id="previewInstitutionDate2" >State University | 2012 - 2016</div>
                                </div>
                            </div>
                        </div>
                        
                          <div class="page-break"></div>


                        <div class="resume-section">
                            <div class="section">
                                <h2>Skills</h2>
                                <p id="previewSkills">JavaScript, React, Node.js, Express, MongoDB, AWS, Git, Agile Methodologies, RESTful APIs, Docker</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
        <!-- Admin Panel View (Initially Hidden) -->
        <div class="admin-panel" id="adminView" style="display: none;">
            <div class="admin-header">
                <h1>User Management</h1>
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New User
                </button>
            </div>
            
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Resumes</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="avatar" style="width: 30px; height: 30px; font-size: 12px;">AD</div>
                                <span>Admin User</span>
                            </div>
                        </td>
                        <td>Administrator</td>
                        <td>24</td>
                        <td><span class="status-badge status-active">Active</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-icon btn-outline"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-icon btn-outline"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="avatar" style="width: 30px; height: 30px; font-size: 12px;">JD</div>
                                <span>John Doe</span>
                            </div>
                        </td>
                        <td>Editor</td>
                        <td>12</td>
                        <td><span class="status-badge status-active">Active</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-icon btn-outline"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-icon btn-outline"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="avatar" style="width: 30px; height: 30px; font-size: 12px;">SM</div>
                                <span>Sarah Miller</span>
                            </div>
                        </td>
                        <td>Editor</td>
                        <td>8</td>
                        <td><span class="status-badge status-active">Active</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-icon btn-outline"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-icon btn-outline"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="avatar" style="width: 30px; height: 30px; font-size: 12px;">RJ</div>
                                <span>Robert Johnson</span>
                            </div>
                        </td>
                        <td>Subscriber</td>
                        <td>3</td>
                        <td><span class="status-badge status-inactive">Inactive</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-icon btn-outline"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-icon btn-outline"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="js/main.js"></script>
   


</body>
</html>