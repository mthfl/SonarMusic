<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Sonar - cliente</title>
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

        function toggleForm(formType) {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const loginTab = document.getElementById('loginTab');
            const registerTab = document.getElementById('registerTab');

            if (formType === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                loginTab.classList.add('bg-secondary');
                registerTab.classList.remove('bg-secondary');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                loginTab.classList.remove('bg-secondary');
                registerTab.classList.add('bg-secondary');
            }
        }

        function goBack() {
            window.history.back();
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');

        .form-transition {
            transition: all 0.3s ease-in-out;
        }

        .input-field {
            transition: all 0.2s ease;
        }

        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        .btn-hover {
            transition: all 0.3s ease;
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .title-glow {
            text-shadow: 0 0 10px rgba(239, 68, 68, 0.3);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-ceara-black to-ceara text-ceara-white min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md p-8 bg-ceara rounded-lg shadow-2xl backdrop-blur-sm bg-opacity-95 transform transition-all duration-300 relative">
        <a href="../index.php" class="absolute top-4 left-4 text-gray-400 hover:text-secondary transition-colors duration-300">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>

        <h1 class="text-5xl text-center mb-8 font-bold title-glow tracking-wider" style="font-family: 'Anton', serif;">
            SONAR
        </h1>

        <div class="flex mb-6 bg-ceara-gray rounded-lg p-1">
            <button id="loginTab" onclick="toggleForm('login')" class="w-1/2 py-3 bg-secondary rounded-lg font-semibold transform transition-all duration-300 hover:shadow-lg">
                Entrar
            </button>
            <button id="registerTab" onclick="toggleForm('register')" class="w-1/2 py-3 rounded-lg font-semibold transform transition-all duration-300 hover:shadow-lg">
                Cadastrar
            </button>
        </div>
        
        <form id="loginForm" class="space-y-5 form-transition fade-in" action="../controllers/controller_autenticacao.php" method="post">
            <div class="relative">
                <input type="email" placeholder="E-mail" required class="input-field w-full p-4 bg-ceara-gray rounded-lg pl-12 focus:outline-none focus:ring-2 focus:ring-secondary border border-transparent hover:border-secondary/30" name="email">
                <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-secondary"></i>
            </div>
            <div class="relative">
                <input type="password" placeholder="Senha" required class="input-field w-full p-4 bg-ceara-gray rounded-lg pl-12 focus:outline-none focus:ring-2 focus:ring-secondary border border-transparent hover:border-secondary/30" name="senha">
                <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-secondary"></i>
            </div>
            <button type="submit" class="btn-hover w-full bg-secondary py-4 rounded-lg font-semibold hover:bg-opacity-90 transition-all duration-300">
                Entrar
            </button>
            <p class="text-center text-sm">
                <a href="#" class="text-secondary hover:text-secondary/80 transition-colors duration-300 hover:underline">
                    Esqueceu sua senha?
                </a>
            </p>
            <?php if (isset($_GET['erro'])) { ?>
                <p class="text-ceara-white  text-center">Email ou senha incorretos!</p>
            <?php } ?>
        </form>

        <form id="registerForm" class="space-y-5 hidden form-transition fade-in" action="../controllers/controller_autenticacao.php" method="post">
            <div class="relative">
                <input type="text" placeholder="Nome Completo" required class="input-field w-full p-4 bg-ceara-gray rounded-lg pl-12 focus:outline-none focus:ring-2 focus:ring-secondary border border-transparent hover:border-secondary/30" name="nome">
                <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-secondary"></i>
            </div>
            <div class="relative">
                <input type="email" placeholder="E-mail" required class="input-field w-full p-4 bg-ceara-gray rounded-lg pl-12 focus:outline-none focus:ring-2 focus:ring-secondary border border-transparent hover:border-secondary/30" name="email">
                <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-secondary"></i>
            </div>
            <div class="relative">
                <input type="password" placeholder="Senha" required class="input-field w-full p-4 bg-ceara-gray rounded-lg pl-12 focus:outline-none focus:ring-2 focus:ring-secondary border border-transparent hover:border-secondary/30" name="senha">
                <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-secondary"></i>
            </div>
            <div class="relative">
                <input type="password" placeholder="Confirmar Senha" required class="input-field w-full p-4 bg-ceara-gray rounded-lg pl-12 focus:outline-none focus:ring-2 focus:ring-secondary border border-transparent hover:border-secondary/30" name="confirmar_senha">
                <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-secondary"></i>
            </div>
            <button type="submit" class="btn-hover w-full bg-secondary py-4 rounded-lg font-semibold hover:bg-opacity-90 transition-all duration-300">
                Cadastrar
            </button>
            <?php if (isset($_GET['false'])) { ?>
                <p class="text-ceara-white  text-center">Senhas não condizem!</p>
            <?php } ?>
            <?php if (isset($_GET['ja_existe'])) { ?>
                <p class="text-ceara-white text-center">Email ou nome já cadastrado!</p>
            <?php } ?>
            <?php if (isset($_GET['fatal'])) { ?>
                <p class="text-ceara-white  text-center">Erro ao cadastrar!</p>
            <?php } ?>
            <?php if (isset($_GET['cadastrado'])) { ?>
                <p class="text-green-500 text-center">Cadastro realizado com sucesso!</p>
            <?php } ?>
        </form>
    </div>

    <script>
        function toggleForm(formType) {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const loginTab = document.getElementById('loginTab');
            const registerTab = document.getElementById('registerTab');

            if (formType === 'login') {
                registerForm.classList.add('hidden');
                loginForm.classList.remove('hidden');
                loginForm.classList.add('fade-in');
                loginTab.classList.add('bg-secondary');
                registerTab.classList.remove('bg-secondary');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                registerForm.classList.add('fade-in');
                loginTab.classList.remove('bg-secondary');
                registerTab.classList.add('bg-secondary');
            }
        }
    </script>
</body>

</html>
