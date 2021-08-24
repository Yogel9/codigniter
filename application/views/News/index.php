<h1> Все новости </h1>
<h5><a href="/news/create">Добавить новость</a>
</h5>

<?php foreach ($news as $key => $value):  ?>
<p> 
	<a href="/news/view/<?php echo $value['slug'];?>"><?php echo $value['title']; ?></a> | 
	<a href="/news/edit/<?php echo $value['slug'];?>"> редактировать</a> |
	<a href="/news/delete/<?php echo $value['slug'];?>"> удалить </a>
</p>
<?php endforeach ?>