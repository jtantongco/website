<ul>
	<li>
		<h3>Where Jeremiah's word seems legit</h3>
		<p>Just a place for me to express myself. Books supposedly say this is therapeutic!</p>
	</li>
	<?php foreach($articles as $article): ?>
	<li>
		<div class="featured">
			<img src="images/pastries.jpg" alt=""/>
			<ul>
				<li><a href="#"><img src="images/pastry1.jpg" alt=""/></a></li>
				<li><a href="#"><img src="images/pastry2.jpg" alt=""/></a></li>
				<li><a href="#"><img src="images/pastry3.jpg" alt=""/></a></li>
			</ul>
			<a href="#">click to enlarge image</a>
		</div>
		<div>
			<h3><?php echo $article->title ?></h3>
			<h4><?php echo $article->created ?></h4>
			<p>
				<?php echo $article->article ?>
			</p>
		</div>
	</li>	
	<?php endforeach ?>
</ul>

<ul class="paging">
	<?php echo $pagelinks ?>
</ul>