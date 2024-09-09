<?php include("template/cabecera.php"); ?>

<main class="blogs-main">
  <section class="blogs-news-container">
    <div class="grid-container blogs-main-new">

      <?php
      include("base/bd.php");

      try {
          // Obtener el último post para mostrarlo en grande
          $sql = "SELECT id, titulo, tipo, contenido, imagen FROM posts ORDER BY id DESC LIMIT 1";
          $stmt = $conexion->query($sql);
          $latest_post = $stmt->fetch(PDO::FETCH_ASSOC);

          if ($latest_post) {
              echo "<div class='card-large'>";

              echo "<h2 class='card-title'>" . htmlspecialchars($latest_post['titulo']) . "</h2>";

              // Verifica si es un enlace de YouTube
              if ($latest_post['tipo'] === 'video') {
                  $video_url = $latest_post['contenido'];
                  $video_id = explode("v=", $video_url)[1];
                  echo "<iframe src='https://www.youtube.com/embed/" . htmlspecialchars($video_id) . "' frameborder='0' allowfullscreen class='card-video-large'></iframe>";
              } else {
                  $image_url = '/blog/assets/img/' . htmlspecialchars($latest_post['imagen']);
                  echo "<img src='" . $image_url . "' alt='Imagen del post' class='card-img-large'>";
                  echo "<p class='card-text'>" . htmlspecialchars($latest_post['contenido']) . "</p>";
              }

              echo "<div class='card-body'>";
              
              
              echo "</div>";
              echo "</div>";
          }

          // Configuración de paginación para los posts restantes
          $cards_per_page = 8;  // Mostrar ocho tarjetas pequeñas en una fila
          $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $offset = ($current_page - 1) * $cards_per_page;

          // Obtener el total de posts menos el último (ya mostrado en grande)
          $total_sql = "SELECT COUNT(*) FROM posts WHERE id != " . $latest_post['id'];
          $total_result = $conexion->query($total_sql);
          $total_posts = $total_result->fetchColumn();
          $total_pages = ceil($total_posts / $cards_per_page);

          // Obtener los posts restantes para la página actual
          $sql = "SELECT id, titulo, tipo, contenido, imagen FROM posts WHERE id != " . $latest_post['id'] . " ORDER BY id DESC LIMIT $cards_per_page OFFSET $offset";
          $stmt = $conexion->query($sql);

          echo "<div class='blogs-main-new'>";  // Inicia una fila de tarjetas

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<div class='card-og'>";  // Cada tarjeta ocupa espacio según la pantalla

              echo "<h2 class='card-title'>" . htmlspecialchars($row['titulo']) . "</h2>";

              // Verifica si es un enlace de YouTube
              if ($row['tipo'] === 'video') {
                  $video_url = $row['contenido'];
                  $video_id = explode("v=", $video_url)[1];
                  echo "<iframe src='https://www.youtube.com/embed/" . htmlspecialchars($video_id) . "' frameborder='0' allowfullscreen class='card-video'></iframe>";
              } else {
                  $image_url = '/blog/assets/img/' . htmlspecialchars($row['imagen']);
                  echo "<img src='" . $image_url . "' alt='Imagen del post' class='card-img'>";
                  echo "<p class='card-text'>" . htmlspecialchars($row['contenido']) . "</p>";
              }

              echo "<div class='card-body'>";
              
              
              echo "</div>";
              echo "</div>";
          }

          echo "</div>";  // Cierra la fila de tarjetas

      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
      ?>
    </div>

    <!-- Paginación -->
    <div class="pagination">
      <?php if ($current_page > 1): ?>
        <a href="?page=<?php echo $current_page - 1; ?>">&laquo; Anterior</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $current_page ? 'active' : ''; ?>"><?php echo $i; ?></a>
      <?php endfor; ?>

      <?php if ($current_page < $total_pages): ?>
        <a href="?page=<?php echo $current_page + 1; ?>">Siguiente &raquo;</a>
      <?php endif; ?>
    </div>
  </section>
</main>
<br><br><br><br>
<?php include("template/pie.php"); ?>

<style>
  .blogs-main-new {
    display: flex;
    flex-wrap: wrap; /* Permite que las tarjetas se muevan a la siguiente fila si no hay suficiente espacio */
    justify-content: space-between; /* Distribuye las tarjetas de manera uniforme */
  }

  .card-og {
    flex: 1 1 calc(25% - 10px); /* Las tarjetas ocupan 25% del ancho del contenedor, con espacio entre ellas */
    margin: 5px; /* Añade un pequeño margen entre las tarjetas */
    box-sizing: border-box; /* Asegura que el padding y border no aumenten el tamaño de la tarjeta */
  }

  .card-og img,
  .card-video {
    width: 100%; /* Asegura que las imágenes y los videos ocupen el ancho completo de la tarjeta */
    height: auto; /* Mantiene la proporción de las imágenes y videos */
    border-radius: 8px; /* Bordes redondeados */
  }

  /* Ajustes para pantallas medianas */
  @media (max-width: 992px) {
    .card-og {
      flex: 1 1 calc(33.33% - 10px); /* En pantallas medianas, 3 tarjetas por fila */
    }
  }

  /* Ajustes para pantallas pequeñas */
  @media (max-width: 768px) {
    .card-og {
      flex: 1 1 calc(50% - 10px); /* En pantallas pequeñas, 2 tarjetas por fila */
    }
  }

  /* Ajustes para pantallas muy pequeñas */
  @media (max-width: 576px) {
    .card-og {
      flex: 1 1 100%; /* En pantallas muy pequeñas, 1 tarjeta por fila */
    }
  }

  /* Paginación */
  .pagination {
    text-align: center;
    margin-top: 20px;
  }

  .pagination a {
    margin: 0 5px;
    padding: 8px 16px;
    text-decoration: none;
    color: #ff5733;
    border: 1px solid #ff5733;
    border-radius: 4px;
  }

  .pagination a.active {
    background-color: #ff5733;
    color: white;
  }

  .pagination a:hover {
    background-color: #ddd;
  }
</style>