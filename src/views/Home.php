<title> <?php echo $title; ?></title>

<ul>
  <?php foreach ($users as $item) { ?>
  <li><?php echo $item['id']; ?></li>
  <li><?php echo $item['nome']; ?></li>
  <li><?php echo $item['usuario']; ?></li>
  <li><?php echo $item['senha']; ?></li>


  <?php } ?>
</ul>