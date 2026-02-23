const app = {
  data: { properties: [], posts: [] },

  // --- 1. INICIALIZACIÓN GENERAL ---
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
      this.renderAdmin();     // Para gestion.php (Pisos)
      this.renderAdminPosts(); // Para gestion.php (Blog)

    } catch (error) {
      console.error("Error:", error);
      alert("Error cargando datos. Refresca la página (F5).");
    }
  },

  // // --- 2. HOME (3 Destacados) ---
  renderFeatured: function() {
    const container = document.getElementById('featured-grid');
    if (!container) return;

    // Numero de propiedades destacadas en index.php
    const items = this.data.properties.slice(0, 6);
    container.innerHTML = this.createCardsHTML(items);
  },

  // --- 3. CATÁLOGO (Todos) ---
  renderCatalog: function() {
    const container = document.getElementById('catalog-grid');
    if (!container) return;

    // Mostramos todos
    const items = this.data.properties;
    container.innerHTML = this.createCardsHTML(items);
  },

  // --- 4. BLOG (Ahora PROPIEDADES EN CURSO) ---
  renderBlog: function() {
    const container = document.getElementById('blog-grid');
    if (!container) return;

    container.innerHTML = this.data.posts.map(item => `
    <div class="project-card">
    <div class="card-image-wrapper">
    <!-- Usamos un badge por defecto si viene vacío -->
    <span class="card-badge">${item.badge || 'En Curso'}</span>
    <img src="${item.image}" alt="${item.title}">
    </div>
    <div class="card-body">
    <h3 class="project-title">${item.title || 'Sin título'}</h3>
    <div class="project-location">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
    ${item.location || 'Ubicación no especificada'}
    </div>

    <div class="metrics-grid">
    <!-- AQUÍ ESTÁ LA CORRECCIÓN: Añadimos || '0%' para evitar el error si está vacío -->
    <div class="metric"><span class="metric-label">Rentabilidad</span><span class="metric-value gold">${(item.profit || '0%').split('/')[0]}</span></div>

    <!-- AQUÍ ESTÁ LA CORRECCIÓN: Añadimos || '0 meses' para evitar el error -->
    <div class="metric"><span class="metric-label">Duración</span><span class="metric-value">${(item.duration || '0 meses').split(' ')[0]}m</span></div>

    <div class="metric"><span class="metric-label">Min. Inversión</span><span class="metric-value">${item.min || '-'}</span></div>
    </div>

    <!-- Enlace a articulo.php -->
    <a href="articulo.php?id=${item.id}" class="card-btn">
    Ver Detalles
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
    </div>
    </div>
    `).join('');
  },

  // --- 5. ADMIN: PISOS ---
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

  // --- 6. ADMIN: BLOG (Ahora PROPIEDADES EN CURSO) ---
  renderAdminPosts: function() {
    const tbody = document.querySelector('#admin-posts-table tbody');
    if (!tbody) return;

    tbody.innerHTML = this.data.posts.map(item => `
    <tr>
    <td><img src="${item.image}" alt="mini" style="width:60px; height:40px; object-fit:cover; border-radius:4px;"></td>
    <td>${item.title}</td>
    <td>${item.location}</td> <!-- CAMBIO: Mostramos Ubicación en lugar de Fecha -->
    <td>${item.profit}</td>   <!-- CAMBIO: Mostramos Rentabilidad -->
    <td>
    <button class="btn-edit" onclick="app.editPost(${item.id})">Editar</button>
    <button class="btn-del" onclick="app.deletePost(${item.id})">Borrar</button>
    </td>
    </tr>
    `).join('');
  },

  // --- 6. ADMIN: BLOG (ANTIGUO POSTS BLOG) ---
