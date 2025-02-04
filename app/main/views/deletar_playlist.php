<?php
require_once('../models/sessions.php');
require_once('../models/model.playlist.php');
$model_playlist = new playlist();
$playlists = $model_playlist->view_playlist($_SESSION['id']);

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

    <title>Suas Preferidas</title>
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
</script>

<body class="select-none bg-ceara-black">
    <div class="container">

        <button onclick="toggleSidebar()" id="menuButton" class="fixed top-4 left-4 z-20 md:hidden bg-[#1b191f] rounded-full p-3
            shadow-lg hover:bg-[#fdfcfe]/20 transition-all duration-300">
            <div class="w-6 h-6 relative flex items-center justify-center">
                <i class="fas fa-bars text-[#fdfcfe] text-xl"></i>
                <i class="fas fa-times text-[#fdfcfe] text-xl hidden items-center"></i>
            </div>
        </button>

        <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-30 hidden transition-opacity duration-300"></div>

        <section id="sidebar" class="sidebar fixed inset-0 w-[100px] md:w-[280px] h-screen bg-[#1b191f] text-[#fdfcfe] 
            transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-40">
            <div class="mx-4 pt-6">
                <h1 class="text-3xl md:text-4xl mx-2 hidden md:block">SONAR</h1>
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
                                            <?= $_SESSION['nome'] ?>
                                        </p>
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

                            // Toggle dropdown ao clicar
                            dropdownButton.addEventListener('click', function (e) {
                                e.stopPropagation();
                                dropdownMenu.classList.toggle('hidden');
                                dropdownMenu.classList.toggle('active');
                                dropdownButton.classList.toggle('active');
                            });

                            // Fechar dropdown ao clicar fora
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
            <main class="p-6 ">


                <h2 class="text-2xl font-bold mt-8 mb-4 text-ceara-white">Suas Playlists</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 ">
                    <form action="../controllers/controller_playlist.php" method="post ">
                        <!-- Playlist Pessoal -->
                        <?php foreach ($playlists as $playlist) { ?>
                            <?php
                            $total_musica = $model_playlist->views_total_musica($playlist['nome_playlist'], $_SESSION['id']);
                            ?>
                            <div
                                class="bg-ceara-gray rounded-lg p-4 hover:bg-ceara-gray/80 transition-all duration-300 my-4">
                                <div class="flex items-center justify-between space-x-4">
                                    <div class="flex items-center space-x-4">
                                        <!-- Checkbox personalizado -->
                                        <label class="custom-checkbox">
                                            <input type="checkbox" name="playlist"
                                                value="<?= $playlist['nome_playlist'] ?>">
                                            <span class="checkmark"></span>
                                        </label>

                                        <i class="fas fa-music text-ceara-white text-2xl"></i>
                                        <!-- Ícone de música estilizado -->
                                        <div>
                                            <input type="hidden" name="id_usuario" value="<?= $_SESSION['id'] ?>">
                                            <h3 type="submit" class="text-ceara-white font-bold text-lg">
                                                <?= $playlist['nome_playlist'] ?></h3>
                                            <p class="text-ceara-white/70"><?= $total_musica ?> músicas</p>
                                        </div>
                                    </div>
                                    <!-- Botão de excluir -->
                                    <button type="submit" name="delete_playlist" value="<?= $playlist['nome_playlist'] ?>"
                                        class="delete-button">
                                        <i class="fas fa-trash text-ceara-white"></i>
                                    </button>
                                </div>
                            </div>
                        <?php } ?>
                    </form>
                </div>
                <?php if (isset($_POST['true'])) { ?>
                    <p>Playlist criada com sucesso!</p>
                <?php } ?>
                <?php if (isset($_POST['erro'])) { ?>
                    <p>[ERRO] ao deletar a playlist!</p>
                <?php } ?>
            </main>
        </section>
        <style>
            .custom-checkbox {
                display: block;
                position: relative;
                padding-left: 35px;
                margin-bottom: 12px;
                cursor: pointer;
                font-size: 22px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .custom-checkbox input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }

            .checkmark {
                position: absolute;
                top: 0;
                left: 0;
                height: 25px;
                width: 25px;
                background-color: #3a393d;
                border-radius: 5px;
                border: 2px solid #fdfcfe;
            }

            .custom-checkbox:hover input~.checkmark {
                background-color: #fdfcfe/20;
            }

            .custom-checkbox input:checked~.checkmark {
                background-color: #EF4444;
            }

            .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }

            .custom-checkbox input:checked~.checkmark:after {
                display: block;
            }

            .custom-checkbox .checkmark:after {
                left: 9px;
                top: 5px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 3px 3px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }

            .delete-button {
                background-color: #EF4444;
                border: none;
                border-radius: 5px;
                padding: 8px 12px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .delete-button:hover {
                background-color: #dc2626;
            }

            .delete-button i {
                color: #fdfcfe;
                font-size: 16px;
            }
        </style>
    </div>
</body>

</html>