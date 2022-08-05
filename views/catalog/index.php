<?php
	$this->title = $title;
?>
<h1 style="margin-bottom: 20px;"><?= $title ?></h1>
<div class="row">
	<div class="col-md-3">
		<div class="">
			<span style="font-weight: 600;margin-bottom: 10px;display: block">Марки</span>
			<ul style="padding-left: 15px;">
				<?php foreach ($mark_list as $mark): ?>
					<li><a href="/catalog/<?= $mark->slug; ?>"><?= $mark->name ?></a></li>
					<?php if (!empty($mark->model)): ?>
						<ul>
							<?php foreach ($mark->model as $model): ?>
								<li><a href="/catalog/<?= $mark->slug; ?>/<?= $model->slug; ?>"><?= $model->name; ?></a></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php foreach ($param_categories as $param_category): ?>
			<?php if (!empty($param_category->param)): ?>
				<div style="margin-bottom: 15px;" class="param-cover" data-cat="<?= $param_category->slug; ?>">
					<span style="font-weight: 600;margin-bottom: 10px;display: block"><?= $param_category->name; ?></span>
					<?php foreach ($param_category->param as $param): ?>
						<div class="form-check" style="padding-left: 30px">
							<input type="checkbox" <?= in_array($param->slug, $param_ids) ? 'checked' : ''; ?>
									name="param[<?= $param_category->slug;  ?>]"
							       value="<?= $param->slug; ?>" class="form-check-input check-param"
							       id="check_<?= $param->id; ?>">
							<label class="form-check-label" for="check_<?= $param->id; ?>"><?= $param->name; ?></label>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<div class="col-md-9">
		<div class="row" id="car-list">
			<?php foreach ($cars as $car): ?>
				<div class="col-md-4">
					<div class="card" style="margin-bottom: 10px">
						<div class="card-body">
							<?= $car->name; ?>
							<?php if (!empty($car->param)): ?>
								<ul>
									<?php foreach ($car->param as $car_param): ?>
										<li><?= $car_param->param->name; ?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>