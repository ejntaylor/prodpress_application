
<div id="app">
	<h2>{{ welcome_message }}</h2>
	<p>{{ welcome_description }}</p>
</div>


<script>

	// get controller vars
	var data = <?= json_encode($data) ?>

	// create vue instance
	var vm = new Vue({
		el: '#app',
		data: data
	})

	// two methods to access data
	console.dir(data.welcome_message);
	console.dir(vm.welcome_message);



</script>

