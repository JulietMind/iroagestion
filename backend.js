const app = {
  data: { properties: [], pages: {}, posts: [] },

  init: function () {
    const stored = localStorage.getItem("iroa_cms_final");
    if (stored) {
      this.data = JSON.parse(stored);
    } else {
      this.seedDefaults();
    }

    this.renderHome();
    this.renderAdminTable();
    this.renderPageContent();

    // Renderizar Grid del Blog si existe
    if (document.getElementById("blog-grid")) {
      this.renderBlogGrid();
    }
  },

  seedDefaults: function () {
    this.data.properties = [
      {
        id: 1,
        title: "Torre Castellana Premium",
        location: "Madrid, España",
        image: "https://picsum.photos/seed/arch1/800/600", // Imagen más grande para la ficha
        profit: "8.5% / año",
        duration: "24 Meses",
        min: "€500",
        badge: "En Financiación",
        progress: 75,
        funded: "75%",
        description:
          "Torre residencial de lujo situada en el corazón financiero de Madrid. Cuenta con acabados de alta calidad, gimnasio, piscina en azotea y vistas panorámicas de la ciudad. Una inversión segura en una zona de plusvalía garantizada.",
      },
      {
        id: 2,
        title: "Logistics Hub Valencia",
        location: "Valencia, España",
        image: "https://picsum.photos/seed/arch2/800/600",
        profit: "10.2% / año",
        duration: "36 Meses",
        min: "€1,000",
        badge: "Nueva Entrada",
        progress: 12,
        funded: "12%",
        description:
          "Nave logística estratégicamente ubicada cerca del puerto de Valencia y principales autopistas. Ideal para empresas de logística y distribución. Certificación energética A.",
      },
      {
        id: 3,
        title: "Hotel Boutique Horizon",
        location: "Mallorca, España",
        image: "https://picsum.photos/seed/arch3/800/600",
        profit: "9.0% / año",
        duration: "60 Meses",
        min: "€2,500",
        badge: "Próximamente",
        progress: 0,
        funded: "0%",
        description:
          "Exclusivo hotel boutique con 25 habitaciones en primera línea de playa en Cala Ratjada. Diseñado por arquitectos de prestigio, ofrece servicios de spa y restauración de alto nivel.",
      },
    ];

    // Datos del Blog (Nuevos)
    this.data.posts = [
      {
        id: 1,
        title: "El auge del tokenizado inmobiliario",
        date: "20 Dic 2023",
        image: "https://picsum.photos/seed/blog1/800/400",
        body: "<p>La tecnología blockchain está revolucionando el sector inmobiliario. Al tokenizar activos, democratizamos el acceso a inversiones que antes estaban reservadas para grandes fondos.</p><p>¿Qué ventajas ofrece? Fraccionamiento, transparencia y menor capital inicial.</p>",
      },
      {
        id: 2,
        title: "5 claves para diversificar tu portfolio",
        date: "15 Dic 2023",
        image: "https://picsum.photos/seed/blog2/800/400",
        body: "<p>La diversificación es la clave para mitigar riesgos en cualquier inversión. No pongas todos tus huevos en la misma cesta.</p><p>En Iroa Gestión te ofrecemos oportunidades en diferentes sectores: Residencial, Logístico y Turístico.</p>",
      },
      {
        id: 3,
        title: "Análisis de mercado 2024",
        date: "01 Dic 2023",
        image: "https://picsum.photos/seed/blog3/800/400",
        body: "<p>Las previsiones para el año 2024 apuntan a una estabilización de los tipos de interés, lo que reactivará el mercado inmobiliario. Es el momento de posicionarse.</p>",
      },
    ];

    this.data.pages = {
      "sobre-nosotros": {
        title: "Sobre Iroa Gestión",
        body: "<p>Somos líderes...</p>",
      },
      blog: { title: "Blog", body: "<p>Noticias...</p>" },
      "como-funciona": { title: "Cómo Funciona", body: "<p>Pasos...</p>" },
      ayuda: { title: "Ayuda", body: "<p>FAQ...</p>" },
      terminos: { title: "Términos", body: "<p>Legal...</p>" },
      privacidad: { title: "Privacidad", body: "<p>RGPD...</p>" },
    };
    this.save();
  },

  save: function () {
    localStorage.setItem("iroa_cms_final", JSON.stringify(this.data));
    this.renderHome();
    this.renderAdminTable();
  },

  // --- RENDERIZADO PISOS (Actualizado con Links) ---
  renderHome: function () {
    const container = document.getElementById("featured-grid");
    if (!container) return;

    container.innerHTML = this.data.properties
      .map(
        (item) => `
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
                            <span class="metric-value gold">${item.profit.split("/")[0]}</span>
                        </div>
                        <div class="metric">
                            <span class="metric-label">Duración</span>
                            <span class="metric-value">${item.duration.split(" ")[0]}m</span>
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

                    <!-- CAMBIO: Botón convertido en enlace a ficha.php -->
                    <a href="ficha.php?id=${item.id}" class="card-btn">
                        Ver Detalles de Inversión
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        `,
      )
      .join("");
  },

  // --- RENDERIZADO BLOG (NUEVO) ---
  renderBlogGrid: function () {
    const container = document.getElementById("blog-grid");
    if (!container) return;

    container.innerHTML = this.data.posts
      .map(
        (item) => `
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
        `,
      )
      .join("");
  },

  // --- CARGAR FICHA INDIVIDUAL (NUEVO) ---
  loadPropertyDetail: function () {
    const params = new URLSearchParams(window.location.search);
    const id = parseInt(params.get("id"));
    const item = this.data.properties.find((x) => x.id === id);

    if (!item) {
      document.getElementById("detail-container").innerHTML =
        '<p class="container">Piso no encontrado.</p>';
      return;
    }

    // Rellenar Hero
    document.getElementById("detail-image").src = item.image;
    document.getElementById("detail-title").innerText = item.title;
    document.getElementById("detail-location").innerText = item.location;

    // Rellenar Datos
    document.getElementById("detail-profit").innerText = item.profit;
    document.getElementById("detail-duration").innerText = item.duration;
    document.getElementById("detail-min").innerText = item.min;
    document.getElementById("detail-desc").innerHTML =
      item.description || "Sin descripción detallada.";

    // Barra de progreso
    document.getElementById("detail-progress").style.width =
      item.progress + "%";
    document.getElementById("detail-funded").innerText = item.funded;
  },

  // --- CARGAR ARTICULO INDIVIDUAL (NUEVO) ---
  loadBlogDetail: function () {
    const params = new URLSearchParams(window.location.search);
    const id = parseInt(params.get("id"));
    const item = this.data.posts.find((x) => x.id === id);

    if (!item) {
      document.getElementById("article-content").innerHTML =
        '<p class="container">Artículo no encontrado.</p>';
      return;
    }

    document.getElementById("article-date").innerText = item.date;
    document.getElementById("article-title").innerText = item.title;
    document.getElementById("article-body").innerHTML = item.body;
  },

  // --- CÓDIGO RESTANTE (Igual que antes) ---
  renderPageContent: function () {
    const bodyEl = document.getElementById("page-content");
    const titleEl = document.getElementById("page-title");
    if (window.currentSlug && bodyEl && this.data.pages[window.currentSlug]) {
      titleEl.innerText = this.data.pages[window.currentSlug].title;
      bodyEl.innerHTML = this.data.pages[window.currentSlug].body;
    }
  },

  renderAdminTable: function () {
    const tbody = document.querySelector("#props-table tbody");
    if (!tbody) return;
    tbody.innerHTML = this.data.properties
      .map(
        (item) => `
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
        `,
      )
      .join("");
  },

  handlePropertySubmit: function (e) {
    e.preventDefault();
    const id = document.getElementById("prop-id").value;
    const imageInput = document.getElementById("prop-image-data").value;
    const finalImage = imageInput
      ? imageInput
      : `https://picsum.photos/seed/${Date.now()}/400/300`;
    const description = document.getElementById("prop-desc").value; // Nuevo campo

    const newData = {
      id: id ? parseInt(id) : Date.now(),
      title: document.getElementById("prop-title").value,
      location: document.getElementById("prop-loc").value,
      profit: document.getElementById("prop-profit").value,
      duration: document.getElementById("prop-duration").value,
      min: document.getElementById("prop-min").value,
      badge: document.getElementById("prop-badge").value,
      progress: document.getElementById("prop-progress").value,
      funded: document.getElementById("prop-funded").value,
      image: finalImage,
      description: description, // Guardar descripción
    };

    if (id) {
      const index = this.data.properties.findIndex((x) => x.id == id);
      if (index !== -1) this.data.properties[index] = newData;
    } else {
      this.data.properties.push(newData);
    }
    this.save();
    this.resetPropForm();
  },

  handleImagePreview: function (input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = (e) => {
        document.getElementById("prop-image-data").value = e.target.result;
        document.getElementById("prop-preview").style.backgroundImage =
          `url(${e.target.result})`;
      };
      reader.readAsDataURL(input.files[0]);
    }
  },

  editProp: function (id) {
    const item = this.data.properties.find((x) => x.id === id);
    if (!item) return;
    document.getElementById("prop-id").value = item.id;
    document.getElementById("prop-title").value = item.title;
    document.getElementById("prop-loc").value = item.location;
    document.getElementById("prop-profit").value = item.profit;
    document.getElementById("prop-duration").value = item.duration;
    document.getElementById("prop-min").value = item.min;
    document.getElementById("prop-badge").value = item.badge;
    document.getElementById("prop-progress").value = item.progress;
    document.getElementById("prop-funded").value = item.funded;
    document.getElementById("prop-desc").value = item.description || ""; // Cargar descripción
    document.getElementById("prop-preview").style.backgroundImage =
      `url(${item.image})`;
  },

  deleteProp: function (id) {
    if (confirm("¿Borrar oportunidad?")) {
      this.data.properties = this.data.properties.filter((x) => x.id !== id);
      this.save();
    }
  },

  resetPropForm: function () {
    document.getElementById("property-form").reset();
    document.getElementById("prop-id").value = "";
    document.getElementById("prop-image-data").value = "";
    document.getElementById("prop-preview").style.backgroundImage = "none";
  },

  loadPageContent: function () {
    const slug = document.getElementById("page-selector").value;
    const content = this.data.pages[slug];
    if (content) {
      document.getElementById("page-title").value = content.title || "";
      document.getElementById("page-body").value = content.body || "";
    }
  },

  savePageContent: function () {
    const slug = document.getElementById("page-selector").value;
    if (!this.data.pages[slug]) this.data.pages[slug] = {};

    this.data.pages[slug].title = document.getElementById("page-title").value;
    this.data.pages[slug].body = document.getElementById("page-body").value;

    this.save();
    alert("Página actualizada correctamente");
  },
};

document.addEventListener("DOMContentLoaded", () => {
  app.init();
});
