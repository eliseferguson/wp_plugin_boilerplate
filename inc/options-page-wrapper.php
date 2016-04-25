/*------------------------------------------------------------------------------------------------------------*/

wp-content/plugins/namespace-plugin-name/inc/options-page-wrapper.php

- This is the markup for the admin settings page, usually has a form to submit info and then displays back what is set
- using Admin Style, pick out the markup for the style of options page you want to use
- update titles in markup
- add table/forms (use Admin Style to get markup)

//check if the form value is set if so then display information based on that submission
<?php if(!isset($namespace_setting1) || $namespace_setting1 == ''): ?>
	<form name="namespace_formname" method="post" action="">
		<input type="hidden" name="namespace_form_submitted" value="Y"/>
		<label for="namespace_setting1">Setting 1</label>
		<input name="namespace_setting1" id="namespace_setting1" type="text" value="" class="regular-text"/>
		<input class="button-primary" type="submit" name="namespace_setting1_submit" value="Save" />
	</form>
<?php else: ?>
	- add another box to display settings
	-or-
	- display in second column markup
	- repeat form to change the input
<?php endif; ?>

//output json feed
<?php var_dump($namespace_json_stuff); ?>
<?php echo $namespace_json_stuff->{'something-from-feed'}; ?>
//if the stuff in the json feed is an array
<?php echo $namespace_json_stuff->{'an-array-in-feed'}[0]->{'something-from-array'}; ?>
//echo out whatever information you need from the json feed in this manner