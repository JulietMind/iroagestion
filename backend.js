const app = {
  data: { properties: [], posts: [] },

  init: async function() {
    try {
      // Añadimos &t=${Date.now()} para forzar que NO use caché
      const response = await fetch('api.php?action=get_all&t=' + Date.now());

      // Verificamos que la respuesta sea JSON válido
      if (!response.ok) throw new Error("HTTP error " + response.status);

      this.data = await response.json();

      // DEBUG: Si quieres ver qué datos llegan, quita el comentario de la línea de abajo
      // console.log("Datos cargados:", this.data);

      this.renderHome();
      this.renderAdminTable();
      this.renderPageContent();

      if(document.getElementById('blog-grid')) {
        this.renderBlogGrid();
      }
    } catch (error) {
      console.error("Error cargando datos:", error);
      alert("Hubo un error al cargar los datos desde el servidor. Revisa la consola (F12).");
    }
  },

  // --- RENDERIZADO (IGUAL QUE ANTES) ---
  renderHome: function() {
    const container = document.getElementById('featured-grid');
    if (!container) return;

    container.innerHTML = this.data.properties.map(item => `
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
    <div class="metric">
    <span class="metric-label">Rentabilidad</span>
    <span class="metric-value gold">${item.profit.split('/')[0]}</span>
    </div>
    <div class="metric">
    <span class="metric-label">Duración</span>
    <span class="metric-value">${item.duration.split(' ')[0]}m</span>
    </div>
    <div class="metric">
    <span class="metric-label">Min. Inversión</span>
    <span class="metric-value">${item.min}</span>
    </div>
    </div>

    <div class="progress-section">
    <div class="progress-header">
    <span>Fondos Recaudados</span>
    <span>${item.funded}</span>
    </div>
    <div class="progress-track">
    <div class="progress-fill" style="width: ${item.progress}%;"></div>
    </div>
    </div>

    <a href="ficha.php?id=${item.id}" class="card-btn">
    Ver Detalles de Inversión
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
    </div>
    </div>
    `).join('');
  },

  renderBlogGrid: function() {
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

  loadPropertyDetail: function() {
    const params = new URLSearchParams(window.location.search);
    const id = parseInt(params.get('id'));
    const item = this.data.properties.find(x => x.id === id);

    if (!item) {
      document.getElementById('detail-container').innerHTML = '<p class="container">Piso no encontrado.</p>';
      return;
    }

    document.getElementById('detail-image').src = item.image;
    document.getElementById('detail-title').innerText = item.title;
    document.getElementById('detail-location').innerText = item.location;
    document.getElementById('detail-profit').innerText = item.profit;
    document.getElementById('detail-duration').innerText = item.duration;
    document.getElementById('detail-min').innerText = item.min;
    document.getElementById('detail-desc').innerHTML = item.description || "Sin descripción.";
    document.getElementById('detail-progress').style.width = item.progress + "%";
    document.getElementById('detail-funded').innerText = item.funded;
  },

  loadBlogDetail: function() {
    const params = new URLSearchParams(window.location.search);
    const id = parseInt(params.get('id'));
    const item = this.data.posts.find(x => x.id === id);

    if (!item) {
      document.getElementById('article-content').innerHTML = '<p class="container">Artículo no encontrado.</p>';
      return;
    }

    document.getElementById('article-date').innerText = item.date;
    document.getElementById('article-title').innerText = item.title;
    document.getElementById('article-body').innerHTML = item.body;
  },

  // --- ADMIN LOGIC (AHORA USA API) ---
  renderAdminTable: function() {
    const tbody = document.querySelector('#props-table tbody');
    if (!tbody) return;
    tbody.innerHTML = this.data.properties.map(item => `
    <tr>
    <td><img src="${item.image}" alt="mini" style="width:50px; height:35px; object-fit:cover; border-radius:4px;"></td>
    <td>${item.title}</td>
    <td>${item.location}</td>
    <td>${item.profit}</td>
    <td>
    <button class="login-btn" style="padding:5px 10px; font-size:0.7rem; display:inline-block; width:auto;" onclick="app.editProp(${item.id})">Editar</button>
    <button class="btn-del" onclick="app.deleteProp(${item.id})">Borrar</button>
    </td>
    </tr>
    `).join('');
  },

  handlePropertySubmit: async function(e) {
    e.preventDefault();

    const id = document.getElementById('prop-id').value;
    const imageInput = document.getElementById('prop-image-data').value;

    // Si no hay imagen nueva, mantener la existente
    let finalImage = imageInput;
    if (!finalImage && !id) {
      finalImage = `https://picsum.photos/seed/${Date.now()}/400/300`;
    }

    // Recopilar datos
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

    // --- PARTE CRÍTICA ARREGLADA ---
    // Convertimos el objeto JS a un formato que PHP entienda correctamente
    const params = new URLSearchParams();
    for (const key in formData) {
      params.append(key, formData[key]);
    }

    try {
      const response = await fetch('api.php?action=save_property', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: params // Enviamos el objeto params formateado
      });

      if (response.ok) {
        const result = await response.json();
        if(result.status === 'success') {
          this.resetPropForm();
          await this.init(); // Recargar tabla
          alert('Guardado en Base de Datos');
        } else {
          alert('Error del servidor al guardar.');
        }
      } else {
        alert('Error de conexión con el servidor (HTTP ' + response.status + ')');
      }
    } catch (error) {
      console.error("Error:", error);
      alert('Error al intentar guardar. Consulta la consola (F12) para más detalles.');
    }
  },

  handleImagePreview: function(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = (e) => {
        document.getElementById('prop-image-data').value = e.target.result;
        document.getElementById('prop-preview').style.backgroundImage = `url(${e.target.result})`;
      }
      reader.readAsDataURL(input.files[0]);
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
    document.getElementById('prop-image-data').value = item.image; // Cargar Base64 existente
    document.getElementById('prop-preview').style.backgroundImage = `url(${item.image})`;
  },

  resetPropForm: function() {
    document.getElementById('property-form').reset();
    document.getElementById('prop-id').value = '';
    document.getElementById('prop-image-data').value = '';
    document.getElementById('prop-preview').style.backgroundImage = 'none';
  },

  // Las funciones de texto (pages) no han cambiado, siguen sin DB en este ejemplo por simplicidad, pero puedes agregarlas si quieres.
  renderPageContent: function() {
    const bodyEl = document.getElementById('page-content');
    const titleEl = document.getElementById('page-title');
    if (window.currentSlug && bodyEl && this.data.pages) {
      // Nota: Las páginas estáticas siguen usando JS o HTML estático.
      // Si quieres meterlas en BD, necesitarías crear tabla 'pages' y leerla igual que posts.
      titleEl.innerText = this.data.pages[window.currentSlug]?.title || '';
      bodyEl.innerHTML = this.data.pages[window.currentSlug]?.body || '';
    }
  },

  loadPageContent: function() {}, // Mantener vacío si no editas páginas en BD
  savePageContent: function() {} // Mantener vacío
};

document.addEventListener('DOMContentLoaded', () => {
  app.init();
});
