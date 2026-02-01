const app = {
  data: { properties: [], posts: [] },

  init: async function() {
    try {
      // Evitamos recargar si ya cargamos datos (para cuando usamos el botón atrás)
      if(this.data.properties.length > 0) return;

      const response = await fetch('api.php?action=get_all&t=' + Date.now());
      const text = await response.text();

      if (!text) throw new Error("Respuesta vacía del servidor");

      this.data = JSON.parse(text);

      // Renderizar grids de listas
      this.renderFeatured(); // Para index.php
      this.renderCatalog();  // Para oportunidades.php
      this.renderBlog();     // Para blog.php
      this.renderAdmin();     // Para gestion.php

    } catch (error) {
      console.error("Error:", error);
      alert("Error cargando datos.");
    }
  },

  // --- 1. HOME: Mostrar solo los 3 primeros ---
  renderFeatured: function() {
    const container = document.getElementById('featured-grid');
    if (!container) return;

    const items = this.data.properties.slice(0, 3);
    container.innerHTML = this.createCardsHTML(items);
  },

  // --- 2. OPORTUNIDADES: Mostrar todos ---
  renderCatalog: function() {
    const container = document.getElementById('catalog-grid');
    if (!container) return;

    const items = this.data.properties;
    container.innerHTML = this.createCardsHTML(items);
  },

  // --- 3. BLOG: Mostrar solo artículos ---
  renderBlog: function() {
    const container = document.getElementById('blog-grid');
    if (!container) return;

    container.innerHTML = this.data.posts.map(item => `
    <div class="post-card">
    <div class="card-image-wrapper" style="height: 200px;">
    <img src="${item.image}" alt="${item.title}">
    </div>
    <div class="card-body">
    <span style="color: var(--primary); font-size: 0.8rem; font-weight: bold;">${item.date}</span>
    <h3 style="color: white; margin: 10px 0; font-size: 1.2rem;">${item.title}</h3>
    <a href="articulo.php?id=${item.id}" class="btn btn-outline" style="margin-top: auto;">Leer Artículo</a>
    </div>
    </div>
    `).join('');
  },

  // --- 4. ADMIN PANEL ---
  renderAdmin: function() {
    const tbody = document.querySelector('#admin-table tbody');
    if (!tbody) return;

    tbody.innerHTML = this.data.properties.map(item => `
    <tr>
    <td><img src="${item.image}" alt="mini" style="width:50px; height:35px; object-fit:cover; border-radius:4px;"></td>
    <td>${item.title}</td>
    <td>${item.location}</td>
    <td>${item.profit}</td>
    <td>
    <button class="btn-edit" onclick="app.editProp(${item.id})">Editar</button>
    <button class="btn-del" onclick="app.deleteProp(${item.id})">Borrar</button>
    </td>
    </tr>
    `).join('');
  },

  // --- 5. GENERADOR DE TARJETAS ---
  createCardsHTML: function(items) {
    if(!items) return '';
    return items.map(item => `
    <div class="project-card">
    <div class="card-image-wrapper">
    <span class="card-badge">${item.badge}</span>
    <img src="${item.image}" alt="${item.title}">
    </div>
    <div class="card-body">
    <h3 class="project-title">${item.title}</h3>
    <div class="project-location">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
    ${item.location}
    </div>

    <div class="metrics-grid">
    <div class="metric"><span class="metric-label">Rentabilidad</span><span class="metric-value gold">${item.profit.split('/')[0]}</span></div>
    <div class="metric"><span class="metric-label">Duración</span><span class="metric-value">${item.duration.split(' ')[0]}m</span></div>
    <div class="metric"><span class="metric-label">Min. Inversión</span><span class="metric-value">${item.min}</span></div>
    </div>

    <div class="progress-section">
    <div class="progress-header"><span>Fondos Recaudados</span><span>${item.funded}</span></div>
    <div class="progress-track"><div class="progress-fill" style="width: ${item.progress}%;"></div></div>
    </div>

    <a href="ficha.php?id=${item.id}" class="card-btn">
    Ver Detalles
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
    </div>
    </div>
    `).join('');
  },

  // --- 6. NUEVAS FUNCIONES: CARGA DIRECTA (Para ficha.php y articulo.php) ---
  // Estas funciones piden solo UN dato específico al servidor, lo que es más rápido.

  fetchPropertyDetail: async function() {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    if(!id) {
      if(document.getElementById('detail-container')) document.getElementById('detail-container').innerHTML = '<p style="padding:20px; color:white;">ID de piso no especificado.</p>';
      return;
    }

    try {
      const response = await fetch('api.php?action=get_property&id=' + id);
      const item = await response.json();

      if (!item) {
        document.getElementById('detail-container').innerHTML = '<p style="padding:20px; color:white;">Piso no encontrado.</p>';
        return;
      }

      // Pintar datos
      document.getElementById('detail-image').src = item.image;
      document.getElementById('detail-title').innerText = item.title;
      document.getElementById('detail-location-text').innerText = item.location;
      document.getElementById('detail-profit').innerText = item.profit;
      document.getElementById('detail-duration').innerText = item.duration;
      document.getElementById('detail-min').innerText = item.min;
      document.getElementById('detail-desc').innerHTML = item.description || "Sin descripción.";
      document.getElementById('detail-progress').style.width = item.progress + "%";
      document.getElementById('detail-funded').innerText = item.funded;

    } catch (error) {
      console.error("Error cargando ficha:", error);
      if(document.getElementById('detail-container')) document.getElementById('detail-container').innerHTML = '<p style="padding:20px; color:#ef4444;">Error al cargar los datos.</p>';
    }
  },

  fetchBlogDetail: async function() {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    if(!id) {
      if(document.getElementById('article-content')) document.getElementById('article-content').innerHTML = '<p>Artículo no especificado.</p>';
      return;
    }

    try {
      const response = await fetch('api.php?action=get_post&id=' + id);
      const item = await response.json();

      if (!item) {
        document.getElementById('article-content').innerHTML = '<p>Artículo no encontrado.</p>';
        return;
      }

      document.getElementById('article-date').innerText = item.date;
      document.getElementById('article-title').innerText = item.title;
      document.getElementById('article-body').innerHTML = item.body;

    } catch (error) {
      console.error("Error cargando artículo:", error);
      document.getElementById('article-content').innerHTML = '<p style="color:#ef4444;">Error al cargar el artículo.</p>';
    }
  },

  // --- 7. FUNCIONES VIEJAS (Mantenidas por compatibilidad, aunque ya no se usan para las páginas nuevas) ---
  loadPropertyDetail: function() { /* Reemplazada por fetchPropertyDetail */ },
  loadBlogDetail: function() { /* Reemplazada por fetchBlogDetail */ },

  // --- 8. ADMIN ACTIONS ---
  saveProperty: async function(e) {
    e.preventDefault();
    const id = document.getElementById('prop-id').value;
    const imageInput = document.getElementById('prop-image-data').value;
    let finalImage = imageInput;
    if (!finalImage && !id) finalImage = `https://picsum.photos/seed/${Date.now()}/400/300`;

      const formData = {
        id: id,
        title: document.getElementById('prop-title').value,
        location: document.getElementById('prop-loc').value,
        profit: document.getElementById('prop-profit').value,
        duration: document.getElementById('prop-duration').value,
        min: document.getElementById('prop-min').value,
        badge: document.getElementById('prop-badge').value,
        progress: document.getElementById('prop-progress').value,
        funded: document.getElementById('prop-funded').value,
        description: document.getElementById('prop-desc').value,
        image: finalImage
      };

      const params = new URLSearchParams();
      for (const key in formData) params.append(key, formData[key]);

      try {
        const response = await fetch('api.php?action=save_property', {
          method: 'POST',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          body: params
        });
        const result = await response.json();
        if(result.status === 'success') {
          this.resetForm();
          await this.init();
          alert('Guardado');
        }
      } catch (error) { alert('Error al guardar'); }
  },

  deleteProp: async function(id) {
    if(confirm('¿Borrar?')) {
      // 1. Enviamos la orden de borrar a la base de datos
      await fetch(`api.php?action=delete_property&id=${id}`);

      // 2. Limpiamos la memoria temporal (this.data) para obligar a recargar
      this.data = { properties: [], posts: [] };

      // 3. Volvemos a pedir los datos a la API (ahora sí entrará)
      await this.init();
    }
  },

  editProp: function(id) {
    const item = this.data.properties.find(x => x.id === id);
    if (!item) return;
    document.getElementById('prop-id').value = item.id;
    document.getElementById('prop-title').value = item.title;
    document.getElementById('prop-loc').value = item.location;
    document.getElementById('prop-profit').value = item.profit;
    document.getElementById('prop-duration').value = item.duration;
    document.getElementById('prop-min').value = item.min;
    document.getElementById('prop-badge').value = item.badge;
    document.getElementById('prop-progress').value = item.progress;
    document.getElementById('prop-funded').value = item.funded;
    document.getElementById('prop-desc').value = item.description || '';
    document.getElementById('prop-image-data').value = item.image;
    document.getElementById('prop-preview').style.backgroundImage = `url(${item.image})`;
  },

  previewImage: function(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = (e) => {
        document.getElementById('prop-image-data').value = e.target.result;
        document.getElementById('prop-preview').style.backgroundImage = `url(${e.target.result})`;
      }
      reader.readAsDataURL(input.files[0]);
    }
  },

  resetForm: function() {
    document.getElementById('prop-form').reset();
    document.getElementById('prop-id').value = '';
    document.getElementById('prop-image-data').value = '';
    document.getElementById('prop-preview').style.backgroundImage = 'none';
  }
};

document.addEventListener('DOMContentLoaded', () => {
  app.init();
});
