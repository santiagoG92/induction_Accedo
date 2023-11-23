<template>
	<div class="modal fade" id="category_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ is_create ? 'Crear' : 'Editar' }} Categoria</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" @click="closeModal" aria-label="Close"></button>
				</div>

				<backend-error :errors="back_errors"/>

				<!-- Formulario -->
				<Form @submit="saveCategory">
					<div class="modal-body row">

						<!-- Name -->
						<div class="col-12">
							<label for="name">Nombre</label>
							<Field name="name" v-model="category.name" v-slot="{ errorMessage, field }" :rules="name_rules">
								<input :class="`form-control ${errorMessage || back_errors['name'] ? 'is-invalid' : ''}`" id="name"
									v-bind="field" />
								<span class="invalid-feedback">{{ errorMessage }}</span>
								<span class="invalid-feedback">{{ back_errors['name'] }}</span>
							</Field>
						</div>
					</div>

					<!-- Buttons -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" @click="closeModal">Cancelar</button>
						<button type="submit" class="btn btn-primary">Almacenar</button>
					</div>
				</Form>
			</div>
		</div>
	</div>
</template>

<!-- este funciona con base al ciclo de vida de Vue ,las funcinalidades se ponen en el script -->
<script>
import { successMessage, handlerErrors } from '@/components/helpers/Alerts.js'
import { ref, getCurrentInstance } from 'vue'
import { Field, Form } from 'vee-validate'
import * as yup from 'yup';
import BackendError from '../Components/BackendError.vue';

export default {
	props: ['category_data'],
	components: { Field, Form, BackendError},

    setup({category_data}) {
        const instance = getCurrentInstance();
		const is_create = category_data ? ref(false) : ref(true)
		const category = !is_create.value ? ref(category_data) : ref({})
		const back_errors = ref({})
		const closeModal = () => instance.parent.ctx.closeModal()


        const saveCategory= async()=>{
            try {
                if (is_create.value) {
                    await axios.post('/categories',category.value)

                }else{
                    await axios.put(`/categories/${category.value.id}`,category.value)
                }
                successMessage({is_delete :false}).then(() => succesRespose())
            } catch (error) {
                back_errors.value = await handlerErrors(error)
            }

        }
			const succesRespose = () => {
			instance.parent.ctx.reloadState()
			closeModal()
		}

		const name_rules = yup.string().required('El nombre es requerido')
		return {
			category,
			is_create,
			name_rules,
			back_errors,
			closeModal,
			saveCategory,
		}


}


}
</script>
