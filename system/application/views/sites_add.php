<?= form_open('site/save');?>

<?= form_label('Sitename', 'sitename'); ?>
<?= form_input('sitename', 'johndoe'); ?>
<?= form_dropdown('template', $templates ); ?>
<?= form_submit(); ?>

<?= form_close();?>