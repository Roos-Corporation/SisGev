<template>
    <div class="page-content">
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="link-icon" data-feather="users"></i> Listagem de espaço de coffee

                        </h6>

                        <button type="button" class="btn btn-primary" @click="$router.push('/coffee-spaces/form')">
                            ➕ Cadastrar espaço de coffee
                        </button>

                    </div>
                </div>
            </div>

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTableList" class="table">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Capacidade</th>
                                        <th>Localização</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(coffeeSpace,i) in coffeeSpaces" :key="i">

                                        <td>{{ coffeeSpace.id }}</td>
                                        <td>{{ coffeeSpace.name }}</td>
                                        <td>{{ coffeeSpace.capacity }}</td>
                                        <td>{{ coffeeSpace.location }}</td>
                                        <td>

                                            {{
                                                coffeeSpace.status == 'd' ? 'Disponível' :
                                                coffeeSpace.status == 'm' ? 'Em manutenção' :
                                                coffeeSpace.status == 'r' ? 'Reservada' : ''

                                            }}
                                        </td>
                                        <td>

                                            <button type="button" class="btn btn-primary btn-xs ml-4" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" @click="handleEditCoffeeSpaces(coffeeSpace)">
                                                ✏️
                                            </button>
                                            ᠎
                                            <button type="button" class="btn btn-danger btn-xs  mx-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir" @click="handleDeleteCoffeeSpaces(coffeeSpace)">
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
  import { useRouter } from 'vue-router'
  import { convertToDatable } from '../../../components/datable.js'
  export default {
    name: 'IndexCoffeeSpaces',
    data() {
        const router = useRouter();

        let coffeeSpaces = ref([]);

        const getCoffeeSpaces = async () => {
            let response = await axios.get("api/coffee-spaces");

            coffeeSpaces.value = response.data.data
            //Set table to an datable
            convertToDatable('dataTableList')
        }

        const handleEditCoffeeSpaces = async (event) => {

            router.push({ path: '/coffee-spaces/form', query: { id: event.id } })
        }

        const handleDeleteCoffeeSpaces = async (event) => {
            Swal.fire({
                title: 'Tem certeza ?',
                text: "Você não pode voltar atrás.",
                icon:"warning",
                showCancelButton:true,
                confirmButtonText:"Sim, excluir"

            }).then((result)=>{
                if(result.value){

                    axios.delete(`/api/coffee-spaces/${event.id}`, {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then((response)=>{
                        getCoffeeSpaces();
                        Swal.fire(
                            'Excluído',
                            'Espaço de coffee excluído com sucesso',
                            'success'
                        );
                    }).catch((error)=>{

                        Swal.fire(
                            'Falhou',
                            error.message,
                            'error'
                        );
                    });
                }
            })
        }


        onMounted(async () => {
            Swal.fire({
                title: 'Por favor aguarde!',
                text: "Carregando...",
                icon:"warning",
                showCancelButton:false,
                showConfirmButton:false,
                time: 3000,
                timeProgressBar:true,

            })
            await getCoffeeSpaces();
            Swal.close();
        })

      return {
        coffeeSpaces,
        handleEditCoffeeSpaces,
        handleDeleteCoffeeSpaces,
      }
    },


  }
</script>
