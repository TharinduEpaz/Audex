<h1><?php echo $data['title']; ?></h1>
<ul>
<?php foreach($data['posts'] as $post): ?>
    <li><?php echo $post->first_name; ?></li>
    <li><?php echo $post->email; ?></li>

<?php endforeach; ?>
</ul>