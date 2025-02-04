<?php
if (!isset($_GET['nome_playlist'])) {
    header('location:home_page.php');
    exit();
}
require_once('../models/sessions.php');
require_once('../models/model.playlist.php');
require_once('../models/model.php');

$model_playlist = new playlist();
$model = new model;

$playlists = $model_playlist->view_playlist($_SESSION['id']);
$total_musicas['linhas'] = $model_playlist->views_total_musica($_GET['nome_playlist'], $_SESSION['id']);
$view_musica = $model_playlist->view_musica($_SESSION['id'], $_GET['nome_playlist']);
$tempo_total = $model_playlist->total_muinutos($_SESSION['id'], $_GET['nome_playlist']);
$lista_musica = $model->lista_musicas();

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
    <title>Playlist</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            background-color: #0f0d13;
            font-family: 'Noto Sans', sans-serif;
            color: #fdfcfe;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(58, 57, 61, 0.1);
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(58, 57, 61, 0.5);
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(239, 68, 68, 0.5);
        }

        .song-hover {
            background: transparent;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .song-hover::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 12px;
            background: linear-gradient(to right, rgba(239, 68, 68, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .song-hover:hover::before {
            opacity: 1;
        }

        .song-hover:hover {
            transform: translateX(8px);
        }

        .play-button {
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .song-hover:hover .play-button {
            opacity: 1;
            transform: scale(1);
        }

        .playlist-gradient {
            background: linear-gradient(165deg,
                    rgba(239, 68, 68, 0.15) 0%,
                    rgba(27, 25, 31, 0.4) 40%,
                    #0f0d13 100%);
            position: relative;
            overflow: hidden;
        }

        .playlist-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: radial-gradient(circle at top right,
                    rgba(239, 68, 68, 0.2),
                    transparent 60%);
            pointer-events: none;
        }


        .custom-checkbox {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #3a393d;
            border-radius: 4px;
            outline: none;
            transition: all 0.3s;
        }

        .custom-checkbox:checked {
            background-color: #EF4444;
            border-color: #EF4444;
        }

        .custom-checkbox:checked::after {
            content: '✔';
            color: white;
            display: block;
            text-align: center;
            line-height: 20px;
        }

        .glass-effect {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            background: rgba(15, 13, 19, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .playlist-cover {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .playlist-cover:hover {
            transform: scale(1.02);
        }

        .playlist-cover::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, rgba(239, 68, 68, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .playlist-cover:hover::after {
            opacity: 1;
        }

        .control-button {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .control-button::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, rgba(255, 255, 255, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .control-button:hover::after {
            opacity: 1;
        }

        .add-music-section {
            background: linear-gradient(135deg,
                    rgba(239, 68, 68, 0.05) 0%,
                    rgba(27, 25, 31, 0.1) 50%,
                    rgba(15, 13, 19, 0.15) 100%);
            border: 1px solid rgba(239, 68, 68, 0.1);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            height: 450px
        }

        .select2-container--classic .select2-selection--multiple {
            background: rgba(15, 13, 19, 0.7) !important;
            border: 2px solid rgba(239, 68, 68, 0.2) !important;
            border-radius: 16px !important;
            min-height: 120px !important;
            padding: 8px !important;
            transition: all 0.3s ease !important;
        }

        .select2-container--classic .select2-selection--multiple:focus {
            border-color: rgba(239, 68, 68, 0.5) !important;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1) !important;
        }

        .select2-container--classic .select2-selection--multiple .select2-selection__choice {
            background: linear-gradient(to right, rgba(239, 68, 68, 0.9), rgba(239, 68, 68, 0.7)) !important;
            border: none !important;
            border-radius: 20px !important;
            color: white !important;
            padding: 6px 16px !important;
            margin: 4px !important;
            font-size: 0.875rem !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
        }

        .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove {
            color: white !important;
            margin-right: 8px !important;
            font-size: 1.1em !important;
            transition: all 0.2s ease !important;
        }

        .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove:hover {
            background: rgba(255, 255, 255, 0.2) !important;
            border-radius: 50% !important;
        }

        .select2-container--classic .select2-dropdown {
            background: rgba(15, 13, 19, 0.95) !important;
            border: 2px solid rgba(239, 68, 68, 0.2) !important;
            border-radius: 16px !important;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2) !important;
            backdrop-filter: blur(12px) !important;
        }

        .select2-container--classic .select2-results__option {
            color: #fdfcfe !important;
            padding: 12px 16px !important;
            transition: all 0.2s ease !important;
            border-radius: 8px !important;
            margin: 2px 4px !important;
        }

        .select2-container--classic .select2-results__option--highlighted {
            background: rgba(239, 68, 68, 0.8) !important;
        }

        .select2-container--classic .select2-search--inline .select2-search__field {
            color: #fdfcfe !important;
            font-family: inherit !important;
            margin-top: 8px !important;
            margin-left: 8px !important;
        }

        .select2-container--classic .select2-search--dropdown .select2-search__field {
            background: rgba(58, 57, 61, 0.3) !important;
            border: 1px solid rgba(239, 68, 68, 0.2) !important;
            border-radius: 8px !important;
            color: #fdfcfe !important;
            padding: 8px 12px !important;
        }

        .dropdown-content {
            z-index: 50;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: scale(0.95);
            opacity: 0;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dropdown-content.active {
            transform: scale(1);
            opacity: 1;
        }

        #dropdownButton.active i {
            transform: rotate(180deg);
        }

        .dropdown-content button:hover {
            background: linear-gradient(to right, rgba(239, 68, 68, 0.1), rgba(58, 57, 61, 0.3));
        }

        @media (max-width: 640px) {
            .song-info-mobile {
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        }
    </style>
</head>

<body class="bg-ceara-black font-title-secondary custom-scrollbar min-h-screen select-none">
    <!-- Header -->
    <header class="sticky top-0 z-50 glass-effect">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="home_page.php" class="text-white hover:text-secondary transition-colors duration-300">
                    <i class="fas fa-arrow-left text-2xl"></i>
                </a>

                <div class="relative">
                    <button id="dropdownButton"
                        class="group flex items-center space-x-3 bg-ceara-gray/80 rounded-full p-2 hover:bg-ceara-gray/60 transition-all duration-300">
                        <div class="w-10 h-10 rounded-full overflow-hidden">
                            <img src="https://api.dicebear.com/9.x/initials/svg?seed=<?= $_SESSION['nome'] ?>"
                                alt="Profile" class="w-full h-full object-cover">
                        </div>
                        <span
                            class="text-ceara-white text-sm font-medium hidden sm:block"><?= $_SESSION['nome'] ?></span>
                        <i class="fas fa-chevron-down text-ceara-white text-sm transition-transform duration-300"></i>
                    </button>

                    <div id="dropdownMenu"
                        class="hidden absolute right-0 mt-2 w-48 bg-ceara-black/95 rounded-xl shadow-xl border border-ceara-gray/20">
                        <div class="p-4 border-b border-ceara-gray/20">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full overflow-hidden">
                                    <img src="https://api.dicebear.com/9.x/initials/svg?seed=<?= $_SESSION['nome'] ?>"
                                        alt="Profile" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-ceara-white"><?= $_SESSION['nome'] ?></p>
                                    <a href="perfil.php" class="text-xs text-secondary hover:text-secondary/80">Minha
                                        Conta</a>
                                </div>
                            </div>
                        </div>
                        <form method="post" action="">
                            <button type="submit" name="logout"
                                class="w-full flex items-center px-4 py-3 text-secondary hover:bg-ceara-gray/20 transition-colors duration-300">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                <span>Sair</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Enhanced Playlist Header -->
    <section class="playlist-gradient px-4 sm:px-8 py-12 sm:py-16">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col sm:flex-row items-center sm:items-end gap-8 sm:gap-12">
                <div
                    class="playlist-cover w-48 h-48 sm:w-56 sm:h-56 bg-gradient-to-br from-ceara-gray/20 to-ceara-gray/5 rounded-2xl shadow-2xl flex items-center justify-center group">
                    <i
                        class="fas fa-music text-6xl text-ceara-white/60 group-hover:text-secondary transition-colors duration-300"></i>
                </div>
                <div class="flex flex-col items-center sm:items-start">
                    <span class="text-secondary/80 text-sm font-medium uppercase tracking-widest">Playlist</span>
                    <h1 class="text-5xl sm:text-6xl font-bold text-ceara-white mt-3 mb-6"><?= $_GET['nome_playlist'] ?>
                    </h1>
                    <div class="flex items-center gap-6 text-ceara-gray">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full overflow-hidden ring-2 ring-secondary/20">
                                <img src="https://api.dicebear.com/9.x/initials/svg?seed=<?= $_SESSION['nome'] ?>"
                                    alt="Profile" class="w-full h-full object-cover">
                            </div>
                            <span class="text-sm font-medium"><?= $_SESSION['nome'] ?></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-music text-secondary/60"></i>
                            <span class="text-sm"><?= $total_musicas['linhas'] ?> músicas</span>
                        </div>
                        <div class="hidden sm:flex items-center gap-2">
                            <i class="far fa-clock text-secondary/60"></i>
                            <span class="text-sm"><?= $tempo_total ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-8 py-8">
        <!-- Enhanced Controls -->
        <div class="flex items-center gap-6 mb-12">
            <button
                class="control-button w-16 h-16 flex items-center justify-center bg-secondary hover:bg-secondary/90 rounded-full shadow-lg shadow-secondary/20 transform hover:scale-105 transition-all duration-300">
                <i class="fas fa-play text-white text-xl"></i>
            </button>
            <button
                class="control-button w-12 h-12 flex items-center justify-center bg-ceara-gray/20 hover:bg-ceara-gray/30 rounded-full text-2xl text-ceara-white hover:text-secondary transition-all duration-300">
                <i class="far fa-heart"></i>
            </button>
            <button
                class="control-button w-12 h-12 flex items-center justify-center bg-ceara-gray/20 hover:bg-ceara-gray/30 rounded-full text-xl text-ceara-white hover:text-secondary transition-all duration-300">
                <i class="fas fa-ellipsis"></i>
            </button>
        </div>

        <!-- Enhanced Songs List -->
        <div class="space-y-2">
            <!-- Table Header -->
            <div class="hidden sm:grid grid-cols-12 gap-4 px-6 py-4 text-ceara-gray text-sm font-medium">
                <div class="col-span-1">#</div>
                <div class="col-span-5">Título</div>
                <div class="col-span-3">Álbum</div>
                <div class="col-span-2"></div>
                <div class="col-span-1 text-right"><i class="far fa-clock"></i></div>
            </div>

            <!-- Enhanced Songs -->
            <?php foreach ($view_musica as $index => $musica) { ?>
                <div class="song-hover grid grid-cols-12 gap-4 px-6 py-4 rounded-xl group">
                    <div class="col-span-1 flex items-center text-ceara-gray">
                        <span class="group-hover:hidden"><?= $index + 1 ?></span>
                        <button class="play-button hidden group-hover:block text-secondary">
                            <i class="fas fa-play"></i>
                        </button>
                    </div>
                    <div class="col-span-5 flex items-center gap-4">
                        <div class="w-10 h-10 flex-shrink-0 bg-ceara-gray/20 rounded-lg flex items-center justify-center">
                            <i
                                class="fas fa-music text-ceara-white/60 group-hover:text-secondary transition-colors duration-300"></i>
                        </div>
                        <div>
                            <p
                                class="font-medium text-ceara-white group-hover:text-secondary transition-colors duration-300">
                                <?= $musica['nome_musica'] ?></p>
                            <p class="text-sm text-ceara-gray"><?= $musica['cantor'] ?></p>
                        </div>
                    </div>
                    <div class="col-span-3 flex items-center text-ceara-gray"><?= $musica['album'] ?></div>
                    <div class="col-span-2 flex items-center text-ceara-gray"></div>
                    <div class="col-span-1 flex items-center justify-end gap-4">
                        <button
                            class="opacity-0 group-hover:opacity-100 text-ceara-white hover:text-secondary transition-all duration-300">
                            <i class="far fa-heart"></i>
                        </button>
                        <span
                            class="text-ceara-gray"><?= sprintf("%02d:%02d", floor($musica['tempo']), round(($musica['tempo'] - floor($musica['tempo'])) * 60)) ?></span>
                    </div>
                </div>
            <?php } ?>
            <div class="mt-16 border-t border-ceara-gray/20 pt-12">
                <div class="max-w-3xl mx-auto">
                    <div class="add-music-section rounded-2xl overflow-hidden">
                        <form action="../controllers/controller_playlist.php" method="post" class="p-8">
                            <input type="hidden" name="id_usuario" value="<?= $_SESSION['id'] ?>">
                            <input type="hidden" name="nome_playlist" value="<?= $_GET['nome_playlist'] ?>">

                            <div class="flex flex-col items-center gap-8">
                                <!-- Header -->
                                <div class="flex items-center gap-4 text-ceara-white">
                                    <div
                                        class="w-14 h-14 rounded-full bg-secondary/10 flex items-center justify-center">
                                        <i class="fas fa-plus-circle text-3xl text-secondary"></i>
                                    </div>
                                    <h3 class="text-2xl font-semibold">Adicionar músicas</h3>
                                </div>

                                <?php if (isset($_GET['erro'])) { ?>

                                    <p>Músicas já adicionadas!</p>
                                <?php } ?>
                                <!-- Dropdown Personalizado -->
                                <div class="relative w-full">
                                    <div id="musicDropdown" class="custom-dropdown">
                                        <div
                                            class="dropdown-header flex justify-between items-center bg-ceara-black/50 rounded-xl px-4 py-3.5 border-2 border-ceara-gray/30">
                                            <span id="dropdownText" class="text-ceara-white">Selecione as músicas</span>
                                            <i class="fas fa-chevron-down text-ceara-white"></i>
                                        </div>
                                        <div id="dropdownOptions"
                                            class="hidden absolute z-10 w-full bg-ceara-black rounded-xl mt-2 max-h-64 overflow-y-auto">
                                            <div class="p-2">
                                                <input type="text" id="searchInput" placeholder="Pesquisar músicas..."
                                                    class="w-full bg-ceara-gray/30 rounded-lg px-3 py-2 mb-2 text-ceara-white">
                                                <?php foreach ($lista_musica as $musica) { ?>
                                                    <label
                                                        class="flex items-center px-3 py-2 hover:bg-ceara-gray/20 rounded-lg cursor-pointer">
                                                        <input type="checkbox" name="add_musica[]"
                                                            value="<?= $musica['nome_musica'] ?>"
                                                            class="mr-3 custom-checkbox">
                                                        <span class="text-ceara-white"><?= $musica['nome_musica'] ?></span>
                                                    </label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="selectedItems" class="flex flex-wrap gap-2 mt-2"></div>
                                </div>

                                <!-- Botão de Submissão -->
                                <button type="submit" class="group relative px-8 py-4 bg-secondary hover:bg-secondary/90 
                                       text-white font-medium rounded-full 
                                       transition-all duration-300 transform hover:scale-105 
                                       shadow-lg hover:shadow-secondary/20
                                       flex items-center gap-3">
                                    <i class="fas fa-plus group-hover:rotate-90 transition-transform duration-300"></i>
                                    <span>Adicionar à playlist</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </main>

    <script>
        // Script para dropdown e outros elementos
        document.addEventListener('DOMContentLoaded', function() {
            // Dropdown do menu de usuário
            const dropdownButton = document.getElementById('dropdownButton');
            const dropdownMenu = document.getElementById('dropdownMenu');

            dropdownButton.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
                dropdownMenu.classList.toggle('active');
                dropdownButton.classList.toggle('active');
            });

            document.addEventListener('click', function(e) {
                if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                    dropdownMenu.classList.remove('active');
                    dropdownButton.classList.remove('active');
                }
            });

            // Dropdown de seleção de músicas
            const dropdown = document.getElementById('musicDropdown');
            const dropdownHeader = dropdown.querySelector('.dropdown-header');
            const dropdownOptions = document.getElementById('dropdownOptions');
            const searchInput = document.getElementById('searchInput');
            const selectedItemsContainer = document.getElementById('selectedItems');
            const dropdownText = document.getElementById('dropdownText');

            // Toggle dropdown
            dropdownHeader.addEventListener('click', function() {
                dropdownOptions.classList.toggle('hidden');
            });

            // Fechar dropdown ao clicar fora
            document.addEventListener('click', function(event) {
                if (!dropdown.contains(event.target)) {
                    dropdownOptions.classList.add('hidden');
                }
            });

            // Funcionalidade de busca
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const checkboxes = dropdownOptions.querySelectorAll('label');

                checkboxes.forEach(label => {
                    const text = label.textContent.toLowerCase();
                    label.style.display = text.includes(searchTerm) ? 'flex' : 'none';
                });
            });

            // Manipular seleção de checkbox
            const checkboxes = dropdownOptions.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectedItems();
                });
            });

            function updateSelectedItems() {
                // Limpar seleções anteriores
                selectedItemsContainer.innerHTML = '';

                // Obter todos os checkboxes marcados
                const selectedCheckboxes = dropdownOptions.querySelectorAll('input[type="checkbox"]:checked');

                // Atualizar exibição de itens selecionados
                selectedCheckboxes.forEach(checkbox => {
                    const selectedItem = document.createElement('span');
                    selectedItem.classList.add('bg-secondary', 'text-white', 'px-3', 'py-1', 'rounded-full', 'text-sm', 'flex', 'items-center');
                    selectedItem.innerHTML = `
                        ${checkbox.nextElementSibling.textContent}
                        <button class="ml-2 remove-item" data-value="${checkbox.value}">×</button>
                    `;
                    selectedItemsContainer.appendChild(selectedItem);
                });

                // Atualizar texto do dropdown
                dropdownText.textContent = selectedCheckboxes.length > 0 ?
                    `${selectedCheckboxes.length} músicas selecionadas` :
                    'Selecione as músicas';

                // Adicionar funcionalidade de remover item
                const removeButtons = selectedItemsContainer.querySelectorAll('.remove-item');
                removeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const valueToRemove = this.getAttribute('data-value');
                        const checkbox = dropdownOptions.querySelector(`input[value="${valueToRemove}"]`);
                        checkbox.checked = false;
                        updateSelectedItems();
                    });
                });
            }
        });
    </script>
</body>

</html>