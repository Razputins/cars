<?php foreach ($cars as $car): ?>
	<div class="col-md-4">
		<div class="card" style="margin-bottom: 10px">
			<div class="card-body">
				<?= $car->name; ?>
				<ul>
					<?php foreach ($car->param as $car_param): ?>
						<li><?= $car_param->param->name; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
<?php endforeach; ?>