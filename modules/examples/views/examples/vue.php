
<div id="app">
	<h2>{{ welcome_message }}</h2>
	<p>{{ welcome_description }}</p>

	<hr />

	<p>An example of how you can use a reactive JavaScript framework like vue.js.</p>
	
	<p>When you instantiate your data using Vue we can output reactive elements by wrapping them in curly brackets.</p>

	<p>Please read the <a href="https://vuejs.org/v2/guide/">Vue.js guide</a> for more information.</p>

</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

<script>

	// create vue instance
	var vm = new Vue({
		el: '#app',
		data: data // <- passed from controller
	})
	

</script>

