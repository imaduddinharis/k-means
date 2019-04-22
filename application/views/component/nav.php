<ul class="nav nav-tabs navbar navbar-dark bg-dark" style="margin-top:20px; padding-bottom:0;" id="myTab" role="tablist">
	<li class="nav-item">
		<a
			class="nav-link active"
			id="home-tab"
			data-toggle="tab"
			href="#home"
			role="tab"
			aria-controls="home"
			aria-selected="true"
			>Home</a
		>
	</li>
	<li class="nav-item">
		<a
			class="nav-link"
			id="iterasi1-tab"
			data-toggle="tab"
			href="#iterasi1"
			role="tab"
			aria-controls="profile"
			aria-selected="false"
			>Iterasi 1</a
		>
	</li>
	<?php foreach($identIterasi as $valIdentIt=>$val0): ?>
	<li class="nav-item">
		<a
			class="nav-link"
			id="iterasi<?=$val0->iterasi?>-tab"
			data-toggle="tab"
			href="#iterasi<?=$val0->iterasi?>"
			role="tab"
			aria-controls="contact"
			aria-selected="false"
			>Iterasi
			<?=$val0->iterasi?></a
		>
	</li>
	<?php endforeach;?>
</ul>
