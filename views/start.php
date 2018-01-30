
<div id="app">

	<h1>Welcome to the MVC Framework</h1>

	<p>This is an example of a page added using the config.php url router.</p>
	<p>You can also access the MVC pages via a direct URL. For example: </p>
	<p>🔗  <a target="_blank" href="/mvc/?mvc_app_route=welcome/test"><?= $domain ?>?mvc_app_route=welcome/test</a></p>
	<p>🔗  <a target="_blank" href="/mvc/?mvc_app_route=welcome/vue"><?= $domain ?>?mvc_app_route=welcome/vue</a></p>
	<p>🔗  <a target="_blank" href="/custom"><?= $domain ?>/custom</a></p>

	<h2>Vue.js</h2>
	<p>{{ message }}</p>

</div>


<script src="https://sh2.local/wp-content/mvc_app/js/mvc_scripts.js"></script>

<script>
	var app = new Vue({
		el: '#app',
		data: {
			message: 'Hello Vue!'
		}
	})
</script>