<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Sonar - Bem-vindo</title>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#000000',
                        secondary: '#EF4444',
                        ceara: '#1b191f',
                        'ceara-gray': '#3a393d',
                        'ceara-white': '#fdfcfe',
                        'ceara-black': '#0f0d13',
                    },
                },
            },
        };
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        .title-glow {
            text-shadow: 0 0 10px rgba(239, 68, 68, 0.3);
        }

        .gradient-text {
            background: linear-gradient(45deg, #EF4444, #FF8080);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

    
        .mobile-menu {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-menu {
                display: block;
            }

            .desktop-menu {
                display: none;
            }

            .menu-items {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: #0f0d13;
                padding: 1rem;
                border-radius: 0 0 1rem 1rem;
            }

            .menu-items.active {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .footer-link {
            transition: all 0.3s ease;
        }

        .footer-link:hover {
            color: #EF4444;
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-ceara-black to-ceara text-ceara-white min-h-screen select-none">
   
    <nav class="fixed w-full bg-ceara-black/90 backdrop-blur-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl sm:text-3xl font-bold title-glow" style="font-family: 'Anton', serif;">SONAR
                    </h1>
                </div>

           
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#about" class="hover:text-secondary transition-colors">Sobre</a>
                    <a href="#features" class="hover:text-secondary transition-colors">Recursos</a>
                    <a href="./views/entrar_cadastrar.php"
                        class="bg-secondary px-6 py-2 rounded-lg hover:bg-opacity-90 transition-all transform hover:scale-105">
                        Conectar
                    </a>
                </div>

               
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-white p-2">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            
            <div id="mobile-menu" class="md:hidden hidden pb-4">
                <div class="flex flex-col space-y-4">
                    <a href="#about" class="hover:text-secondary transition-colors px-4 py-2">Sobre</a>
                    <a href="#features" class="hover:text-secondary transition-colors px-4 py-2">Recursos</a>
                    <a href="./views/entrar_cadastrar.php"
                        class="bg-secondary px-6 py-2 rounded-lg hover:bg-opacity-90 transition-all text-center">
                        Conectar
                    </a>
                </div>
            </div>
        </div>
    </nav>

   
    <section class="pt-24 md:pt-32 pb-16 md:pb-20 px-4">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center justify-between gap-8">
            <div class="lg:w-1/2 text-center lg:text-left space-y-6">
                <h2 class="text-4xl sm:text-5xl lg:text-7xl font-bold gradient-text"
                    style="font-family: 'Anton', serif;">
                    DESCUBRA NOVOS SONS
                </h2>
                <p class="text-base sm:text-lg text-gray-300 font-light max-w-xl mx-auto lg:mx-0"
                    style="font-family: 'Poppins', sans-serif;">
                    Conecte-se com outros músicos, compartilhe suas criações e explore um mundo de possibilidades
                    musicais.
                </p>
                <a href="./views/entrar_cadastrar.php"
                    class="inline-block bg-secondary px-6 sm:px-8 py-3 sm:py-4 rounded-lg text-base sm:text-lg font-semibold hover:bg-opacity-90 transition-all transform hover:scale-105">
                    Comece Agora
                </a>
            </div>

        </div>
    </section>

    <section id="features" class="py-16 md:py-20 bg-ceara-black/50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <h3 class="text-2xl md:text-3xl font-bold text-center mb-12 gradient-text">Recursos Principais</h3>

          
            <div class="relative">
                
                <div class="md:hidden text-center text-gray-400 mb-4">
                    </i> Arraste para ver mais <i class="fas fa-arrow-right mx-2"></i>
                </div>

                
                <div
                    class="cards-container flex md:grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 overflow-x-auto snap-x snap-mandatory hide-scrollbar">
                   
                    <div class="card-hover group min-w-[280px] sm:min-w-[320px] md:min-w-0 flex-shrink-0 snap-center">
                        <div class="bg-ceara p-6 rounded-lg h-full">
                            <div class="flex flex-col items-center text-center">
                                <div
                                    class="bg-secondary/10 p-4 rounded-full mb-4 group-hover:bg-secondary/20 transition-all">
                                    <i class="fas fa-music text-secondary text-3xl"></i>
                                </div>
                                <h4 class="text-xl font-semibold mb-2">Compartilhe Música</h4>
                                <p class="text-gray-400">Upload suas faixas e compartilhe elas .</p>
                            </div>
                        </div>
                    </div>

                  
                    <div class="card-hover group min-w-[280px] sm:min-w-[320px] md:min-w-0 flex-shrink-0 snap-center">
                        <div class="bg-ceara p-6 rounded-lg h-full">
                            <div class="flex flex-col items-center text-center">
                                <div
                                    class="bg-secondary/10 p-4 rounded-full mb-4 group-hover:bg-secondary/20 transition-all">
                                    <i class="fas fa-users text-secondary text-3xl"></i>
                                </div>
                                <h4 class="text-xl font-semibold mb-2">Conecte-se</h4>
                                <p class="text-gray-400">Encontre outros músicos e forme colaborações.</p>
                            </div>
                        </div>
                    </div>

                    
                    <div class="card-hover group min-w-[280px] sm:min-w-[320px] md:min-w-0 flex-shrink-0 snap-center">
                        <div class="bg-ceara p-6 rounded-lg h-full">
                            <div class="flex flex-col items-center text-center">
                                <div
                                    class="bg-secondary/10 p-4 rounded-full mb-4 group-hover:bg-secondary/20 transition-all">
                                    <i class="fas fa-star text-secondary text-3xl"></i>
                                </div>
                                <h4 class="text-xl font-semibold mb-2">Descubra</h4>
                                <p class="text-gray-400">Explore novos artistas e gêneros musicais.</p>
                            </div>
                        </div>
                    </div>

                
                    <div class="card-hover group min-w-[280px] sm:min-w-[320px] md:min-w-0 flex-shrink-0 snap-center">
                        <div class="bg-ceara p-6 rounded-lg h-full">
                            <div class="flex flex-col items-center text-center">
                                <div
                                    class="bg-secondary/10 p-4 rounded-full mb-4 group-hover:bg-secondary/20 transition-all">
                                    <i class="fas fa-list text-secondary text-3xl"></i>
                                </div>
                                <h4 class="text-xl font-semibold mb-2">Playlists</h4>
                                <p class="text-gray-400">Crie e compartilhe suas playlists favoritas.</p>
                            </div>
                        </div>
                    </div>

               
                    <div class="card-hover group min-w-[280px] sm:min-w-[320px] md:min-w-0 flex-shrink-0 snap-center">
                        <div class="bg-ceara p-6 rounded-lg h-full">
                            <div class="flex flex-col items-center text-center">
                                <div
                                    class="bg-secondary/10 p-4 rounded-full mb-4 group-hover:bg-secondary/20 transition-all">
                                    <i class="fas fa-chart-line text-secondary text-3xl"></i>
                                </div>
                                <h4 class="text-xl font-semibold mb-2">Análises</h4>
                                <p class="text-gray-400">Acompanhe o desempenho de suas músicas.</p>
                            </div>
                        </div>
                    </div>

          
                    <div class="card-hover group min-w-[280px] sm:min-w-[320px] md:min-w-0 flex-shrink-0 snap-center">
                        <div class="bg-ceara p-6 rounded-lg h-full">
                            <div class="flex flex-col items-center text-center">
                                <div
                                    class="bg-secondary/10 p-4 rounded-full mb-4 group-hover:bg-secondary/20 transition-all">
                                    <i class="fas fa-calendar-alt text-secondary text-3xl"></i>
                                </div>
                                <h4 class="text-xl font-semibold mb-2">Eventos</h4>
                                <p class="text-gray-400">Descubra e participe de eventos musicais.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <style>
      
        .hide-scrollbar {
            -ms-overflow-style: none;
       
            scrollbar-width: none;
          
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        
        }

        
        .card-hover {
            transition: all 0.3s ease;
            border: 1px solid transparent;
            background: linear-gradient(145deg, rgba(27, 25, 31, 0.6), rgba(27, 25, 31, 0.9));
        }

        .card-hover:hover {
            transform: translateY(-5px);
            border-color: rgba(239, 68, 68, 0.2);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2),
                0 0 0 1px rgba(239, 68, 68, 0.1);
        }

        .card-hover:hover i {
            transform: scale(1.1);
        }

        .card-hover i {
            transition: transform 0.3s ease;
        }

        .cards-container {
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 1rem;
        
        }

        @keyframes slideHint {
            0% {
                opacity: 1;
                transform: translateX(0);
            }

            50% {
                opacity: 0.5;
                transform: translateX(10px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .fa-arrow-right {
            animation: slideHint 1.5s infinite;
        }
    </style>

   
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.querySelector('.cards-container');
            let isDown = false;
            let startX;
            let scrollLeft;

            container.addEventListener('mousedown', (e) => {
                isDown = true;
                container.style.cursor = 'grabbing';
                startX = e.pageX - container.offsetLeft;
                scrollLeft = container.scrollLeft;
            });

            container.addEventListener('mouseleave', () => {
                isDown = false;
                container.style.cursor = 'grab';
            });

            container.addEventListener('mouseup', () => {
                isDown = false;
                container.style.cursor = 'grab';
            });

            container.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - container.offsetLeft;
                const walk = (x - startX) * 2;
                container.scrollLeft = scrollLeft - walk;
            });
        });
    </script>

    <!-- About Section -->
    <section id="about" class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-ceara rounded-xl p-8 lg:p-12">
                <h3 class="text-3xl font-bold mb-6">Sobre o Sonar</h3>
                <p class="text-gray-300 mb-6">
                    O Sonar é uma plataforma dedicada a conectar músicos, produtores e entusiastas da música.
                    Nossa missão é criar um espaço onde a criatividade musical possa florescer através da colaboração
                    e do compartilhamento de ideias.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-secondary">10k+</div>
                        <div class="text-gray-400">Usuários Ativos</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-secondary">50k+</div>
                        <div class="text-gray-400">Faixas Compartilhadas</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-secondary">5k+</div>
                        <div class="text-gray-400">Colaborações</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

 
    <footer class="bg-ceara-black py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
               
                <div class="flex flex-col items-center md:items-start space-y-4">
                    <h1 class="text-3xl font-bold gradient-text" style="font-family: 'Anton', serif;">
                        SONAR
                    </h1>
                    <p class="text-gray-400 text-sm max-w-xs text-center md:text-left leading-relaxed">
                        Conectando músicos e criando possibilidades infinitas através da música.
                    </p>
                </div>


                <div class="flex flex-col items-center md:items-start space-y-4">
                    <h4
                        class="text-lg my-2 font-semibold text-white relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-12 after:h-0.5 after:bg-secondary">
                        Desenvolvedores
                    </h4>
                    <div class="space-y-4 w-full">
                        <div class="dev-card group">
                            <div class="flex items-center justify-between">
                                <div class="space-y-1">
                                    <p class="text-gray-200 font-medium group-hover:text-secondary transition-colors">
                                        Matheus Felix
                                    </p>
                                    <p class="text-gray-400 text-sm">Frontend Developer</p>
                                </div>
                                <div class="flex space-x-3">
                                    <a href="https://github.com/mthfl" class="dev-social-link group">
                                        <i class="fab fa-github"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/in/matheus-fl/" class="dev-social-link group">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="dev-card group">
                            <div class="flex items-center justify-between">
                                <div class="space-y-1">
                                    <p class="text-gray-200 font-medium group-hover:text-secondary transition-colors">
                                        Pedro Uchoa
                                    </p>
                                    <p class="text-gray-400 text-sm">Backend Developer</p>
                                </div>
                                <div class="flex space-x-3">
                                    <a href="https://github.com/Uchoadev16" class="dev-social-link group">
                                        <i class="fab fa-github"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/in/pedro-uch%C3%B4a-de-abreu-67723429a/" class="dev-social-link group">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex flex-col mx-4 items-center md:items-start space-y-4">
                    <h4
                        class="text-lg my-2  font-semibold text-white relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-12 after:h-0.5 after:bg-secondary">
                        Contato
                    </h4>
                    <div class="flex space-x-4">
                        <a href="#" class="social-icon-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon-link">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div>
                </div>
            </div>

           
            <div class="border-t border-gray-800 mt-8 pt-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">&copy; 2024 Sonar. Todos os direitos reservados.</p>
                    <div class="flex space-x-4 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-secondary text-sm transition-colors">Termos</a>
                        <span class="text-gray-600">•</span>
                        <a href="#" class="text-gray-400 hover:text-secondary text-sm transition-colors">Privacidade</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <style>
        .gradient-text {
            background: linear-gradient(45deg, #EF4444, #FF8080);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 0 2px rgba(239, 68, 68, 0.3));
        }

        .social-icon-link {
            @apply w-10 h-10 rounded-lg flex items-center justify-center text-gray-400 hover:text-white bg-gray-800 hover:bg-secondary transition-all duration-300;
        }

        .dev-card {
            @apply p-4 rounded-lg bg-gray-800/20 border border-gray-800 hover:border-secondary/30 transition-all duration-300;
        }

        .dev-social-link {
            @apply text-gray-400 hover:text-secondary transition-colors duration-300 text-xl;
        }

        .dev-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>