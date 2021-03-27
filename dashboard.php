<!-- Dashboard (Main menu of all users) -->
<?php
session_start();
if (
  $_SESSION['role'] == '4' || $_SESSION['role'] == '3' ||
  $_SESSION['role'] == '2' || $_SESSION['role'] == '1'
) {

?>

  <?php include('inc/header.php'); ?>

  <!-- Main content -->
  <div class="container-fluid">
    <h1 class="mt-4">Admin's Dashboard</h1>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi, laborum. Ipsum sequi tempore nemo molestias itaque officiis iure laudantium quia quos. Tenetur ea magnam repellendus incidunt error praesentium veniam enim?Numquam harum distinctio assumenda repellat pariatur quam adipisci ducimus accusantium eaque quibusdam accusamus aliquid nisi reprehenderit rerum voluptatibus minima ipsam ex inventore beatae, perspiciatis dignissimos velit? Culpa illo deserunt nam.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam veniam sint maiores, ipsam natus repellendus quia totam nesciunt assumenda voluptates dolorem impedit inventore facere error neque distinctio veritatis vero blanditiis?</p>
  </div>

  <?php include('inc/footer.php'); ?>
<?php
} else {
  header('Location: sindex.php');
}
?>