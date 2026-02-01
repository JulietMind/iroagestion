<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Iroa Gestión</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
<style>
:root { --bg-body: #0f172a; --primary: #d4af37; --bg-card: #1e293b; --text-main: #f1f5f9; --text-muted: #94a3b8; }
body { font-family: 'Inter', sans-serif; background: var(--bg-body); color: var(--text-main); margin: 0; padding-top: 80px; }
a { text-decoration: none; color: inherit; transition: 0.3s; }

header { position: fixed; top: 0; width: 100%; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px); z-index: 1000; border-bottom: 1px solid rgba(255,255,255,0.05); }
.container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
nav { display: flex; justify-content: space-between; align-items: center; height: 80px; }
.logo { font-size: 1.5rem; font-weight: 800; color: white; display: flex; align-items: center; gap: 10px; }
.logo img { height: 50px; width: auto; }
.nav-links { display: flex; gap: 30px; list-style: none; margin: 0; padding: 0; }
.nav-links a { color: var(--text-muted); font-weight: 500; cursor: pointer; }
.nav-links a:hover { color: var(--primary); }

/* Botones Globales */
.btn { display: inline-block; padding: 10px 20px; border-radius: 50px; border: none; font-weight: 600; cursor: pointer; transition: 0.3s; background: var(--primary); color: #000; text-align: center; }
.btn:hover { box-shadow: 0 0 15px rgba(212, 175, 55, 0.4); }
.btn-outline { background: transparent; border: 2px solid var(--primary); color: var(--primary); }
.btn-outline:hover { background: var(--primary); color: black; }
.btn-edit { background: var(--primary); color: black; padding: 5px 10px; border: none; border-radius: 4px; margin-right: 5px; cursor: pointer; }
.btn-del { background: #ef4444; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; }

/* Estilos Pro para Tarjetas */
.project-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; }
.project-card { background: var(--bg-card); border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.05); transition: 0.3s; display: flex; flex-direction: column; height: 100%; }
.project-card:hover { transform: translateY(-5px); border-color: rgba(212, 175, 55, 0.3); }
.card-image-wrapper { position: relative; height: 220px; overflow: hidden; }
.card-image-wrapper img { width: 100%; height: 100%; object-fit: cover; }
.card-badge { position: absolute; top: 15px; left: 15px; background: rgba(0,0,0,0.6); color: var(--primary); padding: 6px 12px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; backdrop-filter: blur(8px); }
.card-body { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; }
.project-title { font-size: 1.25rem; font-weight: 700; color: white; margin: 0 0 10px; }
.project-location { display: flex; align-items: center; gap: 6px; color: var(--text-muted); font-size: 0.85rem; margin-bottom: 20px; }
.metrics-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; background: rgba(0,0,0,0.2); border-radius: 12px; padding: 15px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.03); }
.metric { text-align: center; border-right: 1px solid rgba(255,255,255,0.05); }
.metric:last-child { border-right: none; }
.metric-label { display: block; font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 4px; }
.metric-value { display: block; font-size: 1rem; font-weight: 700; color: white; }
.metric-value.gold { color: var(--primary); }
.progress-section { margin-top: auto; }
.progress-header { display: flex; justify-content: space-between; font-size: 0.8rem; color: var(--text-muted); margin-bottom: 8px; }
.progress-track { width: 100%; height: 6px; background: rgba(255,255,255,0.1); border-radius: 4px; overflow: hidden; }
.progress-fill { height: 100%; background: linear-gradient(90deg, var(--primary), #FCD34D); width: 0%; }
.card-btn { margin-top: 20px; width: 100%; background: linear-gradient(135deg, var(--primary), #b5952f); color: #000; font-weight: 700; border: none; padding: 12px; border-radius: 8px; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 8px; }

@media(max-width: 768px) { .nav-links { display: none; } }
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
<li><a href="oportunidades.php">Oportunidades</a></li>
<li><a href="sobre-nosotros.php">Sobre nosotros</a></li>
<li><a href="blog.php">Blog</a></li>
</ul>
</nav>
</div>
</header>
