<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanPro - @yield('Title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar {
            transition: all 0.3s ease;
        }

        .sidebar-collapsed {
            width: 80px;
        }

        .menu-item {
            transition: all 0.2s ease;
        }

        .menu-item:hover {
            background: rgba(102, 126, 234, 0.1);
            border-left: 4px solid #667eea;
        }

        .menu-item.active {
            background: rgba(102, 126, 234, 0.15);
            border-left: 4px solid #667eea;
            color: #667eea;
        }

        .tab-button {
            transition: all 0.3s ease;
        }

        .tab-button.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hover-scale {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-scale:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .8; }
        }
    </style>
    <link rel="stylesheet" href="css/Components.css">
    @yield('CssSection')
</head>
<body class="bg-gray-50">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        @include('layouts.components.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Header -->
            @include('layouts.components.header')

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto no-scrollbar bg-gray-50 p-8">
                @yield('MainContentArea')
                @include('layouts.components.modal')
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Components.js"></script>
    <script src="js/Crud.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Tab Switching
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabPanes = document.querySelectorAll('.tab-pane');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetTab = button.getAttribute('data-tab');

                // Remove active class from all buttons
                tabButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.classList.add('text-gray-600', 'hover:bg-gray-100');
                });

                // Add active class to clicked button
                button.classList.add('active');
                button.classList.remove('text-gray-600', 'hover:bg-gray-100');

                // Hide all tab panes
                tabPanes.forEach(pane => {
                    pane.style.display = 'none';
                    pane.classList.remove('active');
                });

                // Show target tab pane
                const targetPane = document.getElementById(targetTab);
                targetPane.style.display = 'block';
                targetPane.classList.add('active');
            });
        });

        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');

            const sidebarTexts = document.querySelectorAll('.sidebar-text');
            sidebarTexts.forEach(text => {
                text.style.display = sidebar.classList.contains('sidebar-collapsed') ? 'none' : 'inline';
            });
        });

        // Auto calculate total in Tambah Order form
        const beratInput = document.querySelector('#tambah-order input[type="number"]');
        const layananSelect = document.querySelector('#tambah-order select');

        if (beratInput && layananSelect) {
            const updateTotal = () => {
                const selectedOption = layananSelect.options[layananSelect.selectedIndex].text;
                const priceMatch = selectedOption.match(/Rp ([\d,.]+)/);

                if (priceMatch && beratInput.value) {
                    const price = parseInt(priceMatch[1].replace(/\./g, ''));
                    const berat = parseFloat(beratInput.value);
                    const subtotal = price * berat;

                    // Update subtotal display
                    const subtotalElement = document.querySelector('#tambah-order .space-y-3 .flex:first-child span:last-child');
                    const totalElement = document.querySelector('#tambah-order .gradient-text');

                    if (subtotalElement && totalElement) {
                        subtotalElement.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
                        totalElement.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
                    }
                }
            };

            beratInput.addEventListener('input', updateTotal);
            layananSelect.addEventListener('change', updateTotal);
        }

        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Add animation on load
        window.addEventListener('load', () => {
            document.querySelectorAll('.hover-scale').forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(20px)';
                    el.style.transition = 'all 0.5s ease';

                    setTimeout(() => {
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    }, 50);
                }, index * 100);
            });
        });
    </script>
    @yield('JavascriptSection')
</body>
</html>
