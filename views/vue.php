

<div id="app">
	{{ message }}
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