<template>
	<h1>PruebaSC</h1>

	<section>
		<div class="card">
			<div class="card-header d-flex justify-content-end">
				<button class="btn btn-primary" @click="openModal">Crear libro</button>
			</div>
			<div class="card-body">
				<div class="table-responsive my-4 mx-2">
					<table class="table table-bordered" id="book_table">
						<thead>
							<tr>
								<th>Titulo</th>
								<th>Autor</th>
								<th>Categoria</th>
								<th>Cantidad</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<!-- <tbody>
							<tr v-for="(book, index) in books" :key="index">
								<td>{{ book.title }}</td>
								<td>{{ book.author.name }}</td>
								<td>{{ book.category.name }}</td>
								<td>{{ book.stock }}</td>
								<td>
                                    <div class="d-flex justify-content-center">

                                        <button type="button" class="btn btn-primary btn-sm" @click="editBook(book)" title="editar">
                                            <i class="fas fa-edit"></i></button>
									<button type="button" class="btn btn-danger btn-sm ms-2"  @click="deleteBook(book)" title="eliminar">
                                        <i class="fas fa-trash-alt"></i></button>
                                    </div>
								</td>
							</tr>
						</tbody> -->
                        <tbody>
							<tr v-for="(book, index) in books" :key="index">
								<td>{{ book.title }}</td>
								<td>{{ book.author.name }}</td>
								<td>{{ book.category.name }}</td>
								<td>{{ book.stock }}</td>
								<td>
									<div class="d-flex justify-content-center" title="Editar">
										<button type="button" class="btn btn-primary btn-sm" @click="editBook(book)">
											<i class="fas fa-pencil-alt"></i>
										</button>
										<button type="button" class="btn btn-danger btn-sm ms-2" title="Eliminar"
											@click="deleteBook(book)">
											<i class="fas fa-trash-alt"></i>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div>
				<book-modal :authors_data="authors_data" :book_data="book" ref="book_modal" />
			</div>
		</div>
	</section>
</template>

<!-- este funciona con base al ciclo de vida de Vue ,las funcinalidades se ponen en el script -->
<script>
	import BookModal from './BookModal.vue'
	import { deleteMessage ,successMessage} from '@/components/helpers/Alerts.js'
	export default {
		// maneras de heredar en vue la que voy a hacer es de component
		components: {
			BookModal
		},
		name: '',
		props: ['books', 'authors_data'],
		data() {
			return {
				modal: null,
				book: {}
			}
		},
		created() {
			console.log(this.books)
			this.index
		},
		mounted() {
			this.index()
		},
		methods: {
			async index() {
				$('#book_table').DataTable()
				const modal_id = document.getElementById('book_modal')
				this.modal = new bootstrap.Modal(modal_id)

				modal_id.addEventListener('hidden.bs.modal', e => {
					
                    this.$refs.book_modal.reset()
                    // console.log('Libro actual:', this.book);
					alert('hola')
				})
			},
            editBook(book){
            this.book= book
            this.openModal()
            },
             async deleteBook({id}){
				if (!await deleteMessage()) return
                try {
                    await axios.delete(`/books/${id}`)
					await successMessage({ is_delete: true, reload: true })
                    // window.location.reload()
                } catch (error) {
                  console.error(error);  
                }
            },
			openModal() {
				this.modal.show()
			},
            closeModal() {
				this.modal.hide()
			}
		}
	}
</script>
