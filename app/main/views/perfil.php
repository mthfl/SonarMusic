<?php
require_once('../models/sessions.php');
require_once('../models/model.php');
$model = new model();
$result = $model->data_senha($_SESSION['email']);
$data = $result === NULL ? "Nunca" : $result;
$session = new sessions();
$session->tempo_session(600);
$session->autenticar_session();

if (isset($_POST['logout'])) {
    $session->quebra_session();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Meu Perfil</title>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ceara: {
                            black: '#0f0d13',
                            gray: '#3a393d',
                            white: '#fdfcfe',
                            base: '#1b191f',
                            darkblue: '#1e2440',
                        },
                        accent: {
                            DEFAULT: '#EF4444',
                            hover: '#dc2626',
                        },
                    },
                    boxShadow: {
                        'neon': '0 0 15px rgba(239, 68, 68, 0.4)',
                    },
                    fontFamily: {
                        'noto': ['Noto Sans', 'sans-serif'],
                        'anton': ['Anton', 'serif'],
                        'inter': ['Inter', 'sans-serif'],
                    },
                },
            },
            darkMode: 'class',
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');

        .profile-card {
            transition: all 0.3s ease;
            background: linear-gradient(145deg, rgba(58, 57, 61, 0.5), rgba(27, 25, 31, 0.8));
            border: 1px solid rgba(58, 57, 61, 0.2);
        }

        .profile-card:hover {

            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-ceara-black via-ceara-base to-ceara-black min-h-screen text-ceara-white font-inter select-none">
    <div class="container mx-auto px-4 py-8">
        <nav
            class="flex justify-between items-center mb-12 bg-ceara-darkblue/50 backdrop-blur-md rounded-2xl p-4 shadow-lg">
            <div class="flex items-center gap-4">

                <h1 class="text-4xl font-anton tracking-wider text-accent flex items-center gap-4">
                    <i class="fas fa-user-circle"></i>
                    Meu Perfil
                </h1>
            </div>
            
        </nav>

        <main class="max-w-5xl mx-auto">
            <div class="grid md:grid-cols-3 gap-8">
            
                <div class="md:col-span-1 bg-ceara-darkblue/50 backdrop-blur-md rounded-3xl p-6 profile-card">
                    <div class="text-center">
                        <img src="https://api.dicebear.com/9.x/initials/svg?seed=<?= $_SESSION['nome'] ?>"
                            alt="Foto de Perfil" class="mx-auto rounded-full w-48 h-48 mb-6 
                                     shadow-xl 
                                    transition-transform duration-300 ">

                        <h2 class="text-3xl font-bold mb-2 font-anton tracking-wide"><?= $_SESSION['nome'] ?></h2>
                        <p class="text-gray-400 mb-4"><?= $_SESSION['email'] ?></p>

                        <div class="flex justify-center gap-4 mb-6">
                            <a href="home_page.php"
                                class="text-white hover:text-accent transition-colors duration-300 mr-4">
                                <i class="fas fa-arrow-left text-2xl"></i>
                                </a>
                        </div>
                    </div>
                </div>

       
                <div class="md:col-span-2 space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="bg-ceara-darkblue/50 backdrop-blur-md rounded-2xl p-6 profile-card">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-semibold text-accent">Informações Pessoais</h3>
                                <button onclick="editEmail()" class="text-gray-400 hover:text-accent">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                            <p><strong>Email:</strong> <?= $_SESSION['email'] ?></p>
                            <?php
                            date_default_timezone_set('America/Sao_Paulo');
                            ?>
                            <p><strong>Último Acesso:</strong> <?= date('d/m/Y H:i') ?></p>
                            <?php if (isset($_GET['email_true'])) { ?>
                                <p>Email alterado com sucesso!</p>
                            <?php } ?>
                        </div>

                        <div class="bg-ceara-darkblue/50 backdrop-blur-md rounded-2xl p-6 profile-card">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-semibold text-accent">Segurança</h3>
                                <button onclick="editSenha()" class="text-gray-400 hover:text-accent">
                                    <i class="fas fa-lock"></i>
                                </button>
                            </div>
                            <p><strong>Senha:</strong> <?= str_repeat('•', strlen($_SESSION['senha'])) ?></p>
                            <p class="text-sm text-gray-400">Última alteração: <?=$data?></p>
                            <?php if (isset($_GET['senha_atual_erro'])) { ?>
                                <p>Senha atual incorreta! Tente novamente.</p>
                            <?php } ?>
                            <?php if (isset($_GET['senha_nova_erro'])) { ?>
                                <p>Senhas não condizem! Tente novamente.</p>
                            <?php } ?>
                            <?php if (isset($_GET['senha_true'])) { ?>
                                <p>Senha alterada com sucesso!</p>
                            <?php } ?>
                            <?php if (isset($_GET['senha_erro'])) { ?>
                                <p>[ERRO] Ao alterar a senha.</p>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="bg-ceara-darkblue/50 backdrop-blur-md rounded-2xl p-6 profile-card">
                        <div class="flex items-center gap-3 mb-2">
                            <i class="fas fa-signal text-accent text-xl"></i>
                            <p class="font-medium">Status</p>
                        </div>
                        <p class="flex items-center gap-2">
                            <span class="inline-block w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                            Online
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>


    <div id="emailModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center backdrop-blur-sm">
        <div class="bg-ceara-base p-6 rounded-2xl w-full max-w-md mx-4 shadow-2xl">
            <h3 class="text-2xl font-bold mb-6 text-ceara-white font-anton">Editar Email</h3>
            <form action="../controllers/controller_perfil.php" method="POST" class="space-y-4">
                <input type="hidden" name="nome" value="<?= $_SESSION['nome'] ?>">
                <input type="email" name="new_email"
                    class="w-full p-3 rounded-xl bg-ceara-gray border border-ceara-gray/50 
                           text-ceara-white placeholder-gray-400 focus:ring-2 focus:ring-accent 
                           focus:border-transparent outline-none transition-all duration-300"
                    placeholder="Novo email" required>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeEmailModal()"
                        class="px-6 py-2.5 rounded-xl bg-ceara-gray text-ceara-white 
                               hover:bg-ceara-gray/80 transition-colors duration-300">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-accent text-ceara-white 
                               hover:bg-red-600 transition-colors duration-300">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="senhaModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center backdrop-blur-sm">
        <div class="bg-ceara-base p-6 rounded-2xl w-full max-w-md mx-4 shadow-2xl">
            <h3 class="text-2xl font-bold mb-6 text-ceara-white font-anton">Editar Senha</h3>
            <form action="../controllers/controller_perfil.php" method="POST" class="space-y-4">
                <input type="hidden" name="email" value="<?= $_SESSION['email'] ?>">
                <input type="password" name="current_password"
                    class="w-full p-3 rounded-xl bg-ceara-gray border border-ceara-gray/50 
                           text-ceara-white placeholder-gray-400 focus:ring-2 focus:ring-accent 
                           focus:border-transparent outline-none transition-all duration-300"
                    placeholder="Senha atual" required>
                <input type="password" name="new_password"
                    class="w-full p-3 rounded-xl bg-ceara-gray border border-ceara-gray/50 
                           text-ceara-white placeholder-gray-400 focus:ring-2 focus:ring-accent 
                           focus:border-transparent outline-none transition-all duration-300"
                    placeholder="Nova senha" required>
                <input type="password" name="confirm_password"
                    class="w-full p-3 rounded-xl bg-ceara-gray border border-ceara-gray/50 
                           text-ceara-white placeholder-gray-400 focus:ring-2 focus:ring-accent 
                           focus:border-transparent outline-none transition-all duration-300"
                    placeholder="Confirme a nova senha" required>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeSenhaModal()"
                        class="px-6 py-2.5 rounded-xl bg-ceara-gray text-ceara-white 
                               hover:bg-ceara-gray/80 transition-colors duration-300">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-accent text-ceara-white 
                               hover:bg-red-600 transition-colors duration-300">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editEmail() {
            document.getElementById('emailModal').style.display = 'flex';
        }

        function closeEmailModal() {
            document.getElementById('emailModal').style.display = 'none';
        }

        function editSenha() {
            document.getElementById('senhaModal').style.display = 'flex';
        }

        function closeSenhaModal() {
            document.getElementById('senhaModal').style.display = 'none';
        }
    </script>
</body>

</html>