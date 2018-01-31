
<div id="app">
	<h2>{{ welcome_message }}</h2>
	<p>{{ welcome_description }}</p>

	<hr />

	<p>Please read the <a href="https://vuejs.org/v2/guide/">Vue.js guide</a> for more information.</p>

</div>


<script>

	// create vue instance
	var vm = new Vue({
		el: '#app',
		data: data // <- passed from controller
	})
	

</script>