//  renderAdminPosts: function() {
//    const tbody = document.querySelector('#admin-posts-table tbody');
  //  if (!tbody) return;

    //tbody.innerHTML = this.data.posts.map(item => `
    //<tr>
    //<td><img src="${item.image}" alt="mini" style="width:60px; height:40px; object-fit:cover; border-radius:4px;"></td>
    //<td>${item.title}</td>
    //<td>${item.date}</td>
    //<td>
    //<button class="btn-edit" onclick="app.editPost(${item.id})">Editar</button>
    //<button class="btn-del" onclick="app.deletePost(${item.id})">Borrar</button>
    //</td>
    //</tr>
    //`).join('');
 // },

  // --- 7. HELPER DE TARJETAS (Compartido) ---
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

    <a href="ficha.php?id=${item.id}" class="card-btn">
    Ver Detalles
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
    </div>
    </div>
    `).join('');
  },

  // --- 8. CARGA DIRECTA (Ficha y Artículo) ---
  fetchPropertyDetail: async function() {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    if(!id) return;

    try {
      const response = await fetch('api.php?action=get_property&id=' + id);
      const item = await response.json();

      if (!item) {
        document.getElementById('detail-container').innerHTML = '<p style="padding:20px; color:white;">Piso no encontrado.</p>';
        return;
      }

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
    }
  },

  fetchBlogDetail: async function() {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    if(!id) return;

    try {
      const response = await fetch('api.php?action=get_post&id=' + id);
      const item = await response.json();

      if (!item) {
        document.getElementById('detail-container').innerHTML = '<p style="padding:20px; color:white;">Propiedad en curso no encontrada.</p>';
        return;
      }

      // --- CAMBIOS AQUÍ: Rellenamos con datos de Propiedad ---
      document.getElementById('detail-image').src = item.image;
      document.getElementById('detail-title').innerText = item.title;
      document.getElementById('detail-location-text').innerText = item.location;
      document.getElementById('detail-profit').innerText = item.profit;
      document.getElementById('detail-duration').innerText = item.duration;
      document.getElementById('detail-min').innerText = item.min;

      // Convertimos saltos de línea a <br> para la descripción
      document.getElementById('detail-desc').innerHTML = (item.description || "").replace(/\n/g, '<br>');

    } catch (error) {
      console.error("Error cargando detalle:", error);
    }
  },

  // --- 9. ACCIONES PISOS ---
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
          this.resetPropForm();
          // ARREGLO: Limpiar memoria para que aparezca el nuevo piso
          this.data = { properties: [], posts: [] };
          await this.init();
          alert('Piso guardado correctamente');
        }
      } catch (error) { alert('Error al guardar'); }
  },

  deleteProp: async function(id) {
    if(confirm('¿Borrar piso?')) {
      await fetch(`api.php?action=delete_property&id=${id}`);
      // ARREGLO: Limpiar memoria para que desaparezca el piso
      this.data = { properties: [], posts: [] };
      await this.init();
    }
  },

  editProp: function(id) {
    const item = this.data.properties.find(x => x.id == id);
    if (!item) return;

    // Usamos '==' para compatibilidad de tipos
    const itemFound = this.data.properties.find(x => x.id == id);

    if(!itemFound) {
      alert("No se encontró el piso. Recarga la página.");
      return;
    }

    document.getElementById('prop-id').value = itemFound.id;
    document.getElementById('prop-title').value = itemFound.title;
    document.getElementById('prop-loc').value = itemFound.location;
    document.getElementById('prop-profit').value = itemFound.profit;
    document.getElementById('prop-duration').value = itemFound.duration;
    document.getElementById('prop-min').value = itemFound.min;
    document.getElementById('prop-badge').value = itemFound.badge;
    document.getElementById('prop-funded').value = itemFound.funded;
    document.getElementById('prop-desc').value = itemFound.description || '';
    document.getElementById('prop-image-data').value = itemFound.image;
    document.getElementById('prop-preview').style.backgroundImage = `url(${itemFound.image})`;

    // Scroll suave al formulario
    window.scrollTo({ top: 0, behavior: 'smooth' });
  },

  previewImage: function(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = (e) => {
        // DETECTAMOS EN QUÉ FORMULARIO ESTAMOS
        const isPostForm = input.id.includes('post');

        // Definimos los IDs según el formulario
        const targetDataId = isPostForm ? 'post-image-data' : 'prop-image-data';
        const targetPreviewId = isPostForm ? 'post-preview' : 'prop-preview';

        document.getElementById(targetDataId).value = e.target.result;
        document.getElementById(targetPreviewId).style.backgroundImage = `url(${e.target.result})`;
      }
      reader.readAsDataURL(input.files[0]);
    }
  },


  // --- 10. ACCIONES BLOG (Ahora GUARDA PROPIEDADES EN CURSO) ---
  savePost: async function(e) {
    e.preventDefault();
    const id = document.getElementById('post-id').value;
    const imageInput = document.getElementById('post-image-data').value;
    let finalImage = imageInput;
    if (!finalImage && !id) finalImage = `https://picsum.photos/seed/${Date.now()}/400/300`;

      // Recogemos los datos igual que en el formulario de Finalizadas
      // Nota: Si 'post-progress' no existe en el HTML (está comentado), enviamos '0' por defecto.
      const progressElem = document.getElementById('post-progress');
      const progressVal = progressElem ? progressElem.value : '0';

      const formData = {
        id: id,
        title: document.getElementById('post-title').value,
        location: document.getElementById('post-loc').value,
        profit: document.getElementById('post-profit').value,
        duration: document.getElementById('post-duration').value,
        min: document.getElementById('post-min').value,
        badge: document.getElementById('post-badge').value,
        progress: progressVal,
        funded: document.getElementById('post-funded').value,
        description: document.getElementById('post-desc').value,
        image: finalImage
      };

      const params = new URLSearchParams();
      for (const key in formData) params.append(key, formData[key]);

      try {
        const response = await fetch('api.php?action=save_post', {
          method: 'POST',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          body: params
        });
        const result = await response.json();
        if(result.status === 'success') {
          this.resetPostForm();
          // Limpiar memoria para que aparezca el nuevo item
          this.data = { properties: [], posts: [] };
          await this.init();
          alert('Propiedad en curso guardada correctamente');
        }
      } catch (error) { alert('Error al guardar'); }
  },

  // --- 10. ACCIONES BLOG (NUEVO) ---
