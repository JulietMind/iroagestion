<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iroa Gestión</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <style>
        :root { --bg-body: #0f172a; --primary: #d4af37; --accent: #38bdf8; --text-main: #f1f5f9; --text-muted: #94a3b8; --bg-card: #1e293b; }
        body { font-family: 'Inter', sans-serif; background: var(--bg-body); color: var(--text-main); margin: 0; padding-top: 80px; }
        a { text-decoration: none; color: inherit; transition: 0.3s; }

        header { position: fixed; top: 0; width: 100%; background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(10px); z-index: 1000; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        nav { display: flex; justify-content: space-between; align-items: center; height: 80px; }
        .logo { font-size: 1.5rem; font-weight: 800; color: white; display: flex; align-items: center; gap: 10px; }
        .logo img { height: 50px; width: auto; }
        .nav-links { display: flex; gap: 30px; list-style: none; margin: 0; padding: 0; }
        .nav-links a { color: var(--text-muted); font-weight: 500; cursor: pointer; }
        .nav-links a:hover { color: var(--primary); }
        .nav-actions { display: flex; gap: 15px; align-items: center; }

        .btn { display: inline-block; padding: 10px 20px; border-radius: 50px; border: none; font-weight: 600; cursor: pointer; transition: 0.3s; background: var(--primary); color: #000; text-align: center; }
        .btn:hover { box-shadow: 0 0 15px rgba(212, 175, 55, 0.4); }
        .btn-outline { background: transparent; border: 2px solid var(--primary); color: var(--primary); }
        .btn-outline:hover { background: var(--primary); color: black; }

        @media(max-width: 768px) { .nav-links { display: none; } }

        /* --- ESTILOS PRO TARJETAS (AJUSTADO) --- */

        .project-grid {
            display: grid;
            /* CAMBIO: minmax(320px, 1fr) para evitar descuadre en pantallas medianas */
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
            /* Asegura que las tarjetas llenen la fila */
            align-items: stretch;
        }

        .project-card {
            background: var(--bg-card);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.05);
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
            height: 100%; /* Importante para el alineado */
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.4);
            border-color: rgba(212, 175, 55, 0.3);
        }

        .card-image-wrapper {
            position: relative;
            height: 220px; /* Altura fija para alineación */
            overflow: hidden;
            width: 100%;
        }
        .card-image-wrapper img {
            width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;
        }
        .project-card:hover .card-image-wrapper img { transform: scale(1.05); }

        .card-badge {
            position: absolute; top: 15px; left: 15px;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary);
            border: 1px solid rgba(255,255,255,0.1);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-body { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; }

        .project-title {
            font-size: 1.25rem; font-weight: 700; color: white; margin: 0 0 10px 0;
            line-height: 1.3; font-family: 'Inter', sans-serif;
        }

        .project-location {
            display: flex; align-items: center; gap: 6px; color: var(--text-muted);
            font-size: 0.85rem; margin-bottom: 20px;
        }

        .metrics-grid {
            display: grid; grid-template-columns: 1fr 1fr 1fr;
            background: rgba(0,0,0,0.2);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid rgba(255,255,255,0.03);
        }
        .metric { text-align: center; border-right: 1px solid rgba(255,255,255,0.05); }
        .metric:last-child { border-right: none; }

        .metric-label {
            display: block; font-size: 0.65rem; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;
        }
        .metric-value {
            display: block; font-size: 1rem; font-weight: 700; color: white;
        }
        .metric-value.gold { color: var(--primary); }

        .progress-section { margin-top: auto; }
        .progress-header {
            display: flex; justify-content: space-between; font-size: 0.8rem;
            margin-bottom: 8px; color: var(--text-muted);
        }
        .progress-track {
            width: 100%; height: 6px; background: rgba(255,255,255,0.1);
            border-radius: 4px; overflow: hidden;
        }
        .progress-fill {
            height: 100%; background: linear-gradient(90deg, var(--primary), #FCD34D);
            border-radius: 4px; position: relative;
        }
        .progress-fill::after {
            content: ''; position: absolute; top: 0; right: 0; bottom: 0;
            width: 2px; background: white; opacity: 0.5;
        }

        .card-btn {
            margin-top: 20px; width: 100%;
            background: linear-gradient(135deg, var(--primary), #b5952f);
            color: #000; font-weight: 700; border: none; padding: 12px;
            border-radius: 8px; cursor: pointer; transition: 0.3s;
            display: flex; justify-content: center; align-items: center; gap: 8px;
            font-size: 0.9rem;
        }
        .card-btn:hover { box-shadow: 0 0 20px rgba(212, 175, 55, 0.3); }
    </style>
</head>
<body>

    <header>
        <div class="container">
            <nav>
                <a href="index.php" class="logo">
                    <img src="https://z-cdn-media.chatglm.cn/files/25712ad8-87b4-42f4-a0fe-89352f5b583f.jpg?auth_key=1868784953-eeade0e70eb94f768c345d3ef2e48c50-0-ec6c7371f7d633278686edf25fa96038" alt="Logo">
                </a>

                <ul class="nav-links">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="sobre-nosotros.php">Sobre Nosotros</a></li>
                    <li><a href="como-funciona.php">Cómo Funciona</a></li>
                    <li><a href="oportunidades.php">Oportunidades</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="ayuda.php">Ayuda</a></li>
                </ul>

                <div class="nav-actions">
                    <a href="gestion.php" class="btn">⚙️ Acceso Gestión</a>
                </div>
            </nav>
        </div>
    </header>
