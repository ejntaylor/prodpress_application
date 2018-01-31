
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
	<h2>Vue.js</h2>


	<p>{{ message }}</p>
	<input v-model="message">

	<hr />

	<div id="app-7">
		<ol>
			<!--
			  Now we provide each todo-item with the todo object
			  it's representing, so that its content can be dynamic.
			  We also need to provide each component with a "key",
			  which will be explained later.
			-->
			<todo-item
				v-for="item in groceryList"
				v-bind:todo="item"
				v-bind:key="item.id">
			</todo-item>
		</ol>
	</div>


</div>



<script>

	Vue.component('todo-item', {
		props: ['todo'],
		template: '<li>{{ todo.text }}</li>'
	})

	var app = new Vue({
		el: '#app',
		data: {
			groceryList: [
				{ id: 0, text: 'Vegetables' },
				{ id: 1, text: 'Cheese' },
				{ id: 2, text: 'Whatever else humans are supposed to eat' }
			]
		}
	})



</script>