<?php include 'header.php'; ?>
<script src="backend.js"></script>
<style>
.article-header { text-align: center; max-width: 800px; margin: 40px auto; }
.article-content { max-width: 800px; margin: 0 auto; padding: 40px; background: var(--bg-card); border-radius: 12px; color: #e2e8f0; line-height: 1.8; }
</style>
<div class="container">
<div class="article-header">
<span id="article-date" style="color: var(--primary); font-weight: bold;">...</span>
<h1 id="article-title" style="color: white;">Cargando...</h1>
</div>
<div id="article-body" class="article-content"></div>
<div style="text-align: center; margin: 40px 0;"><a href="blog.php" class="btn btn-outline">Volver</a></div>
</div>
<script>app.loadBlogDetail();</script>
<?php include 'footer.php'; ?>
