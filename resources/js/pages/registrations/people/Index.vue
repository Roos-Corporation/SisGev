<template>
    <div class="page-content">
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="link-icon" data-feather="users"></i> Listagem de pessoas

                        </h6>

                        <button type="button" class="btn btn-primary" @click="$router.push('/people/form')">
                            ➕ Cadastrar pessoa
                        </button>

                    </div>
                </div>
            </div>

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Sobrenome</th>
                                        <th>Contabilidade</th>
                                        <th>Gênero</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(person,i) in people" :key="i">

                                        <td>{{ person.id }}</td>
                                        <td>{{ person.firstName }}</td>
                                        <td>{{ person.lastName }}</td>
                                        <td>{{ person.accounting }}</td>
                                        <td >
                                            {{ person.gender == 'f' ? 'Femenino' : 'Masculino' }}
                                        </td>
                                        <td>
                                            <div class="form-check form-switch mb-2">
                                                <input
                                                :checked="person.status == 'a' ? true : false" type="checkbox" class="form-check-input" id="formSwitch1">
                                            </div>
                                        </td>

                                        <td>

                                            <button type="button" class="btn btn-primary btn-xs ml-4" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" @click="handleEditPeople(person)">
                                                ✏️
                                            </button>
                                            ᠎
                                            <button type="button" class="btn btn-danger btn-xs  mx-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir" @click="handleDeletePeople(person)">
                                                🗑️
                                            </button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import { onMounted, ref } from 'vue'
  export default {
    name: 'IndexPeople',
    data() {

        let people = ref([]);

        const getPeople = async () => {
            let response = await axios.get("api/people");

            people.value = response.data.data

            console.log('people', response)
        }

        const handleEditPeople = async () => {
            alert('handleEditPeople')
        }

        const handleDeletePeople = async () => {
            alert('handleDeletePeople')
        }


        onMounted(async () => {
            getPeople();
        })

      return {
        people,
        handleEditPeople,
        handleDeletePeople,
      }
    },


  }
</script>
