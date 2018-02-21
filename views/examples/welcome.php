
<div id="app">

	<h1>Welcome to Frame</h1>
	<p>Frame is an MVC framework that works with any WordPress theme. Get the best of WP without the limitations.</p>
	<p>MVC stands for Model View Controller and allows developers to build advanced applications that scale.</p>
	<p>🐘 Use <strong>Frame</strong> and <strong>WordPress</strong> for your backend. Separation of concerns makes for quick development.</p>
	<p>👉 URL router for easy for custom URLs in your app.</p>
	<p><img height="32" width="32" src="<?= $mvc_root?>/resources/assets/images/examples/logo_vue.svg" alt="" /> Build dynamic web applications with Vue.JS, a modern front-end javascript library baked into Frame.</p>
	<p><img height="32" width="32" src="<?= $mvc_root?>/resources/assets/images/examples/logo_npm.svg" alt="" /> npm is a powerful dependency manager to look after your libraries.</p>
	<p><img height="32" width="32" src="<?= $mvc_root?>/resources/assets/images/examples/logo_gulp.svg" alt="" /> Gulp pre-processing makes automating your jobs a breeze.</p>
	<p>🤩  Made for WordPress developers. Use your existing PHP and HTML skills.</p>

	<hr />

	<p>This is an example of a page added using the config.php url router.</p>
	<p>You can also access the MVC pages via a direct URL. For example: </p>
	<p>🔗  <a target="_blank" href="/<?= $app_root?>/?mvc_app_route=examples/vue"><?= $domain ?>/<?= $app_root?>/?mvc_app_route=examples/vue</a></p>
	<p>🔗  <a target="_blank" href="/<?= $app_root?>/?mvc_app_route=examples/test"><?= $domain ?>/<?= $app_root?>/?mvc_app_route=examples/test</a></p>
	<p>🔗  <a target="_blank" href="/custom"><?= $domain ?>/custom</a></p>

	<hr>

	<h4>Settings</h4>
	<p>A custom path for the mvc application can be set in your wp-config.php file using:</p>
	<p><pre>define('MVC_PATH', 'app');</pre></p>
	<p>Custom URLs can be managed in <pre>config/config.php</pre></p>

	<hr>

	<h3>Theme Integration</h3>
	<p>MVC App works with any theme. You will need to setup wrappers to work with your theme. Have a look at your themes index.php file. Find the wrappers there and add to the <em>views/wrappers</em> folder.</p>


</div>