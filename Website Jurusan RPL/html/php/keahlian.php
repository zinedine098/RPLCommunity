<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills of a Professional Programmer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .process-step {
            transition: all 0.3s ease;
        }
        .process-step.active .step-content {
            display: block;
        }
        .process-step.active .step-icon i {
            transform: rotate(180deg);
        }
    </style>
</head>
<body class="font-sans bg-gray-50">

    <!-- Header/Navbar -->
    <header class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="beranda.html" class="text-2xl font-bold text-indigo-600">RPL<span class="text-gray-800">Community</span></a>
            
            <ul class="hidden md:flex space-x-8" id="navMenu">
                <li><a href="beranda.html" class="text-gray-600 hover:text-indigo-600 flex items-center"><i class="fas fa-home mr-2"></i> Beranda</a></li>
                <li><a href="tentang.html" class="text-gray-600 hover:text-indigo-600 flex items-center"><i class="fas fa-info-circle mr-2"></i> Tentang</a></li>
                <li><a href="keahlian.html" class="text-indigo-600 flex items-center"><i class="fas fa-tools mr-2"></i> Keahlian</a></li>
                <li><a href="portofolio.html" class="text-gray-600 hover:text-indigo-600 flex items-center"><i class="fas fa-briefcase mr-2"></i> Portofolio</a></li>
                <li><a href="tim.html" class="text-gray-600 hover:text-indigo-600 flex items-center"><i class="fas fa-users mr-2"></i> Tim</a></li>
                <li><a href="#contact" class="text-gray-600 hover:text-indigo-600 flex items-center"><i class="fas fa-envelope mr-2"></i> Kontak</a></li>
            </ul>
            
            <div class="md:hidden cursor-pointer" id="hamburger">
                <span class="block w-6 h-0.5 bg-indigo-600 mb-1.5 transition-transform duration-300"></span>
                <span class="block w-6 h-0.5 bg-indigo-600 mb-1.5 transition-opacity duration-300"></span>
                <span class="block w-6 h-0.5 bg-indigo-600 transition-transform duration-300"></span>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero bg-gradient-to-r from-indigo-500 to-purple-600 text-white pt-32 pb-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Keahlian Profesional Kami</h1>
            <p class="text-xl max-w-2xl mx-auto">Kami menyediakan solusi bisnis terbaik dengan teknologi terkini dan tim ahli yang berpengalaman.</p>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Core Programming Skills</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="skillsContainer">
                <!-- Skills will be loaded from database here -->
                <?php
                // Koneksi ke database
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'db_toko';
                
                $conn = new mysqli($host, $username, $password, $database);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // Query untuk mengambil data keahlian
                $sql = "SELECT * FROM keterampilan_rpl";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '
                        <div class="bg-gray-50 rounded-xl p-8 border border-gray-200 hover:shadow-lg transition duration-300">
                            <div class="flex justify-center mb-6">
                                <div class="bg-indigo-100 p-4 rounded-full">
                                    <i class="fas fa-' . ($row['icon'] ?? 'code') . ' text-indigo-600 text-2xl"></i>
                                </div>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-center">' . htmlspecialchars($row['keahlian']) . '</h3>
                            <ul class="space-y-2">';
                        
                        // Split keterangan keahlian menjadi item-item
                        $items = explode("\n", $row['framework']);
                        foreach(array_slice($items, 0, 5) as $item) {
                            if (!empty(trim($item))) {
                                echo '<li class="flex items-center">
                                    <span class="w-2 h-2 bg-indigo-500 rounded-full mr-2"></span>
                                    ' . htmlspecialchars(trim($item)) . '
                                </li>';
                            }
                        }
                        
                        echo '</ul>
                        </div>';
                    }
                } else {
                    echo '<p class="text-center col-span-3">Tidak ada data keahlian yang tersedia</p>';
                }
                
                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <!-- Experience Timeline -->
    <section id="experience" class="py-20 bg-indigo-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Developer Experience</h2>
            
            <div class="relative max-w-4xl mx-auto">
                <!-- Timeline line -->
                <div class="absolute left-4 h-full w-0.5 bg-indigo-200"></div>
                
                <?php
                // Koneksi ke database
                $conn = new mysqli($host, $username, $password, $database);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // Query untuk mengambil data pengalaman
                $sql = "SELECT * FROM pengalaman_developer ORDER BY waktu_menambah DESC";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '
                        <div class="mb-12 flex items-center w-full">
                            <div class="z-10 flex items-center justify-center w-8 h-8 bg-indigo-500 rounded-full shadow-lg absolute left-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="w-full bg-white p-6 rounded-lg shadow-md ml-8">
                                <div class="flex justify-between mb-2">
                                    <h3 class="text-xl font-bold">' . htmlspecialchars($row['pekerjaan_dev']) . '</h3>
                                    <span class="text-indigo-600 font-semibold">' . date('Y', strtotime($row['waktu_menambah'])) . '</span>
                                </div>
                                <p class="text-gray-600 mb-4">' . htmlspecialchars($row['nama_dev']) . ' | ' . htmlspecialchars($row['tempat_dev']) . '</p>
                                <ul class="list-disc list-inside space-y-1">';
                        
                        // Split deskripsi menjadi poin-poin
                        $points = explode("\n", $row['deskripsi_dev']);
                        foreach($points as $point) {
                            if (!empty(trim($point))) {
                                echo '<li>' . htmlspecialchars(trim($point)) . '</li>';
                            }
                        }
                        
                        echo '</ul>
                            </div>
                        </div>';
                    }
                } else {
                    echo '<p class="text-center">Tidak ada data pengalaman yang tersedia</p>';
                }
                
                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <!-- Projects Showcase -->
    <section id="projects" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Featured Projects</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                // Koneksi ke database
                $conn = new mysqli($host, $username, $password, $database);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // Query untuk mengambil data proyek
                $sql = "SELECT * FROM proyek_unggulan LIMIT 3";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '
                        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                            <div class="h-48 overflow-hidden">
                                <img src="' . htmlspecialchars($row['gambar'] ?? 'default-project.jpg') . '" 
                                     alt="' . htmlspecialchars($row['nama_proyek']) . '" 
                                     class="w-full h-full object-cover"
                                     onerror="this.src=\'default-project.jpg\'">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2">' . htmlspecialchars($row['nama_proyek']) . '</h3>
                                <p class="text-gray-600 mb-4">' . htmlspecialchars($row['deskripsi_proyek']) . '</p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">' . htmlspecialchars($row['tempat_pengerjaan']) . '</span>
                                </div>
                                <div class="flex justify-end">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">View Details →</a>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo '<p class="text-center col-span-3">Tidak ada data proyek yang tersedia</p>';
                }
                
                $conn->close();
                ?>
            </div>
            
            <div class="text-center mt-12">
                <button class="px-8 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition duration-300 shadow-lg">
                    View All Projects
                </button>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Our Development Process</h2>
            
            <?php
            // Koneksi ke database
            $conn = new mysqli($host, $username, $password, $database);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Query untuk mengambil data proses pengembangan
            $sql = "SELECT * FROM proses_pengembangan ORDER BY id";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '
                    <div class="mb-6 bg-gray-50 rounded-lg overflow-hidden border border-gray-200 process-step">
                        <div class="step-header flex items-center justify-between p-6 cursor-pointer">
                            <div class="flex items-center">
                                <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full mr-4 step-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="text-xl font-bold">' . htmlspecialchars($row['langkahLangkah']) . '</div>
                            </div>
                            <div class="text-indigo-600">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="step-content p-6 pt-0 hidden border-t border-gray-200">
                            <p>' . htmlspecialchars($row['deskripsi_proses']) . '</p>
                        </div>
                    </div>';
                }
            } else {
                echo '<p class="text-center">Tidak ada data proses pengembangan yang tersedia</p>';
            }
            
            $conn->close();
            ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-indigo-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Siap Meningkatkan Bisnis Anda?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Hubungi kami sekarang untuk konsultasi gratis dan temukan bagaimana kami dapat membantu bisnis Anda tumbuh.</p>
            <a href="#contact" class="inline-block px-8 py-3 bg-white text-indigo-600 rounded-lg font-medium hover:bg-gray-100 transition duration-300 shadow-lg">
                Hubungi Kami
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">RPL Community</h3>
                    <p class="mb-4">Mastering the modern development stack with expertise across the entire software lifecycle.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-indigo-300"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white hover:text-indigo-300"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white hover:text-indigo-300"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-white hover:text-indigo-300"><i class="fab fa-github"></i></a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="beranda.html" class="hover:text-indigo-300">Beranda</a></li>
                        <li><a href="tentang.html" class="hover:text-indigo-300">Tentang</a></li>
                        <li><a href="keahlian.html" class="hover:text-indigo-300">Keahlian</a></li>
                        <li><a href="portofolio.html" class="hover:text-indigo-300">Portofolio</a></li>
                        <li><a href="tim.html" class="hover:text-indigo-300">Tim</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact Info</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-2"></i>
                            <span>123 Developer Street, Tech City, 101010</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-2"></i>
                            <span>+1 (234) 567-8900</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-2"></i>
                            <span>info@rplcommunity.example</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2023 RPL Community. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Skills Radar Chart
            const ctx = document.getElementById('skillsChart')?.getContext('2d');
            if (ctx) {
                new Chart(ctx, {
                    type: 'radar',
                    data: {
                        labels: ['Frontend', 'Backend', 'DevOps', 'Mobile', 'Testing', 'Database', 'Cloud'],
                        datasets: [
                            {
                                label: 'JavaScript/TypeScript',
                                data: [95, 90, 70, 80, 85, 60, 65],
                                backgroundColor: 'rgba(99, 102, 241, 0.2)',
                                borderColor: 'rgba(99, 102, 241, 1)',
                                borderWidth: 2
                            },
                            {
                                label: 'Python',
                                data: [30, 85, 75, 40, 88, 80, 70],
                                backgroundColor: 'rgba(159, 122, 234, 0.2)',
                                borderColor: 'rgba(159, 122, 234, 1)',
                                borderWidth: 2
                            }
                        ]
                    },
                    options: {
                        scales: {
                            r: {
                                angleLines: { display: true },
                                suggestedMin: 0,
                                suggestedMax: 100
                            }
                        }
                    }
                });
            }

            // Process steps toggle functionality
            const stepHeaders = document.querySelectorAll('.step-header');
            stepHeaders.forEach(header => {
                header.addEventListener('click', () => {
                    const step = header.closest('.process-step');
                    const content = header.nextElementSibling;
                    const icon = header.querySelector('.step-icon i');
                    
                    step.classList.toggle('active');
                    content.classList.toggle('hidden');
                    icon.classList.toggle('fa-chevron-down');
                    icon.classList.toggle('fa-chevron-up');
                });
            });

            // Mobile menu toggle
            const hamburger = document.getElementById('hamburger');
            const navMenu = document.getElementById('navMenu');
            
            hamburger?.addEventListener('click', () => {
                hamburger.classList.toggle('active');
                navMenu?.classList.toggle('hidden');
                
                // Animate hamburger icon
                const spans = hamburger.querySelectorAll('span');
                if (hamburger.classList.contains('active')) {
                    spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                    spans[1].style.opacity = '0';
                    spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
                } else {
                    spans[0].style.transform = 'none';
                    spans[1].style.opacity = '1';
                    spans[2].style.transform = 'none';
                }
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                        
                        // Close mobile menu if open
                        if (hamburger?.classList.contains('active')) {
                            hamburger.click();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>