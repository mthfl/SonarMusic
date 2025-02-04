<?php
require_once('../models/sessions.php');
$session = new sessions();
$session->tempo_session(600);
$session->autenticar_session();

if (isset($_POST['logout'])) {
    $session->quebra_session();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Sonar</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');

    h1 {
        font-family: "Anton", serif;
    }

    ul {
        font-family: "Noto Sans", serif;
    }

    body,
    html {
        margin: 0px;
    }

    #menuButton {
        z-index: 50;
    }

    #sidebar {
        z-index: 40;
    }

    .mobile-margin {
        margin-top: 40px;
        align-items: center;
    }

    @media (min-width: 768px) {
        .mobile-margin {
            margin-top: 0;
            align-items: start;
        }
    }
</style>

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
                fontFamily: {
                    'title-secondary': ['"Noto Sans"', 'serif'],
                },
            },
        },
    };

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const menuButton = document.getElementById('menuButton');
        const mainContent = document.querySelector('.main-content');
        const barsIcon = menuButton.querySelector('.fa-bars');
        const timesIcon = menuButton.querySelector('.fa-times');

        const isSidebarOpen = !sidebar.classList.contains('-translate-x-full');

        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');

        barsIcon.classList.toggle('hidden');
        timesIcon.classList.toggle('hidden');

        if (window.innerWidth < 768) {
            if (isSidebarOpen) {
                mainContent.classList.remove('md:ml-[280px]', 'ml-[100px]');
                mainContent.classList.add('ml-0', 'flex', 'flex-col', 'items-center');
            } else {
                mainContent.classList.remove('ml-0', 'flex', 'flex-col', 'items-center');
                mainContent.classList.add('ml-[100px]');
            }
        }

        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            item.classList.toggle('md:items-start', !sidebar.classList.contains('-translate-x-full'));
            item.classList.toggle('items-start', sidebar.classList.contains('-translate-x-full'));
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const mainContent = document.querySelector('.main-content');
        const sidebar = document.getElementById('sidebar');

        if (window.innerWidth < 768 && sidebar.classList.contains('-translate-x-full')) {
            mainContent.classList.remove('md:ml-[280px]', 'ml-[100px]');
            mainContent.classList.add('ml-0', 'flex', 'flex-col', 'items-center');
        }
    });

    window.addEventListener('resize', function () {
        const mainContent = document.querySelector('.main-content');
        const sidebar = document.getElementById('sidebar');

        if (window.innerWidth >= 768) {
            mainContent.classList.remove('ml-0', 'flex', 'flex-col', 'items-center');
            mainContent.classList.add('md:ml-[280px]');
        } else if (sidebar.classList.contains('-translate-x-full')) {
            mainContent.classList.remove('md:ml-[280px]', 'ml-[100px]');
            mainContent.classList.add('ml-0', 'flex', 'flex-col', 'items-center');
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('favoritesContainer');
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');
        const itemWidth = container.querySelector('.favorite-song-item').offsetWidth;
        const gap = 16;
        let currentScroll = 0;

        const maxScroll = container.scrollWidth - container.clientWidth;

        nextButton.addEventListener('click', () => {
            currentScroll += itemWidth + gap;
            if (currentScroll > maxScroll) {
                currentScroll = 0;
            }
            container.scrollTo({
                left: currentScroll,
                behavior: 'smooth'
            });
        });

        prevButton.addEventListener('click', () => {
            currentScroll -= itemWidth + gap;
            if (currentScroll < 0) {
                currentScroll = maxScroll;
            }
            container.scrollTo({
                left: currentScroll,
                behavior: 'smooth'
            });
        });
    });
</script>

<body class="select-none bg-ceara-black">
    <div class="container">

        <button onclick="toggleSidebar()" id="menuButton"
            class="fixed top-4 left-4 z-20 md:hidden bg-[#1b191f] rounded-full p-3 shadow-lg hover:bg-[#fdfcfe]/20 transition-all duration-300">
            <div class="w-6 h-6 relative flex items-center justify-center">
                <i class="fas fa-bars text-[#fdfcfe] text-xl"></i>
                <i class="fas fa-times text-[#fdfcfe] text-xl hidden items-center"></i>
            </div>
        </button>

        <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-30 hidden transition-opacity duration-300"></div>

        <section id="sidebar" class="sidebar fixed inset-0 w-[100px] md:w-[280px] h-screen bg-[#1b191f] text-[#fdfcfe] 
    transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-40">
            <div class="mx-4 pt-6">
                <a href="home_page.php">
                    <h1 class="text-3xl md:text-4xl mx-2 hidden md:block">SONAR</h1>
                </a>

                <ul
                    class="mt-4 cursor-pointer text-lg md:text-2xl font-light flex flex-col md:items-start items-center mobile-margin">
                    <li tabindex="0"
                        class="menu-item text-ceara-white my-2 hover:bg-[#fdfcfe]/20 focus:bg-[#fdfcfe]/20 rounded-lg transition-bg duration-300 ease-in-out h-[50px] flex items-center group">
                        <i class="fas fa-home mx-2 text-2xl group-focus:text-secondary"></i>
                        <span
                            class="hidden md:inline text-base md:text-xl mx-2 group-focus:text-secondary group-focus:font-semibold">Inicio</span>
                    </li>
                    <li tabindex="0"
                        class="menu-item text-ceara-white my-2 hover:bg-[#fdfcfe]/20 focus:bg-[#fdfcfe]/20 rounded-lg transition-bg duration-300 ease-in-out h-[50px] flex items-center group">
                        <i class="fas fa-compass mx-2 text-2xl group-focus:text-secondary"></i>
                        <span
                            class="hidden md:inline text-base md:text-xl mx-2 group-focus:text-secondary group-focus:font-semibold">Explorar</span>
                    </li>
                    <li tabindex="0"
                        class="menu-item text-ceara-white my-2 hover:bg-[#fdfcfe]/20 focus:bg-[#fdfcfe]/20 rounded-lg transition-bg duration-300 ease-in-out h-[50px] flex items-center group">
                        <i class="fas fa-heart mx-2 text-2xl group-focus:text-secondary"></i>
                        <span
                            class="hidden md:inline text-base md:text-xl mx-2 group-focus:text-secondary group-focus:font-semibold">Favorito</span>
                    </li>
                </ul>
            </div>

            <div class="my-4">
                <hr>
            </div>

            <div class="playlist">
                <h1 class="font-title-secondary mx-4 font-bold text-lg md:text-xl hidden md:block">Playlists</h1>
                <ul class="text-base md:text-lg mx-[20px]">
                    <a href="acessar_playlist.php">
                        <li
                            class="flex items-center mt-6 hover:bg-[#fdfcfe]/20 rounded-lg transition-bg duration-300 ease-in-out h-[45px]">
                            <i
                                class="fas fa-star mx-2 w-[35px] flex items-center justify-center h-[30px] bg-secondary"></i>
                            <span class="hidden md:inline">Acessar playlist</span>
                        </li>
                    </a>
                    <a href="criar_playlist.php">
                        <li
                            class="my-4 flex items-center hover:bg-[#fdfcfe]/20 rounded-lg transition-bg duration-300 ease-in-out h-[45px]">
                            <i
                                class="fas fa-plus mx-2 w-[35px] flex items-center justify-center h-[30px] bg-[#fdfcfe]/20"></i>
                            <span class="hidden md:inline">Criar uma Playlist</span>
                        </li>
                    </a>
                </ul>
            </div>
        </section>

        <section class="main-content md:ml-[280px] transition-all duration-300 flex-1 bg-ceara-black min-h-screen">

            <header class="sticky top-0 z-10 bg-ceara-black/80 backdrop-blur-sm pl-16 md:pl-4">
                <div class="flex justify-between items-center p-4">
                    <div class="relative w-full max-w-md">
                        <input class="w-full h-[50px] bg-ceara-gray rounded-lg focus:outline-none pl-12 pr-4 text-ceara-white 
                            border-3 border-transparent transition-colors duration-300 focus:border-secondary"
                            type="text" placeholder="Faixas, álbuns, Perfis...">
                        <i
                            class="fas fa-search text-ceara-white absolute left-4 top-1/2 transform -translate-y-1/2"></i>
                    </div>

                    <div class="ml-4 relative">
                        
                        <button id="dropdownButton"
                            class="group flex items-center space-x-3 bg-ceara-gray rounded-full p-1.5 hover:bg-ceara-gray/80 transition-all duration-300 ">
                          
                            <div class="relative w-[42px] h-[42px] sm:w-[40px] sm:h-[40px] flex-shrink-0">
                                <div
                                    class="absolute inset-0 rounded-full border-2 border-ceara-white/30 shadow-inner overflow-hidden">
                                    <img src="https://api.dicebear.com/9.x/initials/svg?seed=<?= $_SESSION['nome'] ?>"
                                        class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-300"
                                        alt="Perfil">
                                    
                                    <div
                                        class="absolute inset-0 bg-gradient-to-b from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center">
                          
                                <span
                                    class="text-ceara-white text-sm font-medium font-title-secondary mr-2 hidden md:block">
                                    <?= $_SESSION['nome'] ?>
                                </span>
                                <i
                                    class="fas fa-chevron-down text-ceara-white text-sm transition-transform duration-300"></i>
                            </div>
                        </button>

                       
                        <div id="dropdownMenu"
                            class="dropdown-content hidden absolute right-0 w-48 mt-2 bg-ceara rounded-lg shadow-lg border border-ceara-gray transform opacity-0 scale-95 transition-all duration-200">
                         
                            <div class="px-4 py-3 border-b border-ceara-gray">
                                <div class="flex items-center space-x-3">
                                  
                                    <div
                                        class="w-8 h-8 rounded-full border border-ceara-gray overflow-hidden flex-shrink-0">
                                        <img src="https://api.dicebear.com/9.x/initials/svg?seed=<?= $_SESSION['nome'] ?>"
                                            class="w-full h-full object-cover" alt="Perfil">
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-ceara-white font-title-secondary">
                                            <?= $_SESSION['nome'] ?></p>
                                        <a href="perfil.php"
                                            class="text-xs text-secondary hover:text-secondary/80 transition-colors">Minha
                                            Conta</a>
                                    </div>
                                </div>
                            </div>

                            <form method="post" action="" class="m-0">
                                <button type="submit" name="logout"
                                    class="w-full flex items-center px-4 py-3 text-secondary hover:bg-ceara-gray/50 rounded-b-lg transition-colors">
                                    <i class="fas fa-sign-out-alt mr-3"></i>
                                    <span class="font-semibold font-title-secondary">Sair</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <style>
                        .dropdown-content {
                            z-index: 50;
                            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.2);
                        }

                        .dropdown-content.active {
                            display: block;
                            opacity: 1;
                            transform: scale(100%);
                        }

                        #dropdownButton.active i {
                            transform: rotate(180deg);
                        }

                        #dropdownButton:hover .rounded-full {
                            animation: borderGlow 2s infinite;
                        }

                        .dropdown-content button:hover {
                            background: linear-gradient(to right, rgba(58, 57, 61, 0.3), rgba(58, 57, 61, 0.5));
                        }

                        @media (max-width: 640px) {
                            #dropdownButton {
                                padding: 0.375rem;
                            }
                        }
                    </style>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const dropdownButton = document.getElementById('dropdownButton');
                            const dropdownMenu = document.getElementById('dropdownMenu');

                            dropdownButton.addEventListener('click', function (e) {
                                e.stopPropagation();
                                dropdownMenu.classList.toggle('hidden');
                                dropdownMenu.classList.toggle('active');
                                dropdownButton.classList.toggle('active');
                            });

                            document.addEventListener('click', function (e) {
                                if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                                    dropdownMenu.classList.add('hidden');
                                    dropdownMenu.classList.remove('active');
                                    dropdownButton.classList.remove('active');
                                }
                            });
                        });
                    </script>
                </div>
            </header>

            <main class="p-6">

                <section class="mb-8">
                    <h2 class="text-2xl font-bold mb-4 text-ceara-white hover:text-secondary transition-colors">
                        Tocadas recentemente
                    </h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        <div
                            class="bg-ceara-gray rounded-lg p-4 hover:bg-ceara-gray/80 transition-colors cursor-pointer group">
                            <div class="aspect-square bg-secondary mb-2 rounded relative">
                                <img src="../assets/img/recente/racionais.jpg" alt="Música 1"
                                    class="w-full h-full object-cover rounded">
                                <div
                                    class="absolute inset-0 bg-black/40 group-hover:opacity-100 opacity-0 flex items-center justify-center transition-opacity">
                                    <i class="fas fa-play text-white"></i>
                                </div>
                            </div>
                            <h3 class="text-base font-semibold text-ceara-white mt-2">Negro Drama</h3>
                            <p class="text-sm text-ceara-white/60">Racionais</p>
                        </div>
                    </div>
                </section>

                <section class="mb-8 p-2 md:p-4">

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl md:text-2xl font-bold text-ceara-white">Favoritas</h2>
                    </div>

                    <div id="favoritesContainer"
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 md:gap-4 overflow-hidden">
                        
                        <div class="favorite-song-item bg-ceara-gray rounded-lg p-2 md:p-3 hover:bg-ceara-gray/80 transition-colors group">
                            <div class="flex items-center space-x-2 md:space-x-4">
                                <div class="relative w-10 h-10 md:w-12 md:h-12 rounded overflow-hidden flex-shrink-0">
                                    <img src="../assets/img/favorita/jorge_matheus.jpg" 
                                         alt="Música Favorita"
                                         class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 group-hover:opacity-100 opacity-0 flex items-center justify-center transition-opacity">
                                        <i class="fas fa-play text-white text-sm md:text-base"></i>
                                    </div>
                                </div>

                                <div class="flex-grow min-w-0">
                                    <h3 class="text-ceara-white font-semibold                                    text-sm md:text-base truncate">Fogueira</h3>
                                    <p class="text-xs md:text-sm text-ceara-white/60 truncate">Jorge e Matheus</p>
                                </div>

                                <div class="flex items-center space-x-2 md:space-x-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="text-ceara-white/60 hover:text-secondary p-1">
                                        <i class="fas fa-heart text-sm md:text-base"></i>
                                    </button>
                                    <button class="text-ceara-white/60 hover:text-secondary p-1">
                                        <i class="fas fa-ellipsis-h text-sm md:text-base"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="favorite-song-item bg-ceara-gray rounded-lg p-2 md:p-3 hover:bg-ceara-gray/80 transition-colors group">
                            <div class="flex items-center space-x-2 md:space-x-4">
                                <div class="relative w-10 h-10 md:w-12 md:h-12 rounded overflow-hidden flex-shrink-0">
                                    <img src="../assets/img/favorita/esqueci_vc.jpg" 
                                         alt="Música Favorita"
                                         class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 group-hover:opacity-100 opacity-0 flex items-center justify-center transition-opacity">
                                        <i class="fas fa-play text-white text-sm md:text-base"></i>
                                    </div>
                                </div>

                                <div class="flex-grow min-w-0">
                                    <h3 class="text-ceara-white font-semibold text-sm md:text-base truncate">Eu esqueci</h3>
                                    <p class="text-xs md:text-sm text-ceara-white/60 truncate">Henrique e Diego</p>
                                </div>

                                <div class="flex items-center space-x-2 md:space-x-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="text-ceara-white/60 hover:text-secondary p-1">
                                        <i class="fas fa-heart text-sm md:text-base"></i>
                                    </button>
                                    <button class="text-ceara-white/60 hover:text-secondary p-1">
                                        <i class="fas fa-ellipsis-h text-sm md:text-base"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="favorite-song-item bg-ceara-gray rounded-lg p-2 md:p-3 hover:bg-ceara-gray/80 transition-colors group">
                            <div class="flex items-center space-x-2 md:space-x-4">
                                <div class="relative w-10 h-10 md:w-12 md:h-12 rounded overflow-hidden flex-shrink-0">
                                    <img src="../assets/img/favorita/eternos.jpg" 
                                         alt="Música Favorita"
                                         class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 group-hover:opacity-100 opacity-0 flex items-center justify-center transition-opacity">
                                        <i class="fas fa-play text-white text-sm md:text-base"></i>
                                    </div>
                                </div>

                                <div class="flex-grow min-w-0">
                                    <h3 class="text-ceara-white font-semibold text-sm md:text-base truncate">Eternos Alunos</h3>
                                    <p class="text-xs md:text-sm text-ceara-white/60 truncate">Mc Ph</p>
                                </div>

                                <div class="flex items-center space-x-2 md:space-x-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="text-ceara-white/60 hover:text-secondary p-1">
                                        <i class="fas fa-heart text-sm md:text-base"></i>
                                    </button>
                                    <button class="text-ceara-white/60 hover:text-secondary p-1">
                                        <i class="fas fa-ellipsis-h text-sm md:text-base"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="favorite-song-item bg-ceara-gray rounded-lg p-2 md:p-3 hover:bg-ceara-gray/80 transition-colors group">
                            <div class="flex items-center space-x-2 md:space-x-4">
                                <div class="relative w-10 h-10 md:w-12 md:h-12 rounded overflow-hidden flex-shrink-0">
                                    <img src="../assets/img/favorita/tarde.jpg" 
                                         alt="Música Favorita"
                                         class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 group-hover:opacity-100 opacity-0 flex items-center justify-center transition-opacity">
                                        <i class="fas fa-play text-white text-sm md:text-base"></i>
                                    </div>
                                </div>

                                <div class="flex-grow min-w-0">
                                    <h3 class="text-ceara-white font-semibold text-sm md:text-base truncate">Tá Tarde</h3>
                                    <p class="text-xs md:text-sm text-ceara-white/60 truncate">Vulgo Fk</p>
                                </div>

                                <div class="flex items-center space-x-2 md:space-x-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="text-ceara-white/60 hover:text-secondary p-1">
                                        <i class="fas fa-heart text-sm md:text-base"></i>
                                    </button>
                                    <button class="text-ceara-white/60 hover:text-secondary p-1">
                                        <i class="fas fa-ellipsis-h text-sm md:text-base"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <style>
                    @media (hover: none) {
                        .favorite-song-item .group-hover\:opacity-100 {
                            opacity: 1;
                        }
                        
                        .favorite-song-item .opacity-0 {
                            opacity: 1;
                        }
                    }

                    .favorite-song-item {
                        transition: transform 0.2s ease;
                    }

                    .favorite-song-item:hover {
                        transform: translateY(-2px);
                    }

                    @media (max-width: 640px) {
                        .favorite-song-item .opacity-0 {
                            opacity: 0.7;
                        }
                        
                        .favorite-song-item:active {
                            transform: scale(0.98);
                        }
                    }

                    @media (min-width: 640px) and (max-width: 1023px) {
                        #favoritesContainer {
                            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                        }
                    }
                </style>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
                        
                        if (isTouchDevice) {
                            document.querySelectorAll('.favorite-song-item').forEach(item => {
                                item.classList.add('touch-device');
                            });
                        }
                    });
                </script>
                
                <section>
                    <h2 class="text-2xl font-bold mb-4 text-ceara-white hover:text-secondary transition-colors">
                        Recomendados para você
                    </h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        <div
                            class="bg-ceara-gray rounded-lg p-4 hover:bg-ceara-gray/80 transition-colors cursor-pointer group">
                            <div class="aspect-square bg-secondary mb-2 rounded relative">
                                <img src="../assets/img/album/thales_roberto.jpg" alt="Álbum"
                                    class="w-full h-full object-cover rounded">
                                <div
                                    class="absolute inset-0 bg-black/40 group-hover:opacity-100 opacity-0 flex items-center justify-center transition-opacity">
                                    <i class="fas fa-play text-white"></i>
                                </div>
                            </div>
                            <h3 class="text-base font-semibold text-ceara-white mt-2">Álbum</h3>
                            <p class="text-sm text-ceara-white/60">Artista</p>
                        </div>
                    </div>
                </section>
            </main>

        </section>
    </div>
</body>

</html>

