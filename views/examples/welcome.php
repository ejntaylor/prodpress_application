
<div id="app">

	<div style="width:60%; float: left;">

		<h1><strong>Frame</strong> is an MVC framework that works with any WordPress theme.</h1>
		<br />
		<p>🐘 Build with a scalable PHP Backend using with <strong>Frame</strong> and <strong>WordPress</strong>.</p>
		<p>👉 URL router for easy for easy custom URLs in your app.</p>
		<p>🔌 Create your own API for use anywhere.</p>
		<p><img height="32" width="32" src="<?= $mvc_root?>/resources/assets/images/examples/logo_npm.svg" alt="" /> Use npm dependency manager to look after your libraries.</p>
		<p><img height="32" width="32" src="<?= $mvc_root?>/resources/assets/images/examples/logo_gulp.svg" alt="" /> Gulp pre-processing makes automating your jobs a breeze.</p>
	</div>
	<div style="width:30%; float: right; text-align: center;">
		<h4>Front-end Framework Agnostic</h4>
		<p>
			<img height="80" width="80" src="<?= $mvc_root?>/resources/assets/images/examples/logo_css.svg" alt="" />
			<img height="110" width="110" src="<?= $mvc_root?>/resources/assets/images/examples/logo_html5.svg" alt="" />
			<br />

			<img height="128" width="128" src="<?= $mvc_root?>/resources/assets/images/examples/logo_vue.svg" alt="" />
			<img height="128" width="128" src="<?= $mvc_root?>/resources/assets/images/examples/logo_jquery.svg" alt="" />

			<br />
			<img height="128" width="128" src="<?= $mvc_root?>/resources/assets/images/examples/logo_react.svg" alt="" />
			<img height="80" width="80" src="<?= $mvc_root?>/resources/assets/images/examples/logo_angular.svg" alt="" />

		</p>
		<p>Or just good old </p>
	</div>

	<div style="clear:left; margin-bottom: 100px;"></div>

	<h4>🤩  Made for WordPress developers. 🛠 Use your existing PHP and HTML skills.</h4>
	<p>MVC pages can be automatically accessed once they are created in the controller file using the following URL format:</p>
	<p>🔗  <em>[site url]/[app_slug]/mvc_app_route=[controller file]/[controller method]</em>.</p>
	<p>🔗  <a target="_blank" href="/<?= $app_root?>/?mvc_app_route=examples/test"><?= $domain ?>/<?= $app_root?>/?mvc_app_route=examples/test</a></p>
	<p>🔗  <a target="_blank" href="/<?= $app_root?>/?mvc_app_route=examples/vue"><?= $domain ?>/<?= $app_root?>/?mvc_app_route=examples/vue</a></p>
	<p>🔗  <a target="_blank" href="/custom"><?= $domain ?>/custom</a></p>

	<p>You can also set custom urls in the file <em>config.php</em> where we can control the url router. This page is an example. The url <em>/mvc-welcome/</em>.</p>


	<hr>

	<h4>🎛 Settings</h4>
	<p>The app slug mentioned above is a custom path for the mvc application can be set in your wp-config.php file using:</p>
	<p><pre>define('MVC_PATH', 'app');</pre></p>
	<p>Custom URLs can be managed in <pre>config/config.php</pre></p>

	<hr>

	<h3>🤝 Theme Integration</h3>
	<p>MVC App works with any theme. You will need to setup wrappers to work with your theme. Have a look at your themes index.php file. Find the wrappers there and add to the <em>views/wrappers</em> folder.</p>


</div>