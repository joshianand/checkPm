<?php echo form_open(uri_string(), 'class="crud"') ?>

	<header><h3><?php echo $widget->title ?></h3></header>

	<?php echo form_hidden('widget_id', $widget->id) ?>
	<?php echo isset($widget->instance_id) ? form_hidden('widget_instance_id', $widget->instance_id) : null ?>
	<?php echo isset($error) && $error ? $error : null ?>

	<ol>
		<li>
			<label><?php echo 'Title'; ?>:</label>
			<?php echo form_input('title', set_value('title', isset($widget->instance_title) ? $widget->instance_title : '')) ?>
			<span class="required-icon tooltip"><?php echo 'required' ?></span>
		</li>

		<li>
			<label><?php echo 'Display Widget Title?'; ?>:</label>
			<?php echo form_checkbox('show_title', true, isset($widget->options['show_title']) ? $widget->options['show_title'] : false) ?>
		</li>

		<?php if (isset($widget_areas)): ?>
		<li>
			<label><?php echo 'Area'; ?>:</label>
			<?php echo form_dropdown('widget_area_id', $widget_areas, $widget->widget_area_id) ?>
		</li>
		<?php endif ?>
	</ol>
	<?php echo $form ? $form : null ?>

	<div id="instance-actions" class="align-right padding-bottom padding-right buttons buttons-small">
        <button type="submit" name="btnAction" value="save" class="btn blue">
            <span>Save</span>
        </button>
        <a href="<?php echo base_url();?>widget" class="btn gray cancel">Cancel</a>		
    </div>
<?php echo form_close() ?>