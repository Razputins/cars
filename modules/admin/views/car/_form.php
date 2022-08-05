<?php

	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	/* @var $this yii\web\View */
	/* @var $model app\models\Car */
	/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'model_id')->dropDownList($model_list, ['prompt' => 'Выберите модель...']) ?>

	<div class="row" style="margin-bottom: 30px">
		<?php foreach ($param_list as $param_cat): ?>
			<div class="col-md-4">
				<div style="font-size: 20px; font-weight: 600;">
					<?= $param_cat->name; ?>
				</div>
				<?php foreach ($param_cat->param as $param): ?>
					<div class="form-check">
						<input class="form-check-input" type="radio" <?= in_array($param->id, $car_param) ? 'checked' : ''; ?> value="<?= $param->id ?>" name="Car[param][<?= $param_cat->id; ?>]" id="flexRadioDefault_<?= $param->id ?>">
						<label class="form-check-label" for="flexRadioDefault_<?= $param->id ?>">
							<?= $param->name ?>
						</label>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>

	<div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
