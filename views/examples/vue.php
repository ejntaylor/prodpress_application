
<div id="app">
	<h2>{{ welcome_message }}</h2>
	<p>{{ welcome_description }}</p>

	<hr />

	<p>Please read the <a href="https://vuejs.org/v2/guide/">Vue.js guide</a> for more information.</p>

</div>


<script>

	// get vars from controller
	var data = <?= json_encode($data) ?>

	// create vue instance
	var vm = new Vue({
		el: '#app',
		data: data
	})

	// example: two methods to access data. Both reactive.
	console.dir(data.welcome_message);
	console.dir(vm.welcome_message);



</script>

