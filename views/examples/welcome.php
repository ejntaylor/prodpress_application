
<div id="app">

	<h1>Welcome to the MVC Framework</h1>

	<p>This is an example of a page added using the config.php url router.</p>
	<p>You can also access the MVC pages via a direct URL. For example: </p>
	<p>🔗  <a target="_blank" href="/<?= $app_root?>/?mvc_app_route=examples/vue"><?= $domain ?>/<?= $app_root?>/?mvc_app_route=examples/vue</a></p>
	<p>🔗  <a target="_blank" href="/<?= $app_root?>/?mvc_app_route=examples/test"><?= $domain ?>/<?= $app_root?>/?mvc_app_route=examples/test</a></p>
	<p>🔗  <a target="_blank" href="/custom"><?= $domain ?>/custom</a></p>

	<h3>Settings</h3>
	<p>A custom path for the mvc application can be set in your wp-config.php file using:</p>
	<p><pre>define('MVC_PATH', 'app');</pre></p>

</div>