//  savePost: async function(e) {
//    e.preventDefault();
//    const id = document.getElementById('post-id').value;
//    const imageInput = document.getElementById('post-image-data').value;
//    let finalImage = imageInput;
//    if (!finalImage && !id) finalImage = `https://picsum.photos/seed/${Date.now()}/400/300`;

//      const formData = {
//        id: id,
//        title: document.getElementById('post-title').value,
//        date: document.getElementById('post-date').value,
//        image: finalImage,
//        body: document.getElementById('post-body').value
//      };

//      const params = new URLSearchParams();
//      for (const key in formData) params.append(key, formData[key]);

//      try {
//        const response = await fetch('api.php?action=save_post', {
//          method: 'POST',
//          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
//          body: params
//        });
//        const result = await response.json();
//        if(result.status === 'success') {
//          this.resetPostForm();
          // Limpiar memoria para que aparezca el nuevo artículo
//          this.data = { properties: [], posts: [] };
//          await this.init();
//          alert('Artículo guardado');
//        }
//      } catch (error) { alert('Error al guardar'); }
//  },

  deletePost: async function(id) {
    if(confirm('¿Borrar artículo?')) {
      await fetch(`api.php?action=delete_post&id=${id}`);
      // Limpiar memoria
      this.data = { properties: [], posts: [] };
      await this.init();
    }
  },

  editPost: function(id) {
    const item = this.data.posts.find(x => x.id == id);
    if (!item) return;

    // Rellenamos el formulario con los datos de la propiedad
    document.getElementById('post-id').value = item.id;
    document.getElementById('post-title').value = item.title;
    document.getElementById('post-loc').value = item.location;
    document.getElementById('post-profit').value = item.profit;
    document.getElementById('post-duration').value = item.duration;
    document.getElementById('post-min').value = item.min;
    document.getElementById('post-badge').value = item.badge;
    document.getElementById('post-funded').value = item.funded;
    document.getElementById('post-desc').value = item.description || '';
    document.getElementById('post-image-data').value = item.image;
    document.getElementById('post-preview').style.backgroundImage = `url(${item.image})`;

    // Si el campo progress existe en el HTML, lo rellenamos
    const progressElem = document.getElementById('post-progress');
    if(progressElem) progressElem.value = item.progress;

    window.scrollTo({ top: 0, behavior: 'smooth' });
  },

//  editPost: function(id) {
//    const item = this.data.posts.find(x => x.id == id);
//    if (!item) return;

    // Cambiar a la pestaña Blog (si está implementado en JS)
    // Si usamos las pestañas del PHP anterior, esto es opcional, pero ayuda al flujo
    // document.getElementById('tab-blog').click();

//    document.getElementById('post-id').value = item.id;
//    document.getElementById('post-title').value = item.title;
//    document.getElementById('post-date').value = item.date;
//    document.getElementById('post-body').value = item.body;
//    document.getElementById('post-image-data').value = item.image;
//    document.getElementById('post-preview').style.backgroundImage = `url(${item.image})`;

//    window.scrollTo({ top: 0, behavior: 'smooth' });
//  },

  previewPostImage: function(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = (e) => {
        document.getElementById('post-image-data').value = e.target.result;
        document.getElementById('post-preview').style.backgroundImage = `url(${e.target.result})`;
      }
      reader.readAsDataURL(input.files[0]);
    }
  },

  // --- 11. LIMPIEZA DE FORMULARIOS ---
  resetPropForm: function() {
    document.getElementById('prop-form').reset();
    document.getElementById('prop-id').value = '';
    document.getElementById('prop-image-data').value = '';
    document.getElementById('prop-preview').style.backgroundImage = 'none';
  },

  resetPostForm: function() {
    document.getElementById('post-form').reset();
    document.getElementById('post-id').value = '';
    document.getElementById('post-image-data').value = '';
    document.getElementById('post-preview').style.backgroundImage = 'none';
  }
};

document.addEventListener('DOMContentLoaded', () => {
  app.init();
});
