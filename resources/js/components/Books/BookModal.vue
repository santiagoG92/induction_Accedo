<template>
    
    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
  </button> -->
  
  <!-- Modal -->
  <div class="modal fade" id="book_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>
	
	
</template>


<!-- este funciona con base al ciclo de vida de Vue ,las funcinalidades se ponen en el script -->
<script>
	// import  from './'
	export default {
		name: '',
		props: ['books'],
		data() {
			return {}
		},
        created(){
        console.log(this.books)
		this.index
        },
		mounted() {
			this.index()
		},
		methods: {
			async index() {
				$('#book_table').DataTable()
			}
		}
	}
</script>