<?php

\Admin::model('SleepingOwl\Admin\Model\Permission')->title('Permissions')->alias('permissions')->display(function ()
{
	$display = AdminDisplay::datatables();

	$display->columns([
		Column::checkbox(),
		Column::string('id')->label('#'),
		Column::string('value')->label('Permission'),
		Column::string('description')->label('Description'),
	]);
	return $display;
})->createAndEdit(function ()
{
	$form = AdminForm::form();
	$form->items([
		FormItem::text('value', 'Permission')->required()->unique(),
		FormItem::text('description', 'Description')->required(),
	]);
	return $form;
